
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Checkout | @mencraft.id</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">@mencraft.id</a>

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
                        <a class="nav-link" href="index.php">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang Kami</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
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

    <main class="container section-space">
        <p class="eyebrow">LANGKAH TERAKHIR</p>

        <h1>Checkout</h1>

        <p class="text-muted mb-4">
            Isi data berikut. Pesanan akan diteruskan ke WhatsApp untuk dikonfirmasi admin.
        </p>

        <div class="row g-4">

            <div class="col-lg-7">
                <form id="checkout-form" class="content-card">

                    <div class="mb-3">
                        <label class="form-label" for="customer-name">
                            Nama lengkap *
                        </label>

                        <input
                            class="form-control"
                            id="customer-name"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="customer-phone">
                            Nomor WhatsApp *
                        </label>

                        <input
                            class="form-control"
                            id="customer-phone"
                            type="tel"
                            required
                            placeholder="Nomor yang dapat dihubungi"
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="customer-address">
                            Alamat pengiriman *
                        </label>

                        <textarea
                            class="form-control"
                            id="customer-address"
                            rows="3"
                            required
                        ></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="payment-method">
                            Metode pembayaran *
                        </label>

                        <select
                            class="form-select"
                            id="payment-method"
                            required
                        >
                            <option value="">Pilih metode</option>
                            <option>Transfer Bank (konfirmasi admin)</option>
                            <option>QRIS (konfirmasi admin)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="custom-note">
                            Catatan / permintaan custom
                        </label>

                        <textarea
                            class="form-control"
                            id="custom-note"
                            rows="3"
                            placeholder="Warna, model, tulisan kartu, atau detail lainnya"
                        ></textarea>
                    </div>

                    <div class="small text-muted mb-3">
                        Bucket custom perlu dipesan minimal H-1.
                        Ongkos kirim dan harga akhir akan dikonfirmasi oleh admin.
                    </div>

                    <button class="btn btn-primary w-100" type="submit">
                        Konfirmasi melalui WhatsApp ↗
                    </button>

                </form>
            </div>

            <div class="col-lg-5">
                <aside class="summary-card">
                    <h4>Ringkasan pesanan</h4>

                    <div id="checkout-summary"></div>

                    <hr>

                    <div class="d-flex justify-content-between fw-semibold">
                        <span>Subtotal produk</span>
                        <span id="checkout-total">Rp0</span>
                    </div>

                    <p class="small text-muted mt-2">
                        Belum termasuk ongkos kirim.
                        Total akhir menunggu konfirmasi admin.
                    </p>
                </aside>
            </div>

        </div>
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