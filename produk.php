
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Produk | @mencraft.id</title>

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
                        <a class="nav-link active" href="produk.php">
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

    <!-- Header halaman -->
    <header class="page-hero">
        <div class="container text-center">

            <p class="eyebrow">KOLEKSI MENCRAFT</p>

            <h1>Temukan bucket pilihanmu</h1>

            <p>
                Jelajahi katalog dan pilih kreasi yang sesuai dengan momenmu.
            </p>

        </div>
    </header>

    <!-- Katalog produk -->
    <main class="container section-space">

        <!-- Pencarian dan filter kategori -->
        <div class="row g-3 mb-4">

            <div class="col-lg-7">
                <input
                    id="product-search"
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Cari produk..."
                >
            </div>

            <div class="col-lg-5">
                <select
                    id="category-filter"
                    class="form-select form-select-lg"
                >
                    <option value="all">Semua kategori</option>
                </select>
            </div>

        </div>

        <!-- Daftar produk akan ditampilkan melalui JavaScript -->
        <div id="product-list" class="row g-4"></div>

        <!-- Pesan jika produk tidak ditemukan -->
        <p
            id="no-results"
            class="text-center py-5 d-none"
        >
            Produk tidak ditemukan. Coba kata kunci lain.
        </p>

    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container d-flex justify-content-between flex-wrap gap-2">

            <span>@mencraft.id · Handmade with love</span>

            <span>Makassar, Sulawesi Selatan</span>

        </div>
    </footer>

    <!-- Modal detail produk -->
    <div
        class="modal fade"
        id="productModal"
        tabindex="-1"
        aria-labelledby="productModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="productModalLabel">
                        Detail Produk
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Tutup"
                    ></button>

                </div>

                <div class="modal-body" id="modal-product-content"></div>

            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/products.js"></script>
    <script src="js/script.js"></script>

</body>
</html>