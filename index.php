<?php
if (isset($_POST['hitung'])) {
    $harga_asli = str_replace(['.', ','], ['', '.'], $_POST['harga_asli']);
    if (!is_numeric($harga_asli)) {
        $error = "Format harga asli tidak valid";
    } else {
        $harga_asli = (float) $harga_asli;
    }
    
    $diskon = str_replace(',', '.', $_POST['diskon']);
    if (!is_numeric($diskon)) {
        $error = "Format diskon tidak valid";
    } else {
        $diskon = (float) $diskon;
    }
    
    if (!isset($error)) {
        $potongan = ($harga_asli * $diskon) / 100;
        $harga_setelah_diskon = $harga_asli - $potongan;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px;">
        <h3 class="text-center mb-4 text-primary">Kalkulator Diskon</h3>
        <form method="post" action="">
            <div class="mb-3">
                <label for="harga_asli" class="form-label">Harga Asli (Rp)</label>
                <input type="text" class="form-control" name="harga_asli" required>
            </div>
            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon (%)</label>
                <input type="text" class="form-control" name="diskon" required>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" name="hitung" class="btn btn-primary w-50">Hitung</button>
                <button type="reset" class="btn btn-secondary w-50" onclick="window.location.href='';">Reset</button>
            </div>
        </form>
        
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?= $error; ?>
            </div>
        <?php elseif (isset($harga_setelah_diskon)) : ?>
            <div class="alert alert-success mt-3" role="alert">
                <strong>Potongan Harga:</strong> Rp <?= number_format($potongan, 2, ',', '.') ?><br>
                <strong>Harga Setelah Diskon:</strong> Rp <?= number_format($harga_setelah_diskon, 2, ',', '.') ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
