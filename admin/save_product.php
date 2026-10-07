<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);

$code = strtoupper(
    trim((string) ($_POST['product_code'] ?? ''))
);

$name = trim(
    (string) ($_POST['name'] ?? '')
);

$category = trim(
    (string) ($_POST['category'] ?? '')
);

$price = (int) (
    $_POST['price'] ?? 0
);

$description = trim(
    (string) ($_POST['description'] ?? '')
);

$image = trim(
    (string) ($_POST['image'] ?? '')
);

$isActive = isset($_POST['is_active'])
    ? 1
    : 0;


/*
|--------------------------------------------------------------------------
| Validasi Data
|--------------------------------------------------------------------------
*/

if (
    $code === '' ||
    $name === '' ||
    $category === '' ||
    $price < 0 ||
    $description === '' ||
    $image === ''
) {
    header(
        'Location: index.php?error=' .
        urlencode(
            'Data produk belum lengkap atau harga tidak valid.'
        )
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Simpan Data Produk
|--------------------------------------------------------------------------
*/

try {
    $pdo = db();

    /*
    |--------------------------------------------------------------------------
    | Update Produk
    |--------------------------------------------------------------------------
    */

    if ($id > 0) {
        $st = $pdo->prepare(
            'UPDATE products
             SET
                product_code = ?,
                name = ?,
                category = ?,
                price = ?,
                description = ?,
                image = ?,
                is_active = ?
             WHERE id = ?'
        );

        $st->execute([
            $code,
            $name,
            $category,
            $price,
            $description,
            $image,
            $isActive,
            $id
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Tambah Produk Baru
    |--------------------------------------------------------------------------
    */

    else {
        $st = $pdo->prepare(
            'INSERT INTO products (
                product_code,
                name,
                category,
                price,
                description,
                image,
                is_active
            ) VALUES (?, ?, ?, ?, ?, ?, ?)'
        );

        $st->execute([
            $code,
            $name,
            $category,
            $price,
            $description,
            $image,
            $isActive
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Berhasil
    |--------------------------------------------------------------------------
    */

    header(
        'Location: index.php?success=' .
        urlencode('Produk berhasil disimpan.')
    );

    exit;

} catch (Throwable $e) {

    /*
    |--------------------------------------------------------------------------
    | Gagal
    |--------------------------------------------------------------------------
    */

    header(
        'Location: index.php?error=' .
        urlencode(
            'Produk gagal disimpan. Pastikan kode produk unik.'
        )
    );

    exit;
}