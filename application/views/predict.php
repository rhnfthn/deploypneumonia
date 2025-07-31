<style>
:root {
  --upload-bg: #f5f7fa;      /* Light mode */
  --upload-color: #232e4d;
}
body.dark-mode, [data-theme="dark"] {
  --upload-bg: #232e4d;      /* Dark mode */
  --upload-color: #fff;
}
.upload-area {
  padding: 48px 24px;
  text-align: center;
  position: relative;
  cursor: pointer;
  transition: border-color 0.2s;
}
.upload-area.dragover {
  border-color: #3399ff;
  background: #1a2238;
}
.upload-area input[type="file"] {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  left: 0;
  top: 0;
  cursor: pointer;
  z-index: 2;
}
.upload-content {
  position: relative;
  z-index: 1;
}
.upload-icon {
  font-size: 48px;
  color: #3399ff;
  margin-bottom: 12px;
}
.img-preview-box {
  border-radius: 32px;
  background: #f4f8fd;
  box-shadow: 0 2px 16px rgba(108,160,220,0.13);
  padding: 0;
  text-align: center;
  min-height: 220px;
  min-width: 100%;
  height: 220px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 0;
}
.img-preview-box img {
  width: 100%;
  height: auto;
  object-fit: contain;
  background: #fff;
  border-radius: 32px;
  box-shadow: 0 2px 12px rgba(108,160,220,0.10);
}
.result-col {
  background: linear-gradient(135deg, #ffeaea 60%, #ffe3e3 100%);
  border-radius: 28px;
  box-shadow: 0 2px 16px rgba(108,160,220,0.10);
  padding: 18px 18px 12px 18px;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  justify-content: flex-start;
  min-height: 120px;
  height: 100%;
}
.result-box {
  border-radius: 18px;
  color: #fff;
  font-size: 1.25rem;
  min-height: 60px;
  width: 100%;
  margin-bottom: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 2px 12px rgba(108,160,220,0.10);
  padding: 18px 12px;
  text-align: center;
  font-weight: 600;
  letter-spacing: 0.5px;
  transition: box-shadow 0.2s;
}
.result-box.normal {
  background: linear-gradient(135deg, #7ED6A5 60%, #43A047 100%);
}
.result-box.pneumonia {
  background: linear-gradient(135deg, #FF8A80 60%, #E53935 100%);
}
</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">
          <i class="fa fa-stethoscope me-3"></i>Prediksi Pneumonia dari X-Ray
        </h1>
        <p class="lead" style="font-family:'Lato',sans-serif;max-width:600px;margin:0 auto;">Upload citra X-ray paru-paru untuk mendeteksi kemungkinan pneumonia menggunakan AI</p>
      </div>

      <div class="row g-4">
        <!-- Upload Area -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4" style="font-family:'Poppins',sans-serif;">
                <i class="fa fa-upload me-2"></i>Upload Citra X-Ray
              </h5>
              
              <?php echo form_open_multipart('predict/upload', array('id' => 'uploadForm')); ?>
                <div class="upload-area border-2 border-dashed rounded-4 mb-3" id="uploadArea">
                  <input type="file" name="image" id="imageInput" accept="image/*" required>
                  <div class="upload-content">
                    <div class="upload-icon">
                      <i class="fa fa-cloud-upload-alt"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="font-family:'Poppins',sans-serif;">Drag & Drop atau Klik untuk Upload</h6>
                    <p class="text-muted mb-0" style="font-size:0.9rem;">Format: JPG, PNG, GIF (Max: 2MB)</p>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-3" id="predictBtn" disabled>
                  <i class="fa fa-search me-2"></i>Mulai Prediksi
                </button>
              <?php echo form_close(); ?>
            </div>
          </div>
        </div>

        <!-- Preview & Result -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4" style="font-family:'Poppins',sans-serif;">
                <i class="fa fa-image me-2"></i>Preview & Hasil
              </h5>
              
              <div class="img-preview-box" id="previewBox">
                <div class="text-center">
                  <i class="fa fa-image fa-3x text-muted mb-3"></i>
                  <p class="text-muted mb-0">Preview gambar akan muncul di sini</p>
                </div>
              </div>
              
              <div id="resultArea" class="mt-3" style="display: none;">
                <div class="result-col">
                  <div class="result-box" id="resultBox">
                    <span id="resultText">Menunggu hasil...</span>
                  </div>
                  <div class="text-center">
                    <small class="text-muted">Confidence: <span id="confidenceText">-</span>%</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');
    const previewBox = document.getElementById('previewBox');
    const predictBtn = document.getElementById('predictBtn');
    const resultArea = document.getElementById('resultArea');
    const resultBox = document.getElementById('resultBox');
    const resultText = document.getElementById('resultText');
    const confidenceText = document.getElementById('confidenceText');

    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            handleFileSelect(files[0]);
        }
    });

    // File input change
    imageInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file.');
            return;
        }

        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB.');
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewBox.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-fluid">`;
            predictBtn.disabled = false;
        };
        reader.readAsDataURL(file);
    }

    // Form submission
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!imageInput.files.length) {
            alert('Please select an image first.');
            return;
        }

        // Show loading state
        predictBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Memproses...';
        predictBtn.disabled = true;
        resultArea.style.display = 'block';
        resultText.textContent = 'Memproses gambar...';
        confidenceText.textContent = '-';

        // Submit form
        const formData = new FormData(this);
        fetch('<?php echo base_url("predict/upload"); ?>', {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                resultText.textContent = data.prediction;
                confidenceText.textContent = data.confidence;
                
                if (data.prediction === 'Normal') {
                    resultBox.className = 'result-box normal';
                } else {
                    resultBox.className = 'result-box pneumonia';
                }
            } else {
                resultText.textContent = 'Error: ' + data.message;
                resultBox.className = 'result-box';
            }
        })
        .catch(error => {
            resultText.textContent = 'Error: ' + error.message;
            resultBox.className = 'result-box';
        })
        .finally(() => {
            predictBtn.innerHTML = '<i class="fa fa-search me-2"></i>Mulai Prediksi';
            predictBtn.disabled = false;
        });
    });
});
</script> 