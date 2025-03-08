<?php
session_start();
include 'config.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Ambil data produk berdasarkan ID
if (!isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = $id";
$result = mysqli_query($conn, $query);
$produk = mysqli_fetch_assoc($result);

if (!$produk) {
    header("Location: admin.php");
    exit();
}

// Proses update produk
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kekurangan = $_POST['kekurangan'];
    $kelengkapan = $_POST['kelengkapan'];

    // Cek apakah ada gambar baru yang diunggah
    if ($_FILES['gambar']['name']) {
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $target);
        $query = "UPDATE produk SET nama_produk='$nama_produk', kategori='$kategori', harga='$harga', deskripsi='$deskripsi', kekurangan='$kekurangan', kelengkapan='$kelengkapan', gambar='$gambar' WHERE id=$id";
    } else {
        $query = "UPDATE produk SET nama_produk='$nama_produk', kategori='$kategori', harga='$harga', deskripsi='$deskripsi', kekurangan='$kekurangan', kelengkapan='$kelengkapan' WHERE id=$id";
    }

    mysqli_query($conn, $query);
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Edit Produk</h2>
        <div class="card p-4">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Produk:</label>
                    <input type="text" name="nama_produk" class="form-control" value="<?php echo $produk['nama_produk']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori:</label>
                    <select name="kategori" class="form-select">
                        <option value="Smartphone" <?php if ($produk['kategori'] == 'Smartphone') echo 'selected'; ?>>Smartphone</option>
                        <option value="Tablet" <?php if ($produk['kategori'] == 'Tablet') echo 'selected'; ?>>Tablet</option>
                        <option value="Aksesoris" <?php if ($produk['kategori'] == 'Aksesoris') echo 'selected'; ?>>Aksesoris</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga:</label>
                    <input type="number" name="harga" class="form-control" value="<?php echo $produk['harga']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control" required><?php echo $produk['deskripsi']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kekurangan:</label>
                    <textarea name="kekurangan" class="form-control"><?php echo $produk['kekurangan']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelengkapan:</label>
                    <textarea name="kelengkapan" class="form-control"><?php echo $produk['kelengkapan']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini:</label><br>
                    <img src="uploads/<?php echo $produk['gambar']; ?>" width="100">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Gambar Baru:</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="admin.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
