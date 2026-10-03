
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kontak | @mencraft.id</title>

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
                        <a class="nav-link" href="tentang.php">
                            Tentang Kami
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php">
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

    <!-- Header -->
    <header class="page-hero">
        <div class="container text-center">

            <p class="eyebrow">KAMI SIAP MEMBANTU</p>

            <h1>Hubungi Mencraft</h1>

            <p>
                Konfirmasi dahulu kepada admin sebelum memesan
                agar detail pesanan sesuai.
            </p>

        </div>
    </header>

    <!-- Konten utama -->
    <main class="container section-space">

        <div class="row g-4">

            <!-- Informasi kontak -->
            <div class="col-lg-7">
                <div class="content-card">

                    <h2>Informasi Kontak</h2>

                    <div class="contact-line">
                        <span>WhatsApp</span>
                        <strong>+62 852-9982-9622</strong>
                    </div>

                    <div class="contact-line">
                        <span>Instagram</span>

                        <a
                            href="https://www.instagram.com/mencraft.id/"
                            target="_blank"
                            rel="noopener"
                        >
                            @mencraft.id
                        </a>
                    </div>

                    <div class="contact-line">
                        <span>Lokasi</span>
                        <strong>Jalan Mannuruki 2 Lr.3 No.8</strong>
                    </div>

                    <div class="contact-line">
                        <span>Jam Operasional</span>
                        <strong>07.30-22.30</strong>
                    </div>

                    <a
                        class="btn btn-primary mt-3"
                        id="contact-whatsapp"
                        href="#"
                    >
                        Chat Admin WhatsApp
                    </a>

                </div>
            </div>

            <!-- Informasi pemesanan -->
            <div class="col-lg-5">
                <div class="notice-card">

                    <h4>Informasi Pemesanan</h4>

                    <ul>
                        <li>
                            Bucket custom dipesan minimal H-1.
                        </li>

                        <li>
                            Pengiriman tersedia melalui Gojek, Grab,
                            dan Maxim.
                        </li>

                        <li>
                            Harga produk custom dapat berubah
                            sesuai permintaan.
                        </li>

                        <li>
                            Konfirmasi ketersediaan dan detail pesanan
                            kepada admin sebelum memesan.
                        </li>

                        <li>
                            Pembayaran dikonfirmasi melalui WhatsApp;
                            tersedia pilihan transfer bank atau QRIS
                            sesuai konfirmasi admin.
                        </li>
                    </ul>

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/products.js"></script>
    <script src="js/script.js"></script>

</body>
</html>