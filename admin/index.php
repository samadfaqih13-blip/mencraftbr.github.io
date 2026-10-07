<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';


/**
 * Format angka menjadi Rupiah.
 */
function rupiah(int $v): string
{
    return 'Rp' . number_format(
        $v,
        0,
        ',',
        '.'
    );
}


/**
 * Koneksi database.
 */
$pdo = db();


/**
 * Mengambil seluruh produk.
 */
$products = $pdo
    ->query(
        'SELECT * FROM products ORDER BY id DESC'
    )
    ->fetchAll();


/**
 * Mengambil seluruh pesanan.
 */
$orders = $pdo
    ->query(
        'SELECT * FROM orders ORDER BY created_at DESC'
    )
    ->fetchAll();


/**
 * Data produk yang sedang diedit.
 */
$edit = null;

if (isset($_GET['edit'])) {

    $st = $pdo->prepare(
        'SELECT * FROM products WHERE id = ?'
    );

    $st->execute([
        (int) $_GET['edit']
    ]);

    $edit = $st->fetch() ?: null;
}


/**
 * Tab aktif.
 */
$tab = $_GET['tab'] ?? 'products';

?>

<!doctype html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Admin | @mencraft.id
    </title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- CSS Website -->
    <link
        rel="stylesheet"
        href="../css/style.css"
    >

</head>


<body>

<main class="container section-space">

    <!-- =====================================================
        HEADER
    ====================================================== -->

    <p class="eyebrow">
        ADMIN MENCRAFT
    </p>

    <h1>
        Kelola Website
    </h1>

    <p class="text-muted">
        Kelola produk dan pesanan tanpa mengubah tampilan
        website pelanggan.
    </p>


    <!-- =====================================================
        NOTIFIKASI BERHASIL
    ====================================================== -->

    <?php if (!empty($_GET['success'])): ?>

        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >

            <strong>Berhasil.</strong>

            <?= htmlspecialchars(
                $_GET['success']
            ) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <!-- =====================================================
        NOTIFIKASI ERROR
    ====================================================== -->

    <?php if (!empty($_GET['error'])): ?>

        <div
            class="alert alert-danger alert-dismissible fade show"
            role="alert"
        >

            <strong>Perhatian.</strong>

            <?= htmlspecialchars(
                $_GET['error']
            ) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    <?php endif; ?>


    <!-- =====================================================
        NAVIGASI TAB
    ====================================================== -->

    <ul class="nav nav-pills mb-4">

        <li class="nav-item">

            <a
                class="nav-link <?= $tab === 'products' ? 'active' : '' ?>"
                href="?tab=products"
            >
                Produk
            </a>

        </li>


        <li class="nav-item">

            <a
                class="nav-link <?= $tab === 'orders' ? 'active' : '' ?>"
                href="?tab=orders"
            >
                Pesanan
            </a>

        </li>

    </ul>


    <!-- =====================================================
        TAB PRODUK
    ====================================================== -->

    <?php if ($tab === 'products'): ?>

        <div class="row g-4">


            <!-- =================================================
                FORM TAMBAH / EDIT PRODUK
            ================================================== -->

            <div class="col-lg-5">

                <div class="content-card">

                    <h3>
                        <?= $edit ? 'Edit Produk' : 'Tambah Produk' ?>
                    </h3>


                    <form
                        method="post"
                        action="save_product.php"
                        class="crud-form"
                    >

                        <!-- ID Produk -->
                        <input
                            type="hidden"
                            name="id"
                            value="<?= htmlspecialchars(
                                (string) ($edit['id'] ?? 0)
                            ) ?>"
                        >


                        <!-- Kode Produk -->
                        <div class="mb-3">

                            <label class="form-label">
                                Kode Produk
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="product_code"
                                required
                                value="<?= htmlspecialchars(
                                    $edit['product_code'] ?? ''
                                ) ?>"
                                placeholder="BUNGA"
                            >

                        </div>


                        <!-- Nama Produk -->
                        <div class="mb-3">

                            <label class="form-label">
                                Nama Produk
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                required
                                value="<?= htmlspecialchars(
                                    $edit['name'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- Kategori -->
                        <div class="mb-3">

                            <label class="form-label">
                                Kategori
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="category"
                                required
                                value="<?= htmlspecialchars(
                                    $edit['category'] ?? ''
                                ) ?>"
                            >

                        </div>


                        <!-- Harga -->
                        <div class="mb-3">

                            <label class="form-label">
                                Harga Patokan
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                name="price"
                                min="0"
                                required
                                value="<?= htmlspecialchars(
                                    (string) ($edit['price'] ?? '')
                                ) ?>"
                            >

                            <small class="text-muted">
                                Gunakan satu harga patokan
                                untuk setiap produk.
                            </small>

                        </div>


                        <!-- Nama File Gambar -->
                        <div class="mb-3">

                            <label class="form-label">
                                Nama File Gambar
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                name="image"
                                required
                                value="<?= htmlspecialchars(
                                    $edit['image'] ?? ''
                                ) ?>"
                                placeholder="bunga.jpeg"
                            >

                            <small class="text-muted">
                                Upload gambar ke folder utama
                                website, lalu isi nama filenya.
                            </small>

                        </div>


                        <!-- Deskripsi -->
                        <div class="mb-3">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                class="form-control"
                                name="description"
                                rows="4"
                                required
                            ><?= htmlspecialchars(
                                $edit['description'] ?? ''
                            ) ?></textarea>

                        </div>


                        <!-- Status Produk -->
                        <div class="form-check mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_active"
                                id="active"
                                <?= (
                                    !$edit ||
                                    (int) $edit['is_active'] === 1
                                ) ? 'checked' : '' ?>
                            >

                            <label
                                class="form-check-label"
                                for="active"
                            >
                                Tampilkan di katalog
                            </label>

                        </div>


                        <!-- Konfirmasi -->
                        <div class="form-check mb-3">

                            <input
                                class="form-check-input crud-confirm"
                                type="checkbox"
                                required
                                id="confirm-product"
                            >

                            <label
                                class="form-check-label"
                                for="confirm-product"
                            >
                                Saya sudah memeriksa data dan
                                menyetujui perubahan produk ini.
                            </label>

                        </div>


                        <!-- Tombol -->
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            <?= $edit
                                ? 'Update Produk'
                                : 'Simpan Produk'
                            ?>
                        </button>


                        <?php if ($edit): ?>

                            <a
                                class="btn btn-outline-primary"
                                href="index.php"
                            >
                                Batal
                            </a>

                        <?php endif; ?>

                    </form>

                </div>

            </div>


            <!-- =================================================
                 DAFTAR PRODUK
            ================================================== -->

            <div class="col-lg-7">

                <div
                    class="content-card"
                    style="overflow-x: auto;"
                >

                    <h3>
                        Daftar Produk
                    </h3>


                    <table class="table align-middle">

                        <thead>

                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>

                        </thead>


                        <tbody>

                            <?php foreach ($products as $p): ?>

                                <tr>

                                    <!-- Produk -->
                                    <td>

                                        <strong>
                                            <?= htmlspecialchars(
                                                $p['name']
                                            ) ?>
                                        </strong>

                                        <br>

                                        <small>
                                            <?= htmlspecialchars(
                                                $p['category']
                                            ) ?>
                                        </small>

                                    </td>


                                    <!-- Harga -->
                                    <td>
                                        <?= rupiah(
                                            (int) $p['price']
                                        ) ?>
                                    </td>


                                    <!-- Status -->
                                    <td>

                                        <?= (
                                            (int) $p['is_active'] === 1
                                        )
                                            ? 'Aktif'
                                            : 'Nonaktif'
                                        ?>

                                    </td>


                                    <!-- Aksi -->
                                    <td class="text-nowrap">

                                        <a
                                            class="btn btn-sm btn-outline-primary"
                                            href="?edit=<?= $p['id'] ?>"
                                        >
                                            Edit
                                        </a>


                                        <form
                                            method="post"
                                            action="delete_product.php"
                                            class="d-inline crud-form"
                                        >

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= $p['id'] ?>"
                                            >


                                            <label
                                                class="small d-block mt-1"
                                            >

                                                <input
                                                    type="checkbox"
                                                    class="crud-confirm"
                                                    required
                                                >

                                                Saya yakin

                                            </label>


                                            <button
                                                class="btn btn-sm btn-outline-danger mt-1"
                                                type="submit"
                                            >
                                                Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    <!-- =====================================================
         TAB PESANAN
    ====================================================== -->

    <?php else: ?>

        <div
            class="content-card"
            style="overflow-x: auto;"
        >

            <h3>
                Data Pesanan
            </h3>


            <table class="table align-middle">

                <thead>

                    <tr>
                        <th>Kode</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>

                    <?php foreach ($orders as $o): ?>

                        <tr>

                            <!-- Kode -->
                            <td>

                                <strong>
                                    <?= htmlspecialchars(
                                        $o['order_code']                                    ) ?>
                                </strong>

                            </td>


                            <!-- Pelanggan -->
                            <td>

                                <?= htmlspecialchars(
                                    $o['customer_name']
                                ) ?>

                                <br>

                                <small>
                                    <?= htmlspecialchars(
                                        $o['customer_phone']
                                    ) ?>
                                </small>

                            </td>


                            <!-- Total -->
                            <td>

                                <?= rupiah(
                                    (int) $o['subtotal']
                                ) ?>

                            </td>


                            <!-- Status -->
                            <td>

                                <form
                                    method="post"
                                    action="update_order.php"
                                    class="crud-form"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $o['id'] ?>"
                                    >


                                    <select
                                        name="status"
                                        class="form-select form-select-sm mb-1"
                                    >

                                        <option
                                            <?= (
                                                $o['status'] ===
                                                'Menunggu Konfirmasi'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >
                                            Menunggu Konfirmasi
                                        </option>


                                        <option
                                            <?= (
                                                $o['status'] ===
                                                'Diproses'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >
                                            Diproses
                                        </option>


                                        <option
                                            <?= (
                                                $o['status'] ===
                                                'Selesai'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >
                                            Selesai
                                        </option>


                                        <option
                                            <?= (
                                                $o['status'] ===
                                                'Dibatalkan'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >
                                            Dibatalkan
                                        </option>

                                    </select>


                                    <label
                                        class="small d-block mb-1"
                                    >

                                        <input
                                            type="checkbox"
                                            class="crud-confirm"
                                            required
                                        >

                                        Saya sudah memeriksa

                                    </label>


                                    <button
                                        class="btn btn-sm btn-primary"
                                        type="submit"
                                    >
                                        Update Status
                                    </button>

                                </form>

                            </td>


                            <!-- Waktu -->
                            <td>

                                <?= htmlspecialchars(
                                    $o['created_at']
                                ) ?>

                            </td>


                            <!-- Hapus -->
                            <td>

                                <form
                                    method="post"
                                    action="delete_order.php"
                                    class="crud-form"
                                >

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $o['id'] ?>"
                                    >


                                    <label
                                        class="small d-block"
                                    >

                                        <input
                                            type="checkbox"
                                            class="crud-confirm"
                                            required
                                        >

                                        Saya yakin

                                    </label>


                                    <button
                                        class="btn btn-sm btn-outline-danger mt-1"
                                        type="submit"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    <?php endforeach; ?>


                    <!-- Tidak ada pesanan -->
                    <?php if (!$orders): ?>

                        <tr>

                            <td
                                colspan="6"
                                class="text-center text-muted"
                            >
                                Belum ada pesanan.
                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         KEMBALI KE WEBSITE
    ====================================================== -->

    <a
        href="../index.php"
        class="btn btn-outline-primary mt-3"
    >
        Kembali ke Website
    </a>

</main>


<!-- =========================================================
    BOOTSTRAP JAVASCRIPT
========================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
></script>


<!-- =========================================================
    KONFIRMASI CRUD
========================================================== -->

<script>

document
    .querySelectorAll('.crud-form')
    .forEach(form => {

        form.addEventListener('submit', event => {

            const checkbox =
                form.querySelector('.crud-confirm');

            if (
                checkbox &&
                !checkbox.checked
            ) {

                event.preventDefault();

                alert(
                    'Silakan centang kotak pemberitahuan terlebih dahulu sebelum melanjutkan.'
                );
            }

        });

    });

</script>

</body>

</html>