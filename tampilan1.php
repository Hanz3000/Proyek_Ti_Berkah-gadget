<?php
include 'config.php';

// Pastikan koneksi database tersedia
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data pencarian jika ada
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Query untuk mengambil data produk
$query = "SELECT * FROM produk";
if (!empty($search)) {
    $query .= " WHERE nama_produk LIKE '%$search%'";
}
$query .= " ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Berkah Gadget Madiun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .produk img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .harga {
            color: #ff6600;
            font-size: 20px;
            font-weight: bold;
        }

        /* Ganti warna navbar */
        .navbar {
            background-color: #007bff !important;
            /* Warna biru */
        }

        .navbar .navbar-brand {
            color: white !important;
        }

        /* Ganti warna banner */
        .container-fluid.p-5 {
            background-color: #f8f9fa !important;
            /* Warna abu-abu terang */
            color: black !important;
            /* Warna teks hitam */
        }
    </style>
</head>

<body>
    <!-- Navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/logo.jpg" alt="Logo" width="40" height="40" class="me-2">
                <span class="text-white fw-bold">Toko Berkah Gadget</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Samsung</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Tablets</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">smartwatch</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kategori Lainnya</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Smartphone Bekas</a></li>
                            <li><a class="dropdown-item" href="#">Aksesoris</a></li>
                            <li><a class="dropdown-item" href="#">Iphone</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex ms-3" action="" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn btn-outline-light" type="submit">Cari</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="container-fluid p-5 text-center">
        <h1>Promo Spesial! Dapatkan Diskon Hingga 20%</h1>
    </div>

    <div class="container mt-4">
        <?php if (!empty($search)) { ?>
            <h4 class="text-center text-primary">Hasil pencarian untuk: "<?php echo htmlspecialchars($search); ?>"</h4>
        <?php } ?>
        <div class="row">
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $nama_produk = htmlspecialchars($row['nama_produk']);
                    $harga = number_format($row['harga'], 0, ',', '.');
                    $gambar_url = "uploads/" . urlencode($row['gambar']);
                    $pesan_wa = "Halo, saya tertarik dengan produk *$nama_produk* (Rp $harga). Bisa info lebih lanjut?";
                    $wa_link = "https://wa.me/62881036357795?text=" . urlencode($pesan_wa);
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $gambar_url; ?>" class="card-img-top" alt="<?php echo $nama_produk; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $nama_produk; ?></h5>
                                <p class="harga">Rp <?php echo $harga; ?></p>
                                <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                                <a href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-success">Pesan via WA</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p class="text-center">Tidak ada produk yang tersedia saat ini.</p>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>



<!-- CONTAINER -->
<div class="container">
    <br>
    <h4>Bootstrap 4 and CCS3 Product Cards with Transition - Techhowdy(demonguru18) - Lyoid Lopes</h2>
        <br>
        <div class="row" id="ads">
            <!-- Category Card -->
            <div class="col-md-4">
                <div class="card rounded">
                    <div class="card-image">
                        <span class="card-notify-badge">Low KMS</span>
                        <span class="card-notify-year">2018</span>
                        <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text" />
                    </div>
                    <div class="card-image-overlay m-auto">
                        <span class="card-detail-badge">Used</span>
                        <span class="card-detail-badge">$28,000.00</span>
                        <span class="card-detail-badge">13000 Kms</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="ad-title m-auto">
                            <h5>Honda Accord LX</h5>
                        </div>
                        <a class="ad-btn" href="#">View</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card rounded">
                    <div class="card-image">
                        <span class="card-notify-badge">Fully-Loaded</span>
                        <span class="card-notify-year">2017</span>
                        <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=CAC80HOC021B121001.jpg&width=440&height=262" alt="Alternate Text" />
                    </div>
                    <div class="card-image-overlay m-auto">
                        <span class="card-detail-badge">Used</span>
                        <span class="card-detail-badge">$28,000.00</span>
                        <span class="card-detail-badge">13000 Kms</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="ad-title m-auto">
                            <h5>Honda CIVIC HATCHBACK LS</h5>
                        </div>
                        <a class="ad-btn" href="#">View</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card rounded">
                    <div class="card-image">
                        <span class="card-notify-badge">Price Reduced</span>
                        <span class="card-notify-year">2018</span>
                        <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC091A021001.jpg&width=440&height=262" alt="Alternate Text" />
                    </div>
                    <div class="card-image-overlay m-auto">
                        <span class="card-detail-badge">Used</span>
                        <span class="card-detail-badge">$22,000.00</span>
                        <span class="card-detail-badge">8000 Kms</span>
                    </div>
                    <div class="card-body text-center">
                        <div class="ad-title m-auto">
                            <h5>Honda Accord Hybrid LT</h5>
                        </div>
                        <a class="ad-btn" href="#">View</a>
                    </div>
                </div>
            </div>


            <img class="img-fluid" src="https://imageonthefly.autodatadirect.com/images/?USER=eDealer&PW=edealer872&IMG=USC80HOC011A021001.jpg&width=440&height=262" alt="Alternate Text"

                </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Lihat Detail</a>
                <a href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-success">Pesan via WA</a>
            </div>
        </div>


        <a class="ad-btn" href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-success">View</a>