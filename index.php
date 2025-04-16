<?php
//Cek apakah tombol "hitung" telah diklik
if (isset($_POST['hitung'])) {
	//Ambil nilai harga asli dari input, lalu ubah tanda titik menjadi kosong dan koma menjadi titik
	//Tujuannya agar bisa di konversi ke format float meskipun pengguna memasukan format Indonesia
	$harga_asli = str_replace(['.', ','], ['', '.'], $_POST['harga_asli']);
	//Validasi apakah input harga asli adalah angka bukan berupa huruf
	if (!is_numeric($harga_asli)) {
		$error = "Format harga asli tidak valid";
	} else {
		$harga_asli = (float) $harga_asli;//Konversi menjadi float
	}
	//Ambil nilai diskon dari input dan ubah koma menjadi titik agar sesuai format angka
	$diskon = str_replace(',', '.', $_POST['diskon']);
	//Validasi apakah diskon adalah angka
	if (!is_numeric($diskon)) {
		$error = "Format diskon tidak valid";
	} elseif ($diskon > 100) {
		$error = "Diskon tidak boleh lebih dari 100%";
	} else {
		$diskon = (float) $diskon;//Konversi menjadi float
	}
	//Jika tidak ada error, lakukan perhitungan diskon
	if (!isset($error)) {
		$potongan = ($harga_asli * $diskon) / 100;//Hitung potongan harga
		$harga_setelah_diskon = $harga_asli - $potongan;//Hitung harga setelah diskon
	}
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hitung Diskon</title>
	<!--Menggunakan Bootstrap versi 5.3.2 untuk styling-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
	<!--Kartu utama hitung diskon-->
	<div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px;">
		<h3 class="text-center mb-4 text-primary">Hitung Diskon</h3>
		<!--Form input data-->
		<form method="post" action="">
			<div class="mb-3">
				<label for="harga_asli" class="form-label">Harga Asli (Rp)</label>
				<input type="text" class="form-control" name="harga_asli" required>
			</div>
			<div class="mb-3">
				<label for="diskon" class="form-label">Diskon (%)</label>
				<input type="text" class="form-control" name="diskon" required>
			</div>
			<!--Tombol Hitung dan Reset-->
			<div class="d-flex gap-2">
				<button type="submit" name="hitung" class="btn btn-primary w-50">Hitung</button>
				<!--Tombol reset juga melakukan reload halaman-->
				<button type="reset" class="btn btn-secondary w-50" onclick="window.location.href='';">Reset</button>
			</div>
		</form>
		<!--Menampilkan pesan error jika ada-->
		<?php if (isset($error)): ?>
			<div class="alert alert-danger mt-3" role="alert">
				<?= $error; ?>
			</div>
			<!--Menampilkan hasil perhitungan jika tidak ada error-->
		<?php elseif (isset($harga_setelah_diskon)): ?>
			<div class="alert alert-success mt-3" role="alert">
				<strong>Harga Asli:</strong> Rp <?= number_format($harga_asli, 2, ',', '.') ?><br>
				<strong>Potongan Harga:</strong> Rp <?= number_format($potongan, 2, ',', '.') ?><br>
				<strong>Harga Setelah Diskon:</strong> Rp <?= number_format($harga_setelah_diskon, 2, ',', '.') ?>
			</div>
		<?php endif; ?>
	</div>
</body>

</html>
