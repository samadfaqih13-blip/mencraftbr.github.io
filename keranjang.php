
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Keranjang | @mencraft.id</title>

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
                        <a class="nav-link" href="kontak.php">
                            Kontak
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="keranjang.php">
                            Keranjang
                            <span class="cart-count badge rounded-pill">0</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <main class="container section-space">
        <p class="eyebrow">PESANANMU</p>

        <h1>Keranjang Belanja</h1>

        <p class="text-muted mb-4">
            Periksa kembali pilihan produk sebelum melanjutkan.
        </p>

        <div id="cart-content"></div>
    </main>

    <footer class="site-footer">
        <div class="container d-flex justify-content-between flex-wrap gap-2">
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