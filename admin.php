<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kekurangan = $_POST['kekurangan'];
    $kelengkapan = $_POST['kelengkapan'];

    $gambar = $_FILES['gambar']['name'];
    $target = "uploads/" . basename($gambar);
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target);

    $query = "INSERT INTO produk (nama_produk, kategori, harga, deskripsi, kekurangan, kelengkapan, gambar) 
              VALUES ('$nama_produk', '$kategori', '$harga', '$deskripsi', '$kekurangan', '$kelengkapan', '$gambar')";

    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan produk: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" required><br>

        <label>Kategori:</label>
        <select name="kategori">
            <option value="Smartphone">Smartphone</option>
            <option value="Tablet">Tablet</option>
            <option value="Aksesoris">Aksesoris</option>
        </select><br>

        <label>Harga:</label>
        <input type="number" name="harga" required><br>

        <label>Deskripsi:</label>
        <textarea name="deskripsi" required></textarea><br>

        <label>Kekurangan:</label>
        <textarea name="kekurangan"></textarea><br>

        <label>Kelengkapan:</label>
        <textarea name="kelengkapan"></textarea><br>

        <label>Upload Gambar:</label>
        <input type="file" name="gambar" required><br>

        <button type="submit">Tambah Produk</button>
    </form>
</body>
</html>
