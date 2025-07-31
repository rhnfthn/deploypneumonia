# 🚀 Deployment PneumoDetect GRATIS

## 📋 **PERSIAPAN**

### **1. Buat Repository GitHub**
```bash
# Commit semua file
git add .
git commit -m "Initial commit: PneumoDetect with VGG-16 model"
git branch -M main

# Push ke GitHub
git remote add origin https://github.com/username/pneumoniadetect.git
git push -u origin main
```

### **2. File yang Sudah Disiapkan**
- ✅ `app.py` - Flask application
- ✅ `requirements.txt` - Python dependencies
- ✅ `Procfile` - Railway configuration
- ✅ `runtime.txt` - Python version
- ✅ `.gitignore` - Exclude unnecessary files

## 🎯 **DEPLOYMENT OPTIONS**

### **🥇 OPSI 1: Railway.app (REKOMENDASI)**

#### **Langkah-langkah:**
1. **Buat Account**: [railway.app](https://railway.app)
2. **Connect GitHub**: Pilih repository
3. **Deploy**: Railway akan auto-deploy
4. **Get URL**: Dapatkan URL gratis

#### **Keunggulan:**
- ✅ Gratis $5 credit/bulan
- ✅ Support Python + TensorFlow
- ✅ Model 93MB tidak masalah
- ✅ Auto-deploy dari GitHub
- ✅ SSL otomatis

### **🥈 OPSI 2: Render.com**

#### **Langkah-langkah:**
1. **Buat Account**: [render.com](https://render.com)
2. **New Web Service**: Connect GitHub
3. **Configure**: Python environment
4. **Deploy**: Auto-deploy

#### **Keunggulan:**
- ✅ Gratis 750 jam/bulan
- ✅ Support Python
- ✅ Model 93MB support
- ✅ SSL otomatis

### **🥉 OPSI 3: Heroku (Limited)**

#### **Langkah-langkah:**
1. **Buat Account**: [heroku.com](https://heroku.com)
2. **Install CLI**: Heroku CLI
3. **Create App**: `heroku create`
4. **Deploy**: `git push heroku main`

#### **Kekurangan:**
- ❌ Model 93MB lambat
- ❌ Cold start issues
- ❌ Limited resources

## 🔧 **DEPLOYMENT STEPS**

### **Step 1: Railway.app**

#### **1. Buat Account**
- Buka [railway.app](https://railway.app)
- Sign up dengan GitHub

#### **2. New Project**
- Klik "New Project"
- Pilih "Deploy from GitHub repo"
- Pilih repository `pneumoniadetect`

#### **3. Configure Environment**
```bash
# Railway akan auto-detect Python
# Pastikan file ini ada:
# - app.py
# - requirements.txt
# - Procfile
# - runtime.txt
```

#### **4. Deploy**
- Railway akan auto-deploy
- Tunggu 5-10 menit (model 93MB)
- Dapatkan URL gratis

### **Step 2: Render.com**

#### **1. Buat Account**
- Buka [render.com](https://render.com)
- Sign up dengan GitHub

#### **2. New Web Service**
- Klik "New Web Service"
- Connect GitHub repository
- Pilih branch `main`

#### **3. Configure**
```bash
Name: pneumoniadetect
Environment: Python 3
Build Command: pip install -r requirements.txt
Start Command: gunicorn app:app
```

#### **4. Deploy**
- Klik "Create Web Service"
- Tunggu deployment selesai
- Dapatkan URL gratis

## 📊 **PERFORMANCE EXPECTATION**

### **Model Loading:**
- **First Deploy**: 5-10 menit
- **Cold Start**: 30-60 detik
- **Warm Start**: 5-10 detik

### **Prediction Time:**
- **Single Image**: 2-5 detik
- **Concurrent Users**: 3-5 users
- **Response Time**: <10 detik

## 🔍 **TESTING DEPLOYMENT**

### **1. Health Check**
```bash
# Test endpoint
curl https://your-app.railway.app/health
```

### **2. Upload Test**
- Buka URL aplikasi
- Upload gambar X-ray
- Test prediksi

### **3. Performance Test**
- Test dengan gambar berbeda
- Monitor response time
- Check error logs

## 🛠️ **TROUBLESHOOTING**

### **Error: Model not found**
```bash
# Pastikan file model ada
ls -la application/models/model_vgg16_pneumonia.h5
```

### **Error: Dependencies**
```bash
# Check requirements.txt
cat requirements.txt
```

### **Error: Memory**
```bash
# Model 93MB membutuhkan memory cukup
# Railway: $5 plan sudah cukup
# Render: Free plan sudah cukup
```

## 💰 **COST BREAKDOWN**

### **Railway.app:**
- **Free Tier**: $5 credit/bulan
- **Usage**: ~$2-3/bulan untuk aplikasi kecil
- **Total**: GRATIS

### **Render.com:**
- **Free Tier**: 750 jam/bulan
- **Usage**: ~500 jam/bulan
- **Total**: GRATIS

### **Heroku:**
- **Free Tier**: 550-1000 dyno hours
- **Usage**: ~600 jam/bulan
- **Total**: GRATIS

## 🎉 **KESIMPULAN**

### **REKOMENDASI: Railway.app**

**Alasan:**
✅ **Gratis**: $5 credit/bulan  
✅ **Support**: Python + TensorFlow  
✅ **Model 93MB**: Tidak masalah  
✅ **Auto-deploy**: Dari GitHub  
✅ **SSL**: Otomatis  
✅ **Reliable**: Performance baik  

### **Langkah Cepat:**
1. Push ke GitHub
2. Deploy ke Railway
3. Dapatkan URL gratis
4. Test aplikasi
5. Share ke user

**Aplikasi PneumoDetect siap deploy GRATIS!** 🚀 