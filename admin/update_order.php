<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';


/*
|--------------------------------------------------------------------------
| Validasi Request
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?tab=orders');
    exit;
}


/*
|--------------------------------------------------------------------------
| Ambil Data
|--------------------------------------------------------------------------
*/

$id = (int) (
    $_POST['id'] ?? 0
);

$status = (string) (
    $_POST['status'] ?? ''
);


/*
|--------------------------------------------------------------------------
| Status yang Diizinkan
|--------------------------------------------------------------------------
*/

$allowed = [
    'Menunggu Konfirmasi',
    'Diproses',
    'Selesai',
    'Dibatalkan'
];


/*
|--------------------------------------------------------------------------
| Validasi Data
|--------------------------------------------------------------------------
*/

if (
    $id < 1 ||
    !in_array($status, $allowed, true)
) {
    header(
        'Location: index.php?tab=orders&error=' .
        urlencode(
            'Data status pesanan tidak valid.'
        )
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Update Status Pesanan
|--------------------------------------------------------------------------
*/

try {
    $st = db()->prepare(
        'UPDATE orders
         SET status = ?
         WHERE id = ?'
    );

    $st->execute([
        $status,
        $id
    ]);

    /*
    |--------------------------------------------------------------------------
    | Berhasil
    |--------------------------------------------------------------------------
    */

    header(
        'Location: index.php?tab=orders&success=' .
        urlencode(
            'Status pesanan berhasil diperbarui.'
        )
    );

} catch (Throwable $e) {

    /*
    |--------------------------------------------------------------------------
    | Gagal
    |--------------------------------------------------------------------------
    */

    header(
        'Location: index.php?tab=orders&error=' .
        urlencode(
            'Status pesanan gagal diperbarui.'
        )
    );
}

exit;