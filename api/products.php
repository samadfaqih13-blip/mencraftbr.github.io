<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/database.php';
try {
    $rows = db()->query("SELECT id, product_code, name, category, price, description, image FROM products WHERE is_active = 1 ORDER BY id ASC")->fetchAll();
    $products = array_map(static function(array $p): array {
        return [
            'id' => (string)$p['product_code'],
            'db_id' => (int)$p['id'],
            'name' => $p['name'],
            'category' => $p['category'],
            'price' => (int)$p['price'],
            'description' => $p['description'],
            'image' => $p['image'],
        ];
    }, $rows);
    echo json_encode(['success' => true, 'data' => $products], JSON_UNESCAPED_UNICODE);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Gagal mengambil data produk.']);
}
