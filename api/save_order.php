<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/database.php';


/*
|--------------------------------------------------------------------------
| Helper Response JSON
|--------------------------------------------------------------------------
*/

function out(
    bool $ok,
    string $msg,
    array $data = [],
    int $status = 200
): never {
    http_response_code($status);

    echo json_encode(
        [
            'success' => $ok,
            'message' => $msg,
            'data'    => $data
        ],
        JSON_UNESCAPED_UNICODE
    );

    exit;
}


/*
|--------------------------------------------------------------------------
| Validasi Method Request
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    out(
        false,
        'Method tidak diizinkan.',
        [],
        405
    );
}


/*
|--------------------------------------------------------------------------
| Ambil Data JSON
|--------------------------------------------------------------------------
*/

$payload = json_decode(
    file_get_contents('php://input') ?: '',
    true
);

if (!is_array($payload)) {
    out(
        false,
        'Data checkout tidak valid.',
        [],
        400
    );
}


/*
|--------------------------------------------------------------------------
| Ambil Data Checkout
|--------------------------------------------------------------------------
*/

$name = trim(
    (string) ($payload['name'] ?? '')
);

$phone = trim(
    (string) ($payload['phone'] ?? '')
);

$address = trim(
    (string) ($payload['address'] ?? '')
);

$payment = trim(
    (string) ($payload['payment'] ?? '')
);

$note = trim(
    (string) ($payload['note'] ?? '')
);

$cart = $payload['cart'] ?? [];


/*
|--------------------------------------------------------------------------
| Validasi Data Customer
|--------------------------------------------------------------------------
*/

if (
    $name === '' ||
    $phone === '' ||
    $address === '' ||
    $payment === ''
) {
    out(
        false,
        'Data checkout belum lengkap.',
        [],
        422
    );
}


/*
|--------------------------------------------------------------------------
| Validasi Nomor WhatsApp
|--------------------------------------------------------------------------
*/

if (!preg_match('/^[0-9+()\-\s]{8,20}$/', $phone)) {
    out(
        false,
        'Nomor WhatsApp tidak valid.',
        [],
        422
    );
}


/*
|--------------------------------------------------------------------------
| Validasi Keranjang
|--------------------------------------------------------------------------
*/

if (!is_array($cart) || !$cart) {
    out(
        false,
        'Keranjang masih kosong.',
        [],
        422
    );
}


/*
|--------------------------------------------------------------------------
| Proses Checkout
|--------------------------------------------------------------------------
*/

try {
    $pdo = db();

    $pdo->beginTransaction();

    $items = [];
    $subtotal = 0;

    /*
    |--------------------------------------------------------------------------
    | Ambil Data Produk
    |--------------------------------------------------------------------------
    */

    $stmt = $pdo->prepare(
        'SELECT id, name, price
         FROM products
         WHERE product_code = ?
           AND is_active = 1
         LIMIT 1'
    );


    /*
    |--------------------------------------------------------------------------
    | Proses Setiap Item Keranjang
    |--------------------------------------------------------------------------
    */

    foreach ($cart as $item) {

        $productId = trim(
            (string) ($item['id'] ?? '')
        );

        $qty = (int) (
            $item['qty'] ?? 0
        );


        /*
        |--------------------------------------------------------------------------
        | Validasi Item
        |--------------------------------------------------------------------------
        */

        if (
            $productId === '' ||
            $qty < 1 ||
            $qty > 99
        ) {
            throw new RuntimeException(
                'Item keranjang tidak valid.'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Cari Produk
        |--------------------------------------------------------------------------
        */

        $stmt->execute([
            $productId
        ]);

        $product = $stmt->fetch();


        if (!$product) {
            throw new RuntimeException(
                'Produk tidak ditemukan: ' . $productId
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Data Custom Produk
        |--------------------------------------------------------------------------
        */

        $color = trim(
            (string) ($item['color'] ?? 'Belum ditentukan')
        ) ?: 'Belum ditentukan';

        $model = trim(
            (string) ($item['model'] ?? 'Belum ditentukan')
        ) ?: 'Belum ditentukan';


        /*
        |--------------------------------------------------------------------------
        | Hitung Total Item
        |--------------------------------------------------------------------------
        */

        $line = (int) $product['price'] * $qty;

        $subtotal += $line;


        /*
        |--------------------------------------------------------------------------
        | Simpan Data Item Sementara
        |--------------------------------------------------------------------------
        */

        $items[] = [
            (int) $product['id'],
            $product['name'],
            $qty,
            $color,
            $model,
            (int) $product['price'],
            $line
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Buat Kode Pesanan
    |--------------------------------------------------------------------------
    */

    $code =
        'MC-' .
        date('Ymd-His') .
        '-' .
        random_int(100, 999);


    /*
    |--------------------------------------------------------------------------
    | Simpan Data Pesanan
    |--------------------------------------------------------------------------
    */

    $order = $pdo->prepare(
        'INSERT INTO orders (
            order_code,
            customer_name,
            customer_phone,
            customer_address,
            payment_method,
            custom_note,
            subtotal,
            status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );

    $order->execute([
        $code,
        $name,
        $phone,
        $address,
        $payment,
        $note,
        $subtotal,
        'Menunggu Konfirmasi'
    ]);


    $orderId = (int) $pdo->lastInsertId();


    /*
    |--------------------------------------------------------------------------
    | Simpan Detail Pesanan
    |--------------------------------------------------------------------------
    */

    $itemStmt = $pdo->prepare(
        'INSERT INTO order_items (
            order_id,
            product_id,
            product_name,
            quantity,
            color,
            model,
            unit_price,
            line_total
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
    );


    foreach ($items as $i) {
        $itemStmt->execute([
            $orderId,
            ...$i
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Commit Transaksi
    |--------------------------------------------------------------------------
    */

    $pdo->commit();


    /*
    |--------------------------------------------------------------------------
    | Response Berhasil
    |--------------------------------------------------------------------------
    */

    out(
        true,
        'Pesanan berhasil disimpan.',
        [
            'order_id'   => $orderId,
            'order_code' => $code,
            'subtotal'   => $subtotal
        ]
    );

} catch (Throwable $e) {

    /*
    |--------------------------------------------------------------------------
    | Rollback Jika Gagal
    |--------------------------------------------------------------------------
    */

    if (
        isset($pdo) &&
        $pdo instanceof PDO &&
        $pdo->inTransaction()
    ) {
        $pdo->rollBack();
    }


    /*
    |--------------------------------------------------------------------------
    | Response Gagal
    |--------------------------------------------------------------------------
    */

    out(
        false,
        'Pesanan gagal disimpan: ' . $e->getMessage(),
        [],
        500
    );
}
