<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="text-center mb-5">
        <h1 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">
          <i class="fa fa-question-circle me-3"></i>FAQ - Pertanyaan Umum
        </h1>
        <p class="lead" style="font-family:'Lato',sans-serif;max-width:600px;margin:0 auto;">Pertanyaan yang sering diajukan tentang aplikasi PneumoDetect</p>
      </div>

      <!-- FAQ Accordion -->
      <div class="accordion" id="faqAccordion">
        <!-- FAQ 1 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Apa itu aplikasi deteksi pneumonia ini?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq1" class="collapse show" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              Aplikasi ini adalah sistem berbasis web yang menggunakan kecerdasan buatan (AI) untuk mendeteksi kemungkinan pneumonia dari citra rontgen dada (X-ray) secara otomatis dan edukatif.
            </div>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Bagaimana cara menggunakan fitur prediksi?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              <ol>
                <li>Klik menu "Prediksi" di navigasi</li>
                <li>Upload citra X-ray paru-paru (format JPG, PNG, GIF)</li>
                <li>Pastikan ukuran file maksimal 2MB</li>
                <li>Klik tombol "Mulai Prediksi"</li>
                <li>Tunggu hasil analisis yang akan muncul dalam beberapa detik</li>
              </ol>
            </div>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Apakah hasil deteksi ini bisa dijadikan diagnosis medis?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              <strong>Tidak.</strong> Hasil deteksi ini hanya untuk skrining awal dan edukasi. Untuk diagnosis medis yang akurat, selalu konsultasikan dengan dokter atau tenaga medis profesional. Aplikasi ini dirancang untuk membantu deteksi dini, bukan menggantikan pemeriksaan medis.
            </div>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Apakah data dan gambar saya aman?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              <strong>Ya.</strong> Kami sangat memperhatikan privasi dan keamanan data Anda. Citra X-ray yang diupload hanya diproses untuk analisis dan tidak disimpan secara permanen di server kami. Semua data dihapus setelah proses prediksi selesai.
            </div>
          </div>
        </div>

        <!-- FAQ 5 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Format gambar apa yang didukung?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq5" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              Aplikasi mendukung format gambar berikut:
              <ul>
                <li>JPG/JPEG</li>
                <li>PNG</li>
                <li>GIF</li>
              </ul>
              <strong>Ukuran maksimal:</strong> 2MB per file
            </div>
          </div>
        </div>

        <!-- FAQ 6 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Berapa lama waktu yang dibutuhkan untuk analisis?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq6" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              Proses analisis biasanya memakan waktu 5-15 detik, tergantung pada ukuran file dan kecepatan internet Anda. Sistem AI kami dirancang untuk memberikan hasil yang cepat namun tetap akurat.
            </div>
          </div>
        </div>

        <!-- FAQ 7 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Apa yang harus saya lakukan jika hasil menunjukkan pneumonia?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq7" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              Jika hasil menunjukkan kemungkinan pneumonia:
              <ul>
                <li>Jangan panik, ini hanya skrining awal</li>
                <li>Segera konsultasikan ke dokter atau tenaga medis</li>
                <li>Bawa hasil X-ray asli untuk pemeriksaan lebih lanjut</li>
                <li>Ikuti saran dan pengobatan dari dokter</li>
                <li>Jaga pola hidup sehat dan istirahat yang cukup</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- FAQ 8 -->
        <div class="card border-0 shadow-sm mb-3" style="border-radius:16px;">
          <div class="card-header bg-white" style="border-radius:16px 16px 0 0;border:none;">
            <h5 class="mb-0">
              <button class="btn btn-link text-decoration-none w-100 text-start fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8" style="font-family:'Poppins',sans-serif;color:var(--text-main-light);">
                <i class="fa fa-question-circle me-2 text-primary"></i>
                Apakah aplikasi ini gratis?
                <i class="fa fa-chevron-down float-end"></i>
              </button>
            </h5>
          </div>
          <div id="faq8" class="collapse" data-bs-parent="#faqAccordion">
            <div class="card-body" style="font-family:'Lato',sans-serif;">
              <strong>Ya.</strong> Aplikasi PneumoDetect sepenuhnya gratis untuk digunakan. Kami berkomitmen untuk memberikan akses ke teknologi AI kesehatan yang terjangkau bagi semua orang.
            </div>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="text-center mt-5">
        <div class="card border-0 shadow-sm" style="border-radius:28px;background:linear-gradient(135deg, var(--primary-light), #20B2AA);">
          <div class="card-body p-5 text-white">
            <h4 class="fw-bold mb-3" style="font-family:'Poppins',sans-serif;">Masih Ada Pertanyaan?</h4>
            <p class="lead mb-4" style="font-family:'Lato',sans-serif;">Jika Anda memiliki pertanyaan lain, silakan hubungi tim support kami</p>
            <a href="<?php echo base_url('predict'); ?>" class="btn btn-light btn-lg px-5 py-3 me-3" style="border-radius:28px;font-weight:600;">
              <i class="fa fa-search me-2"></i>Coba Prediksi
            </a>
            <a href="<?php echo base_url('pneumonia-info'); ?>" class="btn btn-outline-light btn-lg px-5 py-3" style="border-radius:28px;font-weight:600;">
              <i class="fa fa-info-circle me-2"></i>Pelajari Pneumonia
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.btn-link:hover {
  background-color: var(--bg-main-light) !important;
  border-radius: 16px;
}

.btn-link:focus {
  box-shadow: none !important;
}

.card-header button[aria-expanded="true"] .fa-chevron-down {
  transform: rotate(180deg);
  transition: transform 0.3s ease;
}

.fa-chevron-down {
  transition: transform 0.3s ease;
}
</style> 