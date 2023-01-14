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
					<h2>Proses Perhitungan</h2>
					<ol>
						<li><a href="index.php">Home</a></li>
						<li>Proses perhitungan</li>
					</ol>
				</div>
			</div>
		</section><!-- End Breadcrumbs -->
		<section class="inner-page">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Nilai Matriks</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col" rowspan="2">No</th>
											<th scope="col" rowspan="2">Nama lokasi</th>
											<th scope="col" colspan="5">Kriteria</th>
										</tr>
										<tr>
											<th scope="col">C1</th>
											<th scope="col">C2</th>
											<th scope="col">C3</th>
											<th scope="col">C4</th>
											<th scope="col">C5</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$nilaiMatriks = $conn->query("SELECT * FROM penilaian");
										if ($nilaiMatriks->num_rows > 0) {
											while ($row = $nilaiMatriks->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $row['nama']; ?> </td>
													<td><?= $row['lokasi'] ?></td>
													<td><?= $row['kepadatan']; ?></td>
													<td><?= $row['pendapatan']; ?></td>
													<td><?= $row['sarana']; ?></td>
													<td><?= $row['keamanan']; ?></td>
												</tr>
										<?php

											}
										
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Matriks Ternormalisasi</h6>
							</div>
							<div class="card-body">

								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col" rowspan="2">No</th>
											<th scope="col" rowspan="2">Nama</th>
											
											<th scope="col" colspan="5">Kriteria</th>
										</tr>
										<tr>
											<th scope="col">C1</th>
											<th scope="col">C2</th>
											<th scope="col">C3</th>
											<th scope="col">C4</th>
											<th scope="col">C5</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$pembagi1 = null;
										$pembagi2 = null;
										$pembagi3 = null;
										$pembagi4 = null;
										$pembagi5 = null;
										//ram

										//ssd
										$resultlokasi = $conn->query("SELECT lokasi FROM penilaian");

										if ($resultlokasi->num_rows > 0) {
											$hasil = null;
											while ($lokasi = $resultlokasi->fetch_row()) {
												$hasil += pow($lokasi[0], 2);
											}
											$pembagi1 = round(sqrt($hasil), 3);
										}
										//processor
										$resultkepadatan = $conn->query("SELECT kepadatan FROM penilaian");

										if ($resultkepadatan->num_rows > 0) {
											$hasil = null;
											while ($kepadatan = $resultkepadatan->fetch_row()) {
												$hasil += pow($kepadatan[0], 2);
											}
											$pembagi2 = round(sqrt($hasil), 3);
										}

										//ukuran layar
										$resultpendapatan = $conn->query("SELECT pendapatan FROM penilaian");

										if ($resultpendapatan->num_rows > 0) {
											$hasil = null;
											while ($pendapatan = $resultpendapatan->fetch_row()) {
												$hasil += pow($pendapatan[0], 2);
											}
											$pembagi3 = round(sqrt($hasil), 3);
										}
										//harga
										$sarana = $conn->query("SELECT sarana FROM penilaian");

										if ($sarana->num_rows > 0) {
											$hasil = null;
											while ($org = $sarana->fetch_row()) {
												$hasil += pow($org[0], 2);
											}
											$pembagi4 = round(sqrt($hasil), 3);
										}

										$keamanan = $conn->query("SELECT keamanan FROM penilaian");
										if ($keamanan->num_rows > 0) {
											$hasil = null;
											while ($org = $keamanan->fetch_row()) {
												$hasil += pow($org[0], 2);
											}
											$pembagi5 = round(sqrt($hasil), 3);
										}
										//penilaian
										$resultPenilaian = $conn->query("SELECT * FROM penilaian");

										if ($resultPenilaian->num_rows > 0) {
											while ($penilaian = $resultPenilaian->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++;  ?></td>
													<td><?= $penilaian['nama'];  ?></td>
													<td><?= round($penilaian['lokasi'] / $pembagi1, 3) ?></td>
													<td><?= round($penilaian['kepadatan'] / $pembagi2, 3) ?></td>
													<td><?= round($penilaian['pendapatan'] / $pembagi3, 3) ?></td>
													<td><?= round($penilaian['sarana'] / $pembagi4, 3) ?></td><td><?= round($penilaian['keamanan'] / $pembagi5, 3) ?></td>

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
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Nilai bobot ternormalisasi</h6>
							</div>
							<?php echo $pembagi1 . ' ,' . $pembagi2 . ' ,' . $pembagi3 . ' ,' . $pembagi4.','.$pembagi5  ?>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col" rowspan="2">No</th>
											<th scope="col" rowspan="2">Nama</th>
											<th scope="col" colspan="5">Kriteria</th>
										</tr>
										<tr>
											<th scope="col">C1</th>
											<th scope="col">C2</th>
											<th scope="col">C3</th>
											<th scope="col">C4</th>
											<th scope="col">C5</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$c1 = null;
										$c2 = null;
										$c3 = null;
										$c4 = null;
										$c5 = null;
										$resultKriteria = $conn->query("SELECT * FROM kriteria");

										if ($resultKriteria->num_rows > 0) {
											$kriteria = $resultKriteria->fetch_assoc();
											$c1 = $kriteria['lokasi'];
											$c2 = $kriteria['kepadatan'];
											$c3 = $kriteria['pendapatan'];
											$c4 = $kriteria['sarana'];
											$c5 = $kriteria['keamanan'];
										}
										//kosongkat tabel matriks terbobot
										$truncateMatriksTerbobot = $conn->query("TRUNCATE TABLE matriks_terbobot");
										$resultPenilaian = $conn->query("SELECT * FROM penilaian");
										if ($resultPenilaian->num_rows > 0) {
											while ($penilaian = $resultPenilaian->fetch_assoc()) {
												$matriksC1 = round(round(($penilaian['lokasi'] / $pembagi1), 3) * $c1, 3);
												$matriksC2 = round(round(($penilaian['kepadatan'] / $pembagi2), 3) * $c2, 3);
												$matriksC3 = round(round(($penilaian['pendapatan'] / $pembagi3), 3) * $c3, 3);
												$matriksC4 = round(round(($penilaian['sarana'] / $pembagi4), 3) * $c4, 3);
												$matriksC5 = round(round(($penilaian['keamanan'] / $pembagi5), 3) * $c4, 3);

												$nama = $penilaian['nama'];
												//insert tabel matriks terbobot
												$insertMatriks = $conn->query("INSERT INTO matriks_terbobot(nama,c1,c2,c3,c4,c5) VALUES ('$nama','$matriksC1','$matriksC2','$matriksC3','$matriksC4','$matriksC5')");
											}
										}
										$resultMatriksTerbobot = $conn->query("SELECT * FROM matriks_terbobot");
										if ($resultMatriksTerbobot->num_rows > 0) {
											while ($row = $resultMatriksTerbobot->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $row['nama']; ?></td>
													<td><?= $row['c1']; ?></td>
													<td><?= $row['c2']; ?></td>
													<td><?= $row['c3']; ?></td>
													<td><?= $row['c4']; ?></td>
													<td><?= $row['c5']; ?></td>

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

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Matriks ideal postitif (maks)</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">C1</th>
											<th scope="col">C2</th>
											<th scope="col">C3</th>
											<th scope="col">C4</th>
											<th scope="col">C5</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$positifY1 = null;
										$positifY2 = null;
										$positifY3 = null;
										$positifY4 = null;
										$positifY5 = null;


										$positifC1 = $conn->query("SELECT max(c1) FROM matriks_terbobot");
										if ($positifC1->num_rows > 0) {
											$row = $positifC1->fetch_row();
											$positifY1 = $row[0];
										}
										$positifC2 = $conn->query("SELECT max(c2) FROM matriks_terbobot");
										if ($positifC2->num_rows > 0) {
											$row = $positifC2->fetch_row();
											$positifY2 = $row[0];
										}
										$positifC3 = $conn->query("SELECT max(c3) FROM matriks_terbobot");
										if ($positifC3->num_rows > 0) {
											$row = $positifC3->fetch_row();
											$positifY3 = $row[0];
										}
										$positifC4 = $conn->query("SELECT max(c4) FROM matriks_terbobot");
										if ($positifC4->num_rows > 0) {
											$row = $positifC4->fetch_row();
											$positifY4 = $row[0];
										}
										$positifC5 = $conn->query("SELECT max(c5) FROM matriks_terbobot");
										if ($positifC4->num_rows > 0) {
											$row = $positifC5->fetch_row();
											$positifY5 = $row[0];
										}
										?>
										<tr>
											<td><?= $positifY1; ?></td>
											<td><?= $positifY2; ?></td>
											<td><?= $positifY3; ?></td>
											<td><?= $positifY4; ?></td>
											<td><?= $positifY5; ?></td>

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Matriks ideal negatif (min)</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">C1</th>
											<th scope="col">C2</th>
											<th scope="col">C3</th>
											<th scope="col">C4</th>
											<th scope="col">C5</th>

										</tr>
									</thead>
									<tbody>
										<?php
										$negatifY1 = null;
										$negatifY2 = null;
										$negatifY3 = null;
										$negatifY4 = null;
										$negatifY5 = null;


										$negatifC1 = $conn->query("SELECT min(c1) FROM matriks_terbobot");
										if ($negatifC1->num_rows > 0) {
											$row = $negatifC1->fetch_row();
											$negatifY1 = $row[0];
										}
										$negatifC2 = $conn->query("SELECT min(c2) FROM matriks_terbobot");
										if ($negatifC2->num_rows > 0) {
											$row = $negatifC2->fetch_row();
											$negatifY2 = $row[0];
										}
										$negatifC3 = $conn->query("SELECT min(c3) FROM matriks_terbobot");
										if ($negatifC3->num_rows > 0) {
											$row = $negatifC3->fetch_row();
											$negatifY3 = $row[0];
										}
										$negatifC4 = $conn->query("SELECT min(c4) FROM matriks_terbobot");
										if ($negatifC4->num_rows > 0) {
											$row = $negatifC4->fetch_row();
											$negatifY4 = $row[0];
										}
										$negatifC5 = $conn->query("SELECT min(c5) FROM matriks_terbobot");
										if ($negatifC5->num_rows > 0) {
											$row = $negatifC5->fetch_row();
											$negatifY5 = $row[0];
										}

										?>
										<tr>
											<td><?= $negatifY1; ?></td>
											<td><?= $negatifY2; ?></td>
											<td><?= $negatifY3; ?></td>
											<td><?= $negatifY4; ?></td>
											<td><?= $negatifY5; ?></td>

										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Jarak Solusi Ideal Postitif (D<sup>+</sup>)</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama lokasi</th>
											<th scope="col">D<sup>+</sup></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$jarakPositif = [];
										$no = 1;
										$resultMatriksTerbobot = $conn->query("SELECT * FROM matriks_terbobot");
										if ($resultMatriksTerbobot->num_rows > 0) {
											while ($row = $resultMatriksTerbobot->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $row['nama']; ?></td>
													<td><?= $positif = round(sqrt(pow($row['c1'] - $positifY1, 2) + pow($row['c2'] - $positifY2, 2) + pow($row['c3'] - $positifY3, 2) + pow($row['c4'] - $positifY4, 2) + pow($row['c5'] - $positifY5, 2)), 3) ?></td>
												</tr>
										<?php
												array_push($jarakPositif, $positif);
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Jarak Solusi Ideal Negatif (D<sup>-</sup>)</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama lokasi</th>
											<th scope="col">D<sup>-</sup></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$jarakNegatif = [];
										$no = 1;
										$resultMatriksTerbobot = $conn->query("SELECT * FROM matriks_terbobot");
										if ($resultMatriksTerbobot->num_rows > 0) {
											while ($row = $resultMatriksTerbobot->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++; ?></td>
													<td><?= $row['nama']; ?></td>
													<td><?= $negatif = round(sqrt(pow($row['c1'] - $negatifY1, 2) + pow($row['c2'] - $negatifY2, 2) + pow($row['c3'] - $negatifY3, 2) + pow($row['c4'] - $negatifY4, 2) + pow($row['c5'] - $negatifY5, 2)), 3) ?></td>
												</tr>
										<?php
												array_push($jarakNegatif, $negatif);
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Nilai Preferensi</h6>
							</div>
							<div class="card-body">
								<?php print_r($negatif) ?>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama lokasi</th>
											<th scope="col">Nilai Preferensi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										$order = 1;
										$truncatePreferensi = $conn->query("TRUNCATE TABLE preferensi");
										$resultMatriksTerbobot = $conn->query("SELECT * FROM matriks_terbobot");
										if ($resultMatriksTerbobot->num_rows > 0) {
											while ($row = $resultMatriksTerbobot->fetch_assoc()) {
												$nilai1Preferensi = round($jarakNegatif[$order - 1] / ($jarakNegatif[$order - 1] + $jarakPositif[$order - 1]), 4);
												$order++;
												$nama = $row['nama'];
												$insertPreferensi = $conn->query("INSERT INTO preferensi(nama,nilai_preferensi) VALUES ('$nama','$nilai1Preferensi')");
											}
										}
										$resultPreferensi = $conn->query("SELECT * FROM preferensi");
										if ($resultPreferensi->num_rows > 0) {
											while ($row = $resultPreferensi->fetch_assoc()) {
										?>

												<tr>
													<td><?= $no++;   ?></td>
												
													<td><?= $row['nama'];   ?></td>
													<td><?= $row['nilai_preferensi'];   ?></td>
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
<?php } ?>
					<div class="col-lg-12">
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Hasil Perengkingan</h6>
							</div>
							<div class="card-body">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">No</th>
									
											<th scope="col">Nama lokasi</th>
											<th scope="col">Nilai </th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;

										$resultPreferensi = $conn->query("SELECT * FROM preferensi ORDER BY nilai_preferensi DESC");
										if ($resultPreferensi->num_rows > 0) {
											while ($row = $resultPreferensi->fetch_assoc()) {
										?>
												<tr>
													<td><?= $no++;   ?></td>
													
													<td><?= $row['nama'];   ?></td>
													<td><?= $row['nilai_preferensi'];   ?></td>
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