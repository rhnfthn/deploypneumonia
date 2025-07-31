# Troubleshooting PneumoDetect

## Error: "Gagal melakukan prediksi. Silakan coba lagi."

### 🔍 Langkah Debug

#### 1. **Periksa File Requirements**
```bash
# Pastikan file model ada
ls application/models/model_vgg16_pneumonia.h5

# Pastikan Python script ada
ls application/models/predict_pneumonia.py

# Pastikan gambar test ada
ls assets/uploads/xray.jpg
```

#### 2. **Test Python Dependencies**
```bash
# Test TensorFlow
python -c "import tensorflow as tf; print('TensorFlow:', tf.__version__)"

# Test NumPy
python -c "import numpy as np; print('NumPy:', np.__version__)"

# Test PIL
python -c "from PIL import Image; print('PIL installed')"
```

#### 3. **Test Model Loading**
```bash
python test_model.py
```

#### 4. **Test Prediction Script**
```bash
python application/models/predict_pneumonia.py assets/uploads/xray.jpg application/models/model_vgg16_pneumonia.h5
```

#### 5. **Debug PHP Integration**
```bash
php debug_prediction.php
```

### 🛠️ Solusi Umum

#### **Masalah 1: Python tidak ditemukan**
```bash
# Install Python 3.8+
# Download dari python.org

# Atau gunakan conda
conda install python=3.8
```

#### **Masalah 2: TensorFlow tidak terinstall**
```bash
pip install tensorflow numpy Pillow
```

#### **Masalah 3: Model file tidak ada**
```bash
# Pastikan file model_vgg16_pneumonia.h5 ada di:
# application/models/model_vgg16_pneumonia.h5
```

#### **Masalah 4: Permission denied**
```bash
# Windows
icacls application/models/predict_pneumonia.py /grant Everyone:F

# Linux/Mac
chmod +x application/models/predict_pneumonia.py
```

#### **Masalah 5: JSON parsing error**
- ✅ **Sudah diperbaiki**: Parsing JSON sekarang menggunakan ekstraksi baris terakhir
- ✅ **Error logging**: Ditambahkan untuk debugging

### 📊 Expected Output

#### **Sukses:**
```json
{
    "prediction": "Pneumonia",
    "confidence": 99.99,
    "probability": 0.9999
}
```

#### **Error:**
```json
{
    "error": "Image file not found"
}
```

### 🔧 Konfigurasi

#### **Environment Variables:**
```bash
# Suppress TensorFlow logging
export TF_CPP_MIN_LOG_LEVEL=3

# Windows
set TF_CPP_MIN_LOG_LEVEL=3
```

#### **PHP Settings:**
```php
// Di application/models/Pneumonia_model.php
putenv("TF_CPP_MIN_LOG_LEVEL=3");
```

### 📝 Log Files

#### **PHP Error Log:**
- **XAMPP**: `C:\xampp\php\logs\php_error_log`
- **Linux**: `/var/log/apache2/error.log`

#### **Custom Error Log:**
- Error model akan di-log dengan prefix "Pneumonia Model Error:"

### 🎯 Verifikasi

#### **Test 1: Model Loading**
```bash
python test_model.py
# Expected: "All tests passed! Model is ready to use."
```

#### **Test 2: Prediction**
```bash
php debug_prediction.php
# Expected: "Parsed result: Array([prediction] => Pneumonia...)"
```

#### **Test 3: Web Interface**
1. Upload gambar X-ray
2. Expected: Hasil prediksi dengan confidence >90%

### 🚨 Emergency Fix

Jika semua gagal, gunakan fallback:

```php
// Di application/models/Pneumonia_model.php
public function predict($image_path) {
    // Emergency fallback
    if (!file_exists($this->model_path)) {
        return array(
            'prediction' => 'Model Error',
            'confidence' => 0,
            'message' => 'Model file tidak ditemukan'
        );
    }
    
    // ... rest of the code
}
```

### 📞 Support

Jika masalah masih berlanjut:
1. Periksa error log
2. Jalankan debug scripts
3. Pastikan semua dependencies terinstall
4. Test dengan gambar yang berbeda

**Status: ✅ Model VGG-16 berfungsi dengan baik!** 