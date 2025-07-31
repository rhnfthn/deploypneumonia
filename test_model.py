#!/usr/bin/env python3
"""
Test script untuk memverifikasi model VGG-16 PneumoDetect
"""

import sys
import os
import json
import numpy as np
from PIL import Image
import tensorflow as tf

def test_model_loading():
    """Test loading model VGG-16"""
    try:
        model_path = "application/models/model_vgg16_pneumonia.h5"
        if not os.path.exists(model_path):
            print("Model file not found:", model_path)
            return False
        
        print("Loading model from:", model_path)
        model = tf.keras.models.load_model(model_path)
        print("Model loaded successfully!")
        
        # Print model summary
        print("\nModel Summary:")
        model.summary()
        
        return True
    except Exception as e:
        print("Error loading model:", str(e))
        return False

def test_prediction():
    """Test prediction with random image"""
    try:
        model_path = "application/models/model_vgg16_pneumonia.h5"
        if not os.path.exists(model_path):
            print("Model file not found")
            return False
        
        # Load model
        model = tf.keras.models.load_model(model_path)
        
        # Create random test image
        test_image = np.random.random((1, 224, 224, 3))
        
        # Make prediction
        prediction = model.predict(test_image)
        probability = float(prediction[0][0])
        
        if probability > 0.5:
            result = "Pneumonia"
            confidence = probability * 100
        else:
            result = "Normal"
            confidence = (1 - probability) * 100
        
        print("Prediction test passed!")
        print(f"Result: {result}")
        print(f"Confidence: {confidence:.2f}%")
        print(f"Raw probability: {probability:.4f}")
        
        return True
    except Exception as e:
        print("Error in prediction:", str(e))
        return False

def main():
    """Main test function"""
    print("Testing PneumoDetect VGG-16 Model")
    print("=" * 50)
    
    tests = [
        ("Model Loading", test_model_loading),
        ("Prediction", test_prediction)
    ]
    
    passed = 0
    total = len(tests)
    
    for test_name, test_func in tests:
        print(f"\nTesting: {test_name}")
        print("-" * 30)
        
        if test_func():
            passed += 1
            print(f"{test_name}: PASSED")
        else:
            print(f"{test_name}: FAILED")
    
    print("\n" + "=" * 50)
    print(f"Test Results: {passed}/{total} tests passed")
    
    if passed == total:
        print("All tests passed! Model is ready to use.")
        return 0
    else:
        print("Some tests failed. Please check the setup.")
        return 1

if __name__ == "__main__":
    sys.exit(main()) 