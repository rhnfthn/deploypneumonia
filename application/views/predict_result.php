<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Hasil Prediksi</h1>
        <p class="lead" style="font-family:'Lato',sans-serif;">Analisis citra X-ray telah selesai</p>
      </div>

      <div class="row g-4">
        <!-- Image Preview -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4" style="font-family:'Poppins',sans-serif;">
                <i class="fa fa-image me-2"></i>Citra X-Ray
              </h5>
              
              <div class="img-preview-box">
                <img src="<?php echo base_url($result['image_path']); ?>" alt="X-Ray Image" class="img-fluid">
              </div>
              
              <div class="text-center mt-3">
                <small class="text-muted">Uploaded: <?php echo $result['timestamp']; ?></small>
              </div>
            </div>
          </div>
        </div>

        <!-- Prediction Result -->
        <div class="col-md-6">
          <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
              <h5 class="fw-bold mb-4" style="font-family:'Poppins',sans-serif;">
                <i class="fa fa-chart-line me-2"></i>Hasil Analisis
              </h5>
              
              <div class="result-col">
                <div class="result-box <?php echo strtolower($result['prediction']); ?>">
                  <span class="fw-bold"><?php echo $result['prediction']; ?></span>
                </div>
                
                <div class="text-center mb-3">
                  <h6 class="fw-bold mb-2">Confidence Level</h6>
                  <div class="progress" style="height: 25px; border-radius: 15px;">
                    <div class="progress-bar <?php echo ($result['prediction'] == 'Normal') ? 'bg-success' : 'bg-danger'; ?>" 
                         role="progressbar" 
                         style="width: <?php echo $result['confidence']; ?>%; border-radius: 15px;"
                         aria-valuenow="<?php echo $result['confidence']; ?>" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                      <?php echo $result['confidence']; ?>%
                    </div>
                  </div>
                </div>
                
                <div class="text-center">
                  <small class="text-muted">
                    <?php if($result['prediction'] == 'Normal'): ?>
                      <i class="fa fa-check-circle text-success me-1"></i>
                      Paru-paru terlihat normal
                    <?php else: ?>
                      <i class="fa fa-exclamation-triangle text-danger me-1"></i>
                      Terdeteksi tanda-tanda pneumonia
                    <?php endif; ?>
                  </small>
                </div>
              </div>
              
              <!-- Recommendations -->
              <div class="mt-4">
                <h6 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">
                  <i class="fa fa-lightbulb me-2"></i>Rekomendasi
                </h6>
                
                <?php if($result['prediction'] == 'Normal'): ?>
                  <div class="alert alert-success">
                    <h6 class="alert-heading"><i class="fa fa-thumbs-up me-2"></i>Hasil Normal</h6>
                    <p class="mb-2">Berdasarkan analisis AI, citra X-ray menunjukkan kondisi paru-paru yang normal.</p>
                    <hr>
                    <p class="mb-0 small">
                      <strong>Catatan:</strong> Hasil ini hanya sebagai referensi. Untuk diagnosis yang akurat, 
                      konsultasikan dengan dokter spesialis.
                    </p>
                  </div>
                <?php else: ?>
                  <div class="alert alert-warning">
                    <h6 class="alert-heading"><i class="fa fa-exclamation-triangle me-2"></i>Terdeteksi Pneumonia</h6>
                    <p class="mb-2">AI mendeteksi kemungkinan pneumonia pada citra X-ray ini.</p>
                    <hr>
                    <p class="mb-0 small">
                      <strong>Langkah selanjutnya:</strong>
                      <ul class="mb-0 mt-2">
                        <li>Segera konsultasi dengan dokter spesialis paru</li>
                        <li>Lakukan pemeriksaan lebih lanjut</li>
                        <li>Ikuti pengobatan yang direkomendasikan</li>
                      </ul>
                    </p>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Action Buttons -->
      <div class="row mt-4">
        <div class="col-12 text-center">
          <a href="<?php echo base_url('predict'); ?>" class="btn btn-primary me-3">
            <i class="fa fa-upload me-2"></i>Upload Gambar Baru
          </a>
          <a href="<?php echo base_url('pneumonia-info'); ?>" class="btn btn-outline-primary">
            <i class="fa fa-info-circle me-2"></i>Pelajari Lebih Lanjut
          </a>
        </div>
      </div>
    </div>
  </div>
</div> 