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
          <h2>Data Alternatif</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Data alternatif</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">


      <?php
      if (isset($_POST['simpan'])) {
        $lokasi = $_POST['lokasi'];
        $query = $conn->query("INSERT INTO alternative(lokasi) VALUES ('$lokasi')");
        if (!$query) {
          echo "<script>
		alert('Data gagal disimpan');
		window.location.href='alternative.php';
		</script>";
        } else {
          echo "<script>
		alert('Data berhasil disimpan');
		window.location.href='alternative.php';
		</script>";
        }
      }
      ?>
      <div class="container">
        <div class="row">

        <?php if($_SESSION['role']=='admin'){ ?>
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Alternative</h6>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Nama lokasi</label>
                    <div class="col-sm-8">
                      <input type="text" name="lokasi" class="form-control" placeholder="Nama lokasi" required>
                    </div>
                  </div>
                  <br>
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
          </div>
<?php } ?>
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Alternative</h6>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama lokasi</th>
                      <th scope="col">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = $conn->query("SELECT * FROM alternative");
                    if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $row['lokasi']; ?></td>

                          
                          <td>
                            <a href="edit_alternative.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_alternative.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Data ingin dihapus?')">Delete</a>
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