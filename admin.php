<?php
session_start();
include 'config.php';

// Cek apakah user adalah admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Proses tambah produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
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
    mysqli_query($conn, $query);
}

// Proses edit produk
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $kekurangan = $_POST['kekurangan'];
    $kelengkapan = $_POST['kelengkapan'];
    
    $query = "UPDATE produk SET nama_produk='$nama_produk', kategori='$kategori', harga='$harga', deskripsi='$deskripsi', kekurangan='$kekurangan', kelengkapan='$kelengkapan' WHERE id=$id";
    mysqli_query($conn, $query);
}

// Proses hapus produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
    header("Location: admin.php");
    exit();
}

// Ambil data produk
$search = isset($_GET['search']) ? $_GET['search'] : '';
$query = "SELECT * FROM produk WHERE nama_produk LIKE '%$search%' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div>
                <a href="index.php" class="btn btn-light">Beranda</a>
                <a href="?logout=true" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-3">Tambah Produk</h2>
        <div class="card p-4">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Produk:</label>
                    <input type="text" name="nama_produk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori:</label>
                    <select name="kategori" class="form-select">
                        <option value="Smartphone">Smartphone</option>
                        <option value="Tablet">Tablet</option>
                        <option value="Aksesoris">Aksesoris</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga:</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi:</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kekurangan:</label>
                    <textarea name="kekurangan" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kelengkapan:</label>
                    <textarea name="kelengkapan" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Gambar:</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Produk</button>
            </form>
        </div>

        <h2 class="mt-5">Daftar Produk</h2>
        <form method="get" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary mt-2">Cari</button>
        </form>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nama_produk']; ?></td>
                    <td><?php echo $row['kategori']; ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><img src="uploads/<?php echo $row['gambar']; ?>" width="50"></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="?hapus=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
