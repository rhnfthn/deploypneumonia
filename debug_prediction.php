<?php
// Debug script untuk prediksi
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Simulasi prediksi seperti di controller
$image_path = "assets/uploads/xray.jpg"; // Test dengan gambar yang ada
$model_path = "application/models/model_vgg16_pneumonia.h5";
$python_script_path = "application/models/predict_pneumonia.py";

echo "=== DEBUG PREDICTION ===\n";
echo "Image path: " . $image_path . "\n";
echo "Model path: " . $model_path . "\n";
echo "Python script: " . $python_script_path . "\n\n";

// Check if files exist
echo "=== FILE CHECKS ===\n";
echo "Image exists: " . (file_exists($image_path) ? "YES" : "NO") . "\n";
echo "Model exists: " . (file_exists($model_path) ? "YES" : "NO") . "\n";
echo "Python script exists: " . (file_exists($python_script_path) ? "YES" : "NO") . "\n\n";

// Check Python command
$python_command = "python";
echo "Python command: " . $python_command . "\n";

// Build command
putenv("TF_CPP_MIN_LOG_LEVEL=3");
$command = $python_command . " " . escapeshellarg($python_script_path) . " " . 
           escapeshellarg($image_path) . " " . 
           escapeshellarg($model_path) . " 2>&1";

echo "=== COMMAND ===\n";
echo "Command: " . $command . "\n\n";

// Execute command
echo "=== EXECUTION ===\n";
$output = shell_exec($command);
$return_var = 0; // PHP doesn't have $? like bash

echo "Return code: " . $return_var . "\n";
echo "Output:\n" . $output . "\n";

// Parse JSON
echo "=== JSON PARSING ===\n";
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
    echo "JSON Error: No JSON found in output\n";
    echo "Raw output: " . $output . "\n";
} else {
    $result = json_decode($json_line, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON Error: " . json_last_error_msg() . "\n";
        echo "JSON line: " . $json_line . "\n";
    } else {
        echo "Parsed result: " . print_r($result, true) . "\n";
    }
}

// Test Python directly
echo "\n=== DIRECT PYTHON TEST ===\n";
$test_command = "python -c \"import tensorflow as tf; print('TensorFlow version:', tf.__version__)\"";
$test_output = shell_exec($test_command);
echo "TensorFlow test: " . $test_output . "\n";
?> 