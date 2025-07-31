#!/usr/bin/env python3
import sys
import numpy as np
from PIL import Image
import tensorflow as tf
import json
import os

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
        
        # Make prediction
        prediction = model.predict(img_array)
        
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
