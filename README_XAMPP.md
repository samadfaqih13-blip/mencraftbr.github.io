# @mencraft.id — PHP + MySQL (XAMPP)

Tampilan frontend asli dipertahankan. Integrasi PHP menambahkan penyimpanan checkout ke MySQL tanpa mengubah desain katalog/keranjang/checkout.

## Instalasi
1. Jalankan Apache dan MySQL di XAMPP.
2. Salin folder project ke `C:\xampp\htdocs\mencraft-website`.
3. Buka `http://localhost/phpmyadmin`.
4. Import `database/mencraft_db.sql`.
5. Buka `http://localhost/mencraft-website/`.

## Alur
- Keranjang tetap memakai localStorage.
- Checkout mengirim data ke `api/save_order.php`.
- PHP memvalidasi data dan mengambil harga produk dari MySQL.
- Pesanan masuk ke `orders` dan detailnya ke `order_items`.
- Setelah berhasil, WhatsApp tetap dibuka dan sekarang membawa Kode Pesanan.
- Keranjang dikosongkan setelah penyimpanan berhasil.

## Cek pesanan
Buka `http://localhost/mencraft-website/admin/`.

## Jika MySQL root memakai password
Edit `config/database.php` dan isi `DB_PASS` sesuai password MySQL.
