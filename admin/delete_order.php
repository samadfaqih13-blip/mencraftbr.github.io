<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';


/**
 * Pastikan request menggunakan POST.
 */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header(
        'Location: index.php?tab=orders&error=' .
        urlencode('Gunakan tombol Hapus dari halaman admin.')
    );

    exit;
}


/**
 * Mengambil ID pesanan.
 */
$id = (int) ($_POST['id'] ?? 0);


/**
 * Validasi ID.
 */
if ($id < 1) {

    header(
        'Location: index.php?tab=orders&error=' .
        urlencode('Pesanan tidak valid.')
    );

    exit;
}


try {

    /**
     * Hapus pesanan berdasarkan ID.
     */
    $st = db()->prepare(
        'DELETE FROM orders WHERE id = ?'
    );

    $st->execute([$id]);


    /**
     * Kembali ke halaman admin
     * dengan pesan berhasil.
     */
    header(
        'Location: index.php?tab=orders&success=' .
        urlencode('Pesanan berhasil dihapus.')
    );

} catch (Throwable $e) {

    /**
     * Jika terjadi error.
     */
    header(
        'Location: index.php?tab=orders&error=' .
        urlencode('Pesanan gagal dihapus.')
    );
}


exit;