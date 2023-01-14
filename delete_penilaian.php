<?php 
include 'koneksi.php';
$id = $_GET['id'];
$query = $conn->query("DELETE FROM penilaian WHERE id='$id'");

if (!$query) 
	{
		echo "<script>
		alert('data gagal dihapus');
		window.location.href = 'penilaian.php';
		</script>";
	}
	else
	{
		echo "<script>
		alert('data berhasil dihapus');
		window.location.href = 'penilaian.php';
		</script>";
	}
?>