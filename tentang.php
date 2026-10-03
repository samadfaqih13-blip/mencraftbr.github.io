
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tentang Kami | @mencraft.id</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                @mencraft.id
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#nav"
                aria-controls="nav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="tentang.php">
                            Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">
                            Kontak
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="keranjang.php">
                            Keranjang
                            <span class="cart-count badge rounded-pill">0</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Header halaman -->
    <header class="page-hero">
        <div class="container text-center">

            <p class="eyebrow">CERITA KAMI</p>

            <h1>Tentang @mencraft.id</h1>

            <p>
                Kerajinan tangan untuk berbagi rasa dan merayakan momen.
            </p>

        </div>
    </header>

    <!-- Konten utama -->
    <main class="container section-space">

        <div class="row align-items-center g-5">

            <!-- Gambar Mencraft -->
            <div class="col-lg-6">

                <img
                    class="rounded-4 img-fluid shadow-sm"
                    src="logo.png"
                    alt="Suasana kerajinan Mencraft"
                    onerror="this.onerror=null; this.src='https://placehold.co/700x520/E8D8C4/49382B?text=Cerita+Mencraft';"
                >

            </div>

            <!-- Cerita Mencraft -->
            <div class="col-lg-6">

                <p class="eyebrow">PERJALANAN MENCRAFT</p>

                <h2>
                    Berawal dari sebuah kreasi, tumbuh bersama cerita.
                </h2>

                <p>
                    @mencraft.id merupakan usaha kerajinan tangan yang
                    berdiri pada tahun 2019 dengan nama awal
                    <strong>@makassarbucket</strong>. Pada tahun 2024,
                    usaha ini melakukan perubahan nama brand dan logo
                    sebagai bagian dari langkah untuk terus berkembang.
                    Owner dari usaha merupakan salah satu IKA UNM yaitu
                    <b>A.M Nurrahman Qishas.H S.Tr.T., M.Pd.</b> yang 
                    yang memiliki inovasi dan kreativitas di bidang
                    kerajinan tangan. 
                </p>

                <p>
                    Usaha ini menghadirkan berbagai pilihan atau jenis bucket, mulai dari
                    bucket bunga, uang, bucket snack, round bucket, bucket boneka,
                    hingga bucket profesi. Pelanggan dapat memilih warna
                    wrapping dan model sesuai permintaan.
                </p>

                <a href="produk.php" class="btn btn-primary">
                    Lihat Koleksi
                </a>

            </div>
        </div>

        <!-- Keunggulan Mencraft -->
        <div class="row g-3 mt-5">

            <div class="col-md-4">
                <div class="info-tile">

                    <h5>Handmade</h5>

                    <p>
                        Kreasi bucket untuk berbagai momen spesial.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">

                    <h5>Custom</h5>

                    <p>
                        Warna dan model dapat disesuaikan
                        dengan permintaan.
                    </p>

                </div>
            </div>

            <div class="col-md-4">
                <div class="info-tile">

                    <h5>Berpengalaman sejak 2019</h5>

                    <p>
                        Terus bertumbuh bersama pelanggan.
                    </p>

                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container d-flex justify-content-between flex-wrap gap-2">

            <span>@mencraft.id · Handmade with love</span>

            <span>Makassar, Sulawesi Selatan</span>

        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/products.js"></script>
    <script src="js/script.js"></script>

</body>
</html>