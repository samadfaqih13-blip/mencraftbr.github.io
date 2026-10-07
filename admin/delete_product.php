<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';


/**
 * Pastikan request menggunakan POST.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: index.php?error=' .
        urlencode('Gunakan tombol Hapus dari halaman admin.')
    );

    exit;
}


/**
 * Mengambil ID produk.
 */
$id = (int) ($_POST['id'] ?? 0);


/**
 * Validasi ID produk.
 */
if ($id < 1) {

    header(
        'Location: index.php?error=' .
        urlencode('Produk tidak valid.')
    );

    exit;
}


try {

    /**
     * Hapus produk berdasarkan ID.
     */
    $st = db()->prepare(
        'DELETE FROM products WHERE id = ?'
    );

    $st->execute([$id]);


    /**
     * Kembali ke halaman admin
     * dengan pesan berhasil.
     */
    header(
        'Location: index.php?success=' .
        urlencode('Produk berhasil dihapus.')
    );

} catch (Throwable $e) {

    /**
     * Produk tidak dapat dihapus jika
     * masih digunakan oleh order_items.
     */
    header(
        'Location: index.php?error=' .
        urlencode(
            'Produk tidak dapat dihapus karena sudah digunakan pada pesanan.'
        )
    );
}


exit;