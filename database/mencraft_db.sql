
-- =========================================================
-- DATABASE MENCRAFT
-- =========================================================

CREATE DATABASE IF NOT EXISTS mencraft_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE mencraft_db;


-- =========================================================
-- TABEL PRODUCTS
-- =========================================================

CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(30) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(100) NOT NULL,
    min_price INT UNSIGNED NOT NULL,
    max_price INT UNSIGNED NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- =========================================================
-- TABEL ORDERS
-- =========================================================

CREATE TABLE IF NOT EXISTS orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_code VARCHAR(40) NOT NULL UNIQUE,
    customer_name VARCHAR(120) NOT NULL,
    customer_phone VARCHAR(30) NOT NULL,
    customer_address TEXT NOT NULL,
    payment_method VARCHAR(80) NOT NULL,
    custom_note TEXT NULL,
    subtotal INT UNSIGNED NOT NULL DEFAULT 0,

    status ENUM(
        'Menunggu Konfirmasi',
        'Diproses',
        'Selesai',
        'Dibatalkan'
    ) NOT NULL DEFAULT 'Menunggu Konfirmasi',

    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


-- =========================================================
-- TABEL ORDER_ITEMS
-- =========================================================

CREATE TABLE IF NOT EXISTS order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT UNSIGNED NOT NULL,
    color VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,
    unit_price INT UNSIGNED NOT NULL,
    line_total INT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id)
        REFERENCES orders(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_order_items_product
        FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB;


-- =========================================================
-- DATA PRODUK
-- =========================================================

INSERT INTO products (
    product_code,
    name,
    category,
    min_price,
    max_price,
    description,
    image
) VALUES

(
    'BUNGA',
    'Bucket Bunga',
    'Bucket Bunga',
    35000,
    200000,
    'Bucket bunga artificial dengan pilihan warna wrapping.',
    'bunga.jpeg'
),

(
    'UANG',
    'Bucket Uang',
    'Bucket Uang',
    85000,
    515000,
    'Harga sesuai jumlah lembaran uang yang ditentukan customer.',
    'uang.jpeg'
),

(
    'SNACK',
    'Bucket Snack',
    'Bucket Snack',
    50000,
    500000,
    'Harga menyesuaikan jenis dan jumlah snack di dalam bucket.',
    'snack.jpeg'
),

(
    'ROUND',
    'Round Bucket',
    'Round Bucket',
    200000,
    500000,
    'Round bucket menggunakan wrapping yang lebih premium.',
    'round.jpeg'
),

(
    'BONEKA',
    'Bucket Boneka',
    'Bucket Boneka',
    65000,
    150000,
    'Bucket yang memadukan boneka dan bunga.',
    'boneka.jpeg'
),

(
    'PROFESI',
    'Bucket Profesi',
    'Bucket Profesi',
    200000,
    500000,
    'Tersedia tema profesi Polisi, Pelayaran, TNI, Satpam, dan Dokter.',
    'profesi.jpeg'
)

ON DUPLICATE KEY UPDATE
    name = VALUES(name),
    category = VALUES(category),
    min_price = VALUES(min_price),
    max_price = VALUES(max_price),
    description = VALUES(description),
    image = VALUES(image),
    is_active = 1;


-- =========================================================
-- INDEX
-- =========================================================

CREATE INDEX idx_orders_status
    ON orders(status);

CREATE INDEX idx_orders_created_at
    ON orders(created_at);

CREATE INDEX idx_order_items_order_id
    ON order_items(order_id);

