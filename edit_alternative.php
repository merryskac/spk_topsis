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
	$id = $_GET['id'];
	$lokasi = $_POST['lokasi'];
	
	$query = $conn->query("UPDATE alternative SET lokasi='$lokasi'WHERE id='$id'");

	if (!$query) 
	{
		echo "<script>
		alert('data gagal diubah');
		</script>";
	}
	else
	{
		echo "<script>
		alert('data berhasil diubah');
		window.location.href = 'alternative.php';
		</script>";
	}
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Input Alternative</h6>
				</div>
				<div class="card-body">
					<form method="POST">
						<?php 
						$id = $_GET['id'];
						$query = $conn->query ("SELECT * FROM alternative WHERE id='$id'");
						if ($query->num_rows > 0) {
							$row = $query->fetch_assoc();
						?>
						<div class="form-group row">
							<label for="inputPassword" class="col-sm-4 col-from-label">Nama lokasi</label>
							<div class="col-sm-8">
								<input type="text" name="lokasi" class="form-control" placeholder="Nama Lokasi" required value="<?= $row['lokasi'];?>">
							</div>
						</div>
						
					<?php } ?>
						<button type="submit" name="edit" class="btn btn-primary">Edit</button>
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
