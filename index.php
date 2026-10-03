
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@mencraft.id | Bucket Handmade</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">

            <a class="navbar-brand" href="index.php">
                @mencraft.id
            </a>

            <button
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#nav"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">
                            Beranda
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">
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

    <header class="hero">
        <div class="container">
            <div class="row align-items-center g-4">

                <div class="col-lg-6">
                    <p class="eyebrow">HANDMADE WITH LOVE</p>

                    <h1>
                        Hadiah kecil,
                        <br>
                        <em>kesan yang berarti.</em>
                    </h1>

                    <p class="lead">
                        Temukan bucket handmade untuk momen spesialmu bersama
                        <strong>@mencraft.id</strong>.
                    </p>

                    <a class="btn btn-primary me-2" href="produk.php">
                        Jelajahi Katalog
                    </a>

                    <a class="btn btn-outline-primary" href="kontak.php">
                        Hubungi Kami
                    </a>
                </div>

                <div class="col-lg-6">
                    <div class="hero-art">
                        <img
                            src="beranda.jpeg"
                            alt="Foto bucket bunga"
                            onerror="this.src='https://placehold.co/720x540/E8D8C4/49382B?text=Foto+Bucket+Mencraft'"
                        >
                    </div>
                </div>

            </div>
        </div>
    </header>

    <section class="benefits container py-4">
        <div class="row g-3 text-center">

            <div class="col-6 col-lg-3">
                <div class="benefit">
                    ♡
                    <strong>Handmade</strong>
                    <small>Dibuat dengan perhatian</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit">
                    ✿
                    <strong>Bisa Custom</strong>
                    <small>Pilih warna dan model</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit">
                    ◇
                    <strong>Beragam Pilihan</strong>
                    <small>Untuk banyak momen</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="benefit">
                    ⌁
                    <strong>Pengiriman</strong>
                    <small>Gojek, Grab, dan Maxim</small>
                </div>
            </div>

        </div>
    </section>

    <section class="container section-space">
        <div class="section-heading">
            <p class="eyebrow">PILIHAN UNTUKMU</p>
            <h2>Produk pilihan</h2>
            <p>Bucket yang bisa menemani hari istimewamu.</p>
        </div>

        <div class="row g-4" id="featured-products"></div>

        <div class="text-center mt-4">
            <a class="btn btn-outline-primary" href="produk.php">
                Lihat Semua Produk →
            </a>
        </div>
    </section>

    <section class="story-band">
        <div class="container text-center">
            <p class="eyebrow">SEJAK 2019</p>

            <h2>Dibuat untuk merayakan momen berharga.</h2>

            <p>
                @mencraft.id hadir dengan beragam kreasi bucket handmade.
                Setiap pesanan dapat disesuaikan dengan warna dan model pilihanmu.
            </p>

            <a class="btn btn-primary" href="tentang.php">
                Kenali Mencraft
            </a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <span>@mencraft.id · Handmade with love</span>
            <span>Makassar, Sulawesi Selatan</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/products.js"></script>
    <script src="js/script.js"></script>

</body>
</html>