<?php include 'function-obat.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Distribusi Obat ke Pasien</title>
</head>

<body>
    <h2>Distribusi Obat</h2>
    <form action="function-obat.php" method="POST">
        <label for="kode_obat">Kode Obat:</label><br>
        <input type="text" id="kode_obat" name="kode_obat" required><br><br>

        <label for="jumlah_keluar">Jumlah Keluar:</label><br>
        <input type="number" id="jumlah_keluar" name="jumlah_keluar" min="1" required><br><br>

        <button type="submit" name="keluar_obat">Keluarkan Obat</button>
    </form>
</body>

</html>