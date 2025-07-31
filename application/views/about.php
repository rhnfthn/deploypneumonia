<style>
.step-circle {
  width: 44px; height: 44px; background: #26b7b7; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; font-weight: 700; margin-bottom: 8px; box-shadow: 0 2px 8px 0 rgba(38,183,183,0.13);
}
.step-desc { font-size: 0.98rem; color: #444; }
@media (max-width: 767px) {
  .step-circle { width: 36px; height: 36px; font-size: 1.1rem; }
  .step-desc { font-size: 0.93rem; }
}
.cara-list .cara-bullet {
  display: flex; align-items: center; justify-content: center;
  width: 36px; height: 36px; background: #26b7b7; color: #fff; border-radius: 50%; font-size: 1.18rem; font-weight: 700;
  box-shadow: 0 2px 8px 0 rgba(38,183,183,0.13);
}
</style>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">
          <i class="fa fa-info-circle me-3"></i>Tentang Aplikasi
        </h1>
        <p class="lead" style="font-family:'Lato',sans-serif;max-width:600px;margin:0 auto;">Informasi teknologi dan fitur yang digunakan dalam aplikasi PneumoDetect</p>
      </div>

      <!-- Tentang Aplikasi -->
      <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-5">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h4 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Tentang Aplikasi</h4>
              <p class="lead mb-0" style="font-family:'Lato',sans-serif;font-size:1.1rem;">
                Aplikasi ini adalah sistem cerdas berbasis deep learning untuk mendeteksi pneumonia dari citra X-ray paru-paru. 
                Dirancang untuk membantu skrining awal dan edukasi kesehatan, aplikasi ini mudah digunakan, cepat, dan menjaga privasi data pengguna.
              </p>
            </div>
            <div class="col-md-4 text-center">
              <div class="mx-auto d-flex align-items-center justify-content-center" style="width:120px;height:120px;background:var(--primary-light);border-radius:50%;">
                <i class="fa fa-lungs fa-3x text-white"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Teknologi Yang Digunakan -->
      <div class="text-center mb-4">
        <h3 class="fw-bold" style="font-family:'Poppins',sans-serif;">Teknologi Yang Digunakan</h3>
      </div>

      <div class="row g-4">
        <!-- CNN -->
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 text-center p-4" style="border-radius:20px;">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px;height:80px;background:#20B2AA;border-radius:50%;">
              <i class="fa fa-mountain fa-2x text-white"></i>
            </div>
            <h5 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">CNN</h5>
            <p class="mb-0" style="font-family:'Lato',sans-serif;">
              Convolutional Neural Network, teknologi deep learning yang sangat efektif untuk mengenali pola dan fitur pada citra X-ray.
            </p>
          </div>
        </div>

        <!-- Flask -->
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 text-center p-4" style="border-radius:20px;">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px;height:80px;background:#20B2AA;border-radius:50%;">
              <i class="fa fa-flask fa-2x text-white"></i>
            </div>
            <h5 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Flask</h5>
            <p class="mb-0" style="font-family:'Lato',sans-serif;">
              Framework web Python yang ringan dan fleksibel, digunakan untuk membangun backend aplikasi ini.
            </p>
          </div>
        </div>

        <!-- Python -->
        <div class="col-md-4">
          <div class="card border-0 shadow-sm h-100 text-center p-4" style="border-radius:20px;">
            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:80px;height:80px;background:#20B2AA;border-radius:50%;">
              <i class="fa fa-code fa-2x text-white"></i>
            </div>
            <h5 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Python</h5>
            <p class="mb-0" style="font-family:'Lato',sans-serif;">
              Bahasa pemrograman populer yang digunakan untuk pengolahan data, machine learning, dan AI.
            </p>
          </div>
        </div>
      </div>

      <!-- Fitur Utama -->
      <div class="mt-5">
        <div class="text-center mb-4">
          <h3 class="fw-bold" style="font-family:'Poppins',sans-serif;">Fitur Utama</h3>
        </div>

        <div class="row g-4">
          <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:20px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--primary-light);border-radius:50%;">
                    <i class="fa fa-upload fa-lg text-white"></i>
                  </div>
                  <h5 class="fw-bold mb-0" style="font-family:'Poppins',sans-serif;">Upload Mudah</h5>
                </div>
                <p class="mb-0" style="font-family:'Lato',sans-serif;">
                  Upload citra X-ray dengan mudah melalui drag & drop atau klik file. Mendukung format JPG, PNG, dan GIF.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:20px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--success-light);border-radius:50%;">
                    <i class="fa fa-bolt fa-lg text-white"></i>
                  </div>
                  <h5 class="fw-bold mb-0" style="font-family:'Poppins',sans-serif;">Hasil Cepat</h5>
                </div>
                <p class="mb-0" style="font-family:'Lato',sans-serif;">
                  Analisis citra X-ray dalam hitungan detik dengan hasil yang akurat dan terpercaya.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:20px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--warning-light);border-radius:50%;">
                    <i class="fa fa-shield-alt fa-lg text-white"></i>
                  </div>
                  <h5 class="fw-bold mb-0" style="font-family:'Poppins',sans-serif;">Aman & Privat</h5>
                </div>
                <p class="mb-0" style="font-family:'Lato',sans-serif;">
                  Data citra Anda diproses secara aman dan tidak disimpan di server kami untuk menjaga privasi.
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:20px;">
              <div class="card-body p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="me-3 d-flex align-items-center justify-content-center" style="width:50px;height:50px;background:var(--danger-light);border-radius:50%;">
                    <i class="fa fa-chart-line fa-lg text-white"></i>
                  </div>
                  <h5 class="fw-bold mb-0" style="font-family:'Poppins',sans-serif;">Akurasi Tinggi</h5>
                </div>
                <p class="mb-0" style="font-family:'Lato',sans-serif;">
                  Menggunakan model VGG-16 yang telah dilatih dengan ribuan citra X-ray untuk akurasi maksimal.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="text-center mt-5">
        <div class="card border-0 shadow-sm" style="border-radius:28px;background:linear-gradient(135deg, var(--primary-light), #20B2AA);">
          <div class="card-body p-5 text-white">
            <h4 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Mulai Deteksi Pneumonia Sekarang</h4>
            <p class="lead mb-4" style="font-family:'Lato',sans-serif;">Gunakan aplikasi kami untuk deteksi dini pneumonia dari citra X-ray paru-paru</p>
            <a href="<?php echo base_url('predict'); ?>" class="btn btn-light btn-lg px-5 py-3" style="border-radius:28px;font-weight:600;">
              <i class="fa fa-search me-2"></i>Mulai Prediksi
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 