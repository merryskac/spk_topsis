<?php
session_start();
include 'template/header.php';
include 'koneksi.php'
?>
<?php
if($_SESSION['role']!='admin'){
  die ("Anda tidak dikenal. <a href='index.php'>Kembali</a>");
}
if(!isset($_GET['code'])){
  die ("Anda tidak dikenal. <a href='index.php'>Kembali</a>");
}
if($_GET['code']!='abc123'){
  die ("Anda tidak dikenal. <a href='index.php'>Kembali</a>");
}
?>
<body>
  <?php include 'template/nav.php' ?>
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Data Akun</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Data akun</li>
          </ol>
        </div>
      </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">


      <?php
      if (isset($_POST['simpan'])) {
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $query = $conn->query("INSERT INTO alternative(nim,nama) VALUES ('$nim','$nama')");
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
          <div class="col-lg-8">
            
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Alternative</h6>
              </div>
              <div id="halo">halo</div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">username</th>
                      <th scope="col">Nama</th>
                      <th scope="col">role</th>
                      <th scope="col">eligible</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = $conn->query("SELECT * FROM akun WHERE `role`='user'");
                    if ($query->num_rows > 0) {
                      while ($row = $query->fetch_assoc()) {
                    ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $username =$row['username']; ?></td>
                          <td><?= $row['nama']; ?></td>
                          <td><?= $row['role']; ?></td>
                          <td>
                            <select name="eligible" id="eligible" onchange=update()>
                              <option value="1">1</option>
                              <option value="0" >0</option>
                            </select>
                          </td>
                          <script>
                            function update(){
                            var x = document.getElementById('eligible').value;
                            if(x == '1'){
                              <?php $conn->query("UPDATE akun SET eligible='1' WHERE username='$username'");?>
                              document.getElementById("halo").innerHTML = x;
                            }else{
                              <?php $conn->query("UPDATE akun SET eligible='0' WHERE username='$username'");?>
                            }
                          }
                            
                          </script>
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