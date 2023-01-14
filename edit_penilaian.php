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
if (isset($_POST['edit'])) {
	$nama = $_POST['nama'];
	$lokasi = $_POST['lokasi'];
	$kepadatan = $_POST['kepadatan'];
	$pendapatan = $_POST['pendapatan'];
	$sarana = $_POST['sarana'];
	$keamanan = $_POST['keamanan'];
	$id=$_GET['id'];

	$query = $conn->query("UPDATE penilaian SET  nama='$nama',lokasi='$lokasi', kepadatan='$kepadatan', pendapatan='$pendapatan',sarana='$sarana',keamanan='$keamanan'  WHERE id='$id'");

	if (!$query) {
		
		echo "<script>
		alert('data gagal diedit');
		window.location.href = 'edit_penilaian.php';
		</script>";
	}
	else
	{
		
		echo "<script>
		alert('data berhasil diedit');
		window.location.href = 'penilaian.php';
		</script>";
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
						<?php 
						$id = $_GET['id'];
						$penilaian = $conn->query("SELECT * FROM penilaian WHERE id='$id'");
						if ($penilaian->num_rows > 0) {
							while($row = $penilaian->fetch_assoc()){
								$nama = $row['nama'];
						?>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-4 col-from-label">Nama lokasi</label>
							<div class="col-sm-8">
								<select class="form-control" name="nama">
									
												<option value="<?= $row['nama']; ?>"><?= $row['nama'];?>
											
								</select>
							</div>
						</div>
						<div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">lokasi strategis</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="lokasi">
                        <option value="5">Sangat strategis</option>
                        <option value="4">Strategis</option>
                        <option value="3">Cukup strategis</option>
                        <option value="2">Kurang strategis</option>
                        <option value="1">Tidak strategis</option>
                      </select>
                    </div>
                  </div>
						<div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Kepadatan penduduk sekitar</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="kepadatan">
                        <option value="5">Sangat padat</option>
                        <option value="4">Padat</option>
                        <option value="3">Cukup padat</option>
                        <option value="2">Kurang padat</option>
                        <option value="1">Kurang Penduduk</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Pendapatan penduduk</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="pendapatan">
                        <option value="5"><?= htmlentities('>5.000.000')?></option>
                        <option value="4"><?= htmlentities('>4.000.000-5.000.000') ?></option>
                        <option value="3"><?= htmlentities('>3.000.000-4.000.000') ?></option>
                        <option value="2"><?= htmlentities('>2.000.000-3.000.000') ?></option>
                        <option value="1"><?= htmlentities('<2.000.000') ?></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Kedekatan sarana umum</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="sarana">
                        <option value="5">Sangat Dekat (dapat dijangkau dengan jalan kaki sekitar 3 menit)</option>
                        <option value="4">Dekat (dapat dijangkau dengan jalan kaki sekitar 7 menit)</option>
                        <option value="3">Cukup dekat (dapat dijangkau dengan jalan kaki sekitar 10 menit)</option>
                        <option value="2">Jauh (dapat dijangkau dengan jalan kaki sekitar 30 menit)</option>
                        <option value="1">sangat jauh (dapat dijangkau dengan kendaraan lain)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-4 col-from-label">Keamanan lokasi</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="keamanan">
                        <option value="5">Sangat aman </option>
                        <option value="4">Aman`</option>
                        <option value="3">Cukup aman</option>
                        <option value="2">Kurang aman</option>
                        <option value="1">Tidak aman </option>
                      </select>
                    </div>
                  </div>
						<button type="submit" name="edit" class="btn btn-primary">Edit</button>
						<?php 
							}
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

    </section>

  </main><!-- End #main -->
  <?php include 'template/footer.php' ?>
</body>