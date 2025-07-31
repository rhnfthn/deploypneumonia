#!/usr/bin/env python3
"""
Flask app untuk deployment Railway
Menggunakan model VGG-16 untuk prediksi pneumonia
"""

import os
import json
import base64
from flask import Flask, request, jsonify, render_template_string
from werkzeug.utils import secure_filename
import numpy as np
from PIL import Image
import tensorflow as tf

# Suppress TensorFlow logging
os.environ["TF_CPP_MIN_LOG_LEVEL"] = "3"
tf.get_logger().setLevel("ERROR")

app = Flask(__name__)
app.config['MAX_CONTENT_LENGTH'] = 16 * 1024 * 1024  # 16MB max file size

# Load model once at startup
model = None
def load_model():
    global model
    try:
        model_path = "application/models/model_vgg16_pneumonia.h5"
        if os.path.exists(model_path):
            model = tf.keras.models.load_model(model_path)
            print("✅ Model VGG-16 loaded successfully!")
        else:
            print("❌ Model file not found!")
    except Exception as e:
        print(f"❌ Error loading model: {e}")

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

def predict_pneumonia(image_path):
    """Predict pneumonia using VGG16 model"""
    global model
    try:
        if model is None:
            return None
        
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

@app.route('/')
def home():
    """Home page"""
    html = """
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PneumoDetect - AI Pneumonia Detection</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <style>
            body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
            .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 80px 0; }
            .upload-area { border: 2px dashed #dee2e6; border-radius: 10px; padding: 40px; text-align: center; margin: 20px 0; }
            .upload-area:hover { border-color: #007bff; }
            .result { margin: 20px 0; padding: 20px; border-radius: 10px; }
            .success { background-color: #d4edda; border: 1px solid #c3e6cb; }
            .error { background-color: #f8d7da; border: 1px solid #f5c6cb; }
            .loading { display: none; }
        </style>
    </head>
    <body>
        <div class="hero">
            <div class="container text-center">
                <h1 class="display-4 mb-3"><i class="fa fa-lungs"></i> PneumoDetect</h1>
                <p class="lead">Sistem cerdas berbasis AI untuk mendeteksi pneumonia dari citra X-ray paru-paru</p>
            </div>
        </div>
        
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4">
                                <i class="fa fa-upload"></i> Upload Citra X-Ray
                            </h3>
                            
                            <div class="upload-area" id="uploadArea">
                                <i class="fa fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                <h5>Drag & Drop atau Klik untuk Upload</h5>
                                <p class="text-muted">Format: JPG, PNG, GIF (Max: 2MB)</p>
                                <input type="file" id="imageFile" accept="image/*" style="display: none;">
                                <button class="btn btn-primary" onclick="document.getElementById('imageFile').click()">
                                    <i class="fa fa-folder-open"></i> Pilih File
                                </button>
                            </div>
                            
                            <div class="text-center">
                                <button class="btn btn-success btn-lg" onclick="uploadImage()" id="uploadBtn" disabled>
                                    <i class="fa fa-search"></i> Mulai Prediksi
                                </button>
                            </div>
                            
                            <div class="loading text-center mt-3" id="loading">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2">Menganalisis citra X-ray...</p>
                            </div>
                            
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            document.getElementById('imageFile').addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    document.getElementById('uploadBtn').disabled = false;
                    document.getElementById('uploadArea').innerHTML = `
                        <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
                        <h5>File Dipilih</h5>
                        <p class="text-muted">${file.name} (${(file.size/1024).toFixed(1)} KB)</p>
                    `;
                }
            });
            
            function uploadImage() {
                const fileInput = document.getElementById('imageFile');
                const file = fileInput.files[0];
                
                if (!file) {
                    alert('Pilih file terlebih dahulu!');
                    return;
                }
                
                const formData = new FormData();
                formData.append('image', file);
                
                document.getElementById('loading').style.display = 'block';
                document.getElementById('result').innerHTML = '';
                document.getElementById('uploadBtn').disabled = true;
                
                fetch('/predict', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('uploadBtn').disabled = false;
                    
                    if (data.success) {
                        const confidenceColor = data.confidence > 80 ? 'success' : 
                                               data.confidence > 60 ? 'warning' : 'danger';
                        
                        document.getElementById('result').innerHTML = `
                            <div class="result success">
                                <h4><i class="fa fa-check-circle text-success"></i> Prediksi Berhasil!</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Hasil Analisis:</h5>
                                        <p class="h3 text-${confidenceColor}">
                                            <strong>${data.prediction}</strong>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tingkat Kepercayaan:</h5>
                                        <div class="progress mb-2">
                                            <div class="progress-bar bg-${confidenceColor}" 
                                                 style="width: ${data.confidence}%">
                                                ${data.confidence}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-muted">
                                    <i class="fa fa-info-circle"></i> 
                                    Hasil ini berdasarkan analisis AI menggunakan model VGG-16
                                </small>
                            </div>
                        `;
                    } else {
                        document.getElementById('result').innerHTML = `
                            <div class="result error">
                                <h4><i class="fa fa-exclamation-triangle text-danger"></i> Prediksi Gagal</h4>
                                <p><strong>Error:</strong> ${data.message}</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('uploadBtn').disabled = false;
                    
                    document.getElementById('result').innerHTML = `
                        <div class="result error">
                            <h4><i class="fa fa-exclamation-triangle text-danger"></i> Error Network</h4>
                            <p><strong>Error:</strong> ${error.message}</p>
                        </div>
                    `;
                });
            }
        </script>
    </body>
    </html>
    """
    return html

@app.route('/predict', methods=['POST'])
def predict():
    """Predict pneumonia from uploaded image"""
    try:
        if 'image' not in request.files:
            return jsonify({'success': False, 'message': 'No image uploaded'})
        
        file = request.files['image']
        if file.filename == '':
            return jsonify({'success': False, 'message': 'No file selected'})
        
        if file:
            # Save uploaded file temporarily
            filename = secure_filename(file.filename)
            temp_path = f"temp_{filename}"
            file.save(temp_path)
            
            # Make prediction
            result = predict_pneumonia(temp_path)
            
            # Clean up
            if os.path.exists(temp_path):
                os.remove(temp_path)
            
            if result:
                return jsonify({
                    'success': True,
                    'prediction': result['prediction'],
                    'confidence': result['confidence'],
                    'probability': result['probability']
                })
            else:
                return jsonify({
                    'success': False,
                    'message': 'Gagal melakukan prediksi. Silakan coba lagi.'
                })
        
    except Exception as e:
        return jsonify({
            'success': False,
            'message': f'Error: {str(e)}'
        })

@app.route('/health')
def health():
    """Health check endpoint"""
    return jsonify({
        'status': 'healthy',
        'model_loaded': model is not None,
        'service': 'PneumoDetect VGG-16'
    })

if __name__ == '__main__':
    # Load model at startup
    load_model()
    
    # Get port from environment variable
    port = int(os.environ.get('PORT', 5000))
    
    # Run app
    app.run(host='0.0.0.0', port=port, debug=False) 