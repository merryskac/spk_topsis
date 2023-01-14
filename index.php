<?php include 'template/header.php';
session_start() ?>

<body>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-9 text-center">
          <?php if (isset($_SESSION['nama'])) { ?>
            <h4>Selamat datang, <?= $_SESSION['nama'] ?></h4>
          <?php } ?>
          <h1>Sistem Pendukung Keputusan Pemilihan Lokasi</h1>
          <h2>Sistem pendukung keputusan Pemilihan Lokasi Terbaik Untuk Pendirian Grosir Pulsa dengan metode TOPSIS</h2>
        </div>
      </div>
      <div class="text-center">
          <a href="proses.php" class="btn-get-started scrollto">Cek data
          </a>
        
          
      </div>

      <div class="row icon-boxes">
        <p></p>
      </div>
    </div>



    </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">


  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>