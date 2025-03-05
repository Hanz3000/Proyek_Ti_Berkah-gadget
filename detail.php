<?php
include 'config.php';

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Produk</title>
</head>
<body>
    <h1><?php echo $row['nama_produk']; ?></h1>
    <img src="uploads/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_produk']; ?>">
    <p><strong>Harga:</strong> Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></p>
    <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi']; ?></p>
    <p><strong>Kekurangan:</strong> <?php echo $row['kekurangan']; ?></p>
    <p><strong>Kelengkapan:</strong> <?php echo $row['kelengkapan']; ?></p>
    <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20memesan%20<?php echo urlencode($row['nama_produk']); ?>" target="_blank">Pesan via WA</a>
    <br><br>
    <a href="index.php">Kembali ke Katalog</a>
</body>
</html>

