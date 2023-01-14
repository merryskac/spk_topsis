<?php
session_start();
include 'template/header.php';
include 'koneksi.php'
?>

<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Data Bobot Kriteria</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Data kriteria</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
      <?php
      if (isset($_POST['simpan'])) {
        $lokasi = $_POST['lokasi'];
        $kepadatan = $_POST['kepadatan'];
        $keamanan = $_POST['keamanan'];
        $pendapatan = $_POST['pendapatan'];
        $sarana = $_POST['sarana'];

        $query = $conn->query("SELECT * FROM kriteria");

        if ($query->num_rows > 0) {

          echo "<script>
		alert('bobot hanya boleh satu');
		window.location.href = 'kriteria.php';
		</script>";
        } else {
          $query = $conn->query("INSERT INTO kriteria(lokasi,kepadatan,pendapatan,sarana,keamanan) VALUES ('$lokasi','$kepadatan','$pendapatan','$sarana',$keamanan)");

          if (!$query) {
            echo "<script>
			alert('data gagal disimpan');
			window.location.href = 'kriteria.php';
			</script>";
          } else {
            echo "<script>
			alert('data berhasil disimpan');
			window.location.href = 'kriteria.php';
			</script>";
          }
        }
      }
      ?>
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Bobot</h6>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">lokasi strategis</label>
                    <div class="col-sm-8">
                      <input type="text" name="lokasi" class="form-control" placeholder="lokasi" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">kepadatan penduduk sekitar</label>
                    <div class="col-sm-8">
                      <input type="text" name="kepadatan" class="form-control" placeholder="kepadatan" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">pendapatan masyarakat sekitar lokasi</label>
                    <div class="col-sm-8">
                      <input type="text" name="pendapatan" class="form-control" placeholder="pendapatan mengulang" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Kedekatan dengan sarana umum</label>
                    <div class="col-sm-8">
                      <input type="text" name="sarana" class="form-control" placeholder="sarana" required>
                    </div>
                  </div>
                  <br>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">tingkat keamanan yang mendukung</label>
                    <div class="col-sm-8">
                      <input type="text" name="keamanan" class="form-control" placeholder="keamanan" required>
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Kriteria</h6>
              </div>
              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Lokasi strategis</th>
                      <th scope="col">kepadatan penduduk</th>
                      <th scope="col">pendapatan masyarakat</th>
                      <th scope="col">Sarana umum</th>
                      <th scope="col">Keamanan lokasi</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = $conn->query("SELECT * FROM kriteria");
                    if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['lokasi']; ?></td>
                          <td><?= $row['kepadatan']; ?></td>
                          <td><?= $row['pendapatan']; ?></td>
                          <td><?= $row['sarana']; ?></td>
                          <td><?= $row['keamanan']; ?></td>
                          <td>
                            <a href="delete_kriteria.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Data ingin dihapus?')">Delete</a>
                          </td>
                        </tr>
                    <?php
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>