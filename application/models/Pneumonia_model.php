<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pneumonia_model extends CI_Model {

    private $model_path;
    private $python_script_path;

    public function __construct() {
        parent::__construct();
        $this->model_path = APPPATH . 'models/model_vgg16_pneumonia.h5';
        $this->python_script_path = APPPATH . 'models/predict_pneumonia.py';
        $this->create_python_script();
    }

    private function create_python_script() {
        // Buat script Python untuk prediksi jika belum ada
        if (!file_exists($this->python_script_path)) {
            $python_code = '#!/usr/bin/env python3
import sys
import numpy as np
from PIL import Image
import tensorflow as tf
import json
import os

# Suppress TensorFlow logging
import os
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"
tf.get_logger().setLevel("ERROR")

def preprocess_image(image_path):
    """Preprocess image for VGG16 model"""
    try:
        # Load image
        img = Image.open(image_path).convert("RGB")
        
        # Resize to 224x224 (VGG16 input size)
        img = img.resize((224, 224))
        
        # Convert to array and normalize
        img_array = np.array(img) / 255.0
        
        # Add batch dimension
        img_array = np.expand_dims(img_array, axis=0)
        
        return img_array
    except Exception as e:
        print(f"Error preprocessing image: {e}")
        return None

def predict_pneumonia(image_path, model_path):
    """Predict pneumonia using VGG16 model"""
    try:
        # Load model
        model = tf.keras.models.load_model(model_path)
        
        # Preprocess image
        img_array = preprocess_image(image_path)
        if img_array is None:
            return None
        
        # Make prediction (suppress verbose output)
        prediction = model.predict(img_array, verbose=0)
        
        # Get prediction result
        probability = float(prediction[0][0])
        
        if probability > 0.5:
            result = "Pneumonia"
            confidence = probability * 100
        else:
            result = "Normal"
            confidence = (1 - probability) * 100
        
        return {
            "prediction": result,
            "confidence": round(confidence, 2),
            "probability": round(probability, 4)
        }
        
    except Exception as e:
        print(f"Error in prediction: {e}")
        return None

if __name__ == "__main__":
    if len(sys.argv) != 3:
        print("Usage: python predict_pneumonia.py <image_path> <model_path>")
        sys.exit(1)
    
    image_path = sys.argv[1]
    model_path = sys.argv[2]
    
    if not os.path.exists(image_path):
        print(json.dumps({"error": "Image file not found"}))
        sys.exit(1)
    
    if not os.path.exists(model_path):
        print(json.dumps({"error": "Model file not found"}))
        sys.exit(1)
    
    result = predict_pneumonia(image_path, model_path)
    
    if result:
        print(json.dumps(result))
    else:
        print(json.dumps({"error": "Prediction failed"}))
';
            
            file_put_contents($this->python_script_path, $python_code);
            chmod($this->python_script_path, 0755); // Make executable
        }
    }

    public function predict($image_path) {
        if (!file_exists($image_path)) {
            return FALSE;
        }

        if (!file_exists($this->model_path)) {
            return FALSE;
        }

        // Call Python script for prediction (try different Python commands)
        $python_command = "python";
        
        // Try different Python commands
        $python_commands = ["python", "python3", "py"];
        foreach ($python_commands as $cmd) {
            $test_output = shell_exec($cmd . " --version 2>&1");
            if (strpos($test_output, "Python") !== false) {
                $python_command = $cmd;
                break;
            }
        }
        
        // If no Python found, try with full path
        if (empty($python_command) || strpos($test_output, "Python") === false) {
            // Try common Python paths on Windows
            $python_paths = [
                "C:\\Python38\\python.exe",
                "C:\\Python39\\python.exe",
                "C:\\Python310\\python.exe",
                "C:\\Users\\" . get_current_user() . "\\AppData\\Local\\Programs\\Python\\Python38\\python.exe"
            ];
            
            foreach ($python_paths as $path) {
                if (file_exists($path)) {
                    $python_command = $path;
                    break;
                }
            }
        }
        
        // Set environment variables to suppress TensorFlow output
        putenv("TF_CPP_MIN_LOG_LEVEL=3");
        $command = $python_command . " " . escapeshellarg($this->python_script_path) . " " . 
                   escapeshellarg($image_path) . " " . 
                   escapeshellarg($this->model_path) . " 2>&1";
        
        $output = shell_exec($command);
        
        if ($output === null) {
            error_log("Pneumonia Model Error: Python command returned null output");
            return FALSE;
        }

        // Parse JSON output (extract JSON from mixed output)
        $lines = explode("\n", trim($output));
        $json_line = "";
        
        // Find the JSON line (look for the last line that contains JSON)
        for ($i = count($lines) - 1; $i >= 0; $i--) {
            $line = trim($lines[$i]);
            if (strpos($line, '{') === 0 && strpos($line, '}') !== false) {
                $json_line = $line;
                break;
            }
        }
        
        if (empty($json_line)) {
            // Log error for debugging
            error_log("Pneumonia Model Error: No JSON found in output: " . $output);
            return FALSE;
        }
        
        $result = json_decode($json_line, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Log error for debugging
            error_log("Pneumonia Model Error: JSON decode failed: " . json_last_error_msg() . " for line: " . $json_line);
            return FALSE;
        }

        if (isset($result['error'])) {
            // Log error for debugging
            error_log("Pneumonia Model Error: " . $result['error']);
            return FALSE;
        }

        return $result;
    }

    public function predict_with_fallback($image_path) {
        // Use only real VGG-16 model, no fallback to ensure consistency
        $result = $this->predict($image_path);
        
        if ($result === FALSE) {
            // If model fails, return error instead of fallback
            return array(
                'prediction' => 'Error',
                'confidence' => 0,
                'message' => 'Model VGG-16 tidak dapat memproses gambar ini'
            );
        }
        
        return $result;
    }

    public function get_prediction_history() {
        // Ambil riwayat prediksi dari database (jika ada)
        return array();
    }

    public function save_prediction($data) {
        // Simpan hasil prediksi ke database (jika diperlukan)
        return TRUE;
    }
} 