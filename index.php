<?php
include 'config.php';

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/LOGO.jpg" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
                <span class="text-white">Toko Berkah Gadget</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-mobile-alt me-2"></i>Samsung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-tablet-alt me-2"></i>Tablets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-watch me-2"></i>Smartwatch</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-list me-2"></i>Kategori Lainnya
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-mobile me-2"></i>Smartphone Bekas</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-headphones me-2"></i>Aksesoris</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fab fa-apple me-2"></i>iPhone</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex search-form me-2 position-relative" action="" method="GET">
                    <input class="form-control rounded-pill ps-4 pe-5" type="search" name="search" placeholder="Cari produk..." value="<?php echo htmlspecialchars($search); ?>">
                    <button class="btn position-absolute end-0 top-50 translate-middle-y me-2" type="submit">
                        <i class="fas fa-search text-muted"></i>
                    </button>
                </form>

                <a href="login.php" class="btn btn-outline-light">
                    <i class="fas fa-user-lock"></i> Login
                </a>
            </div>
        </div>
        </div>
    </nav>

    <!-- Modal Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Carousel -->
    <div class="container mt-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/slide-4.jpg" class="d-block w-100" alt="Slide 1">
                    <!-- <div class="carousel-caption">
                        <h5>Promo Gadget Murah</h5>
                        <p>Diskon hingga 20% untuk semua produk smartphone terbaru.</p>
                        <a href="#produk" class="btn btn-light">Lihat Produk</a>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img src="assets/slide-2.png" class="d-block w-100" alt="Slide 2">
                    <!-- <div class="carousel-caption">
                        <h5>Produk Terbaru</h5>
                        <p>Dapatkan gadget terbaru dengan harga terbaik dan promo menarik.</p>
                        <a href="#produk" class="btn btn-light">Lihat Produk</a>
                    </div> -->
                </div>
                <div class="carousel-item">
                    <img src="assets/slide-3.png" class="d-block w-100" alt="Slide 3">
                    <!-- <div class="carousel-caption">
                        <h5>Garansi Resmi</h5>
                        <p>Semua produk bergaransi resmi dan terpercaya, 100% original.</p>
                        <a href="#produk" class="btn btn-light">Lihat Produk</a>
                    </div> -->
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-tags"></i></div>
                    <h4 class="feature-title">Harga Terjangkau</h4>
                    <p class="feature-text">Dapatkan produk berkualitas dengan harga terbaik.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="feature-title">Garansi Resmi</h4>
                    <p class="feature-text">Semua produk memiliki garansi resmi dari distributor.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="feature-box">
                    <div class="feature-icon"><i class="fas fa-star"></i></div>
                    <h4 class="feature-title">Kualitas Terjamin</h4>
                    <p class="feature-text">Produk yang kami jual memiliki kualitas terbaik.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Produk -->
    <div class="container mt-5" id="produk">
        <h2 class="section-title">Koleksi Produk Kami</h2>

        <?php if (!empty($search)) { ?>
            <div class="alert alert-primary d-flex align-items-center mb-4">
                <i class="fas fa-search me-2"></i>
                <span>Hasil pencarian untuk: "<strong><?php echo htmlspecialchars($search); ?></strong>"</span>
                <a href="index.php" class="ms-auto btn btn-sm btn-outline-primary">Reset Pencarian</a>
            </div>
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
                        <div class="card h-100">
                            <div class="position-absolute end-0 m-3">
                                <span class="badge bg-danger">Promo</span>
                            </div>
                            <img src="<?php echo $gambar_url; ?>" class="card-img-top" alt="<?php echo $nama_produk; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $nama_produk; ?></h5>
                                <p class="harga">Rp <?php echo $harga; ?></p>
                                <div class="d-grid gap-2">
                                    <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">
                                        <i class="fas fa-info-circle me-1"></i> Lihat Detail
                                    </a>
                                    <a href="<?php echo $wa_link; ?>" target="_blank" class="btn btn-success">
                                        <i class="fab fa-whatsapp me-1"></i> Pesan via WA
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-12">
                    <div class="no-products">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>Tidak ada produk yang tersedia saat ini</h4>
                        <p class="text-muted">Maaf, produk yang Anda cari tidak ditemukan. Silakan coba kata kunci lain.</p>
                        <?php if (!empty($search)) { ?>
                            <a href="index.php" class="btn btn-primary mt-3">Lihat Semua Produk</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="footer-title">Tentang Kami</h4>
                    <p>Toko Berkah Gadget adalah toko ponsel terpercaya di Madiun yang menyediakan berbagai gadget berkualitas dengan harga terbaik dan garansi resmi.</p>
                    <div class="social-links mt-3">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 class="footer-title">Link Cepat</h4>
                    <div class="footer-links">
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Beranda</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Produk</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Tentang Kami</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Kontak</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i>Kebijakan Privasi</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4 class="footer-title">Kontak Kami</h4>
                    <p><i class="fas fa-map-marker-alt me-2"></i> Jl. Pahlawan No. 123, Madiun, Jawa Timur</p>
                    <p><i class="fas fa-phone-alt me-2"></i> +62 881-0363-57795</p>
                    <p><i class="fas fa-envelope me-2"></i> info@berkahgadget.com</p>
                    <p><i class="fas fa-clock me-2"></i> Senin - Sabtu: 08.00 - 20.00</p>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2024 Toko Berkah Gadget. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>