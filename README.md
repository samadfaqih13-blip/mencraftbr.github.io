# @mencraft.id — Website Katalog dan Pemesanan

Website frontend statis untuk UMKM bucket handmade @mencraft.id.

## Teknologi
- HTML5, CSS3
- Bootstrap 5.3.3 melalui CDN
- JavaScript
- jQuery 3.7.1
- localStorage untuk menyimpan keranjang di browser

## Cara menjalankan
1. Ekstrak folder proyek.
2. Buka folder `mencraft-website` di VS Code.
3. Jalankan `index.php` menggunakan ekstensi Live Server atau buka langsung di browser.
4. Pastikan koneksi internet tersedia untuk memuat Bootstrap dan jQuery dari CDN.

## Hal penting untuk diganti sebelum publikasi
- Ganti gambar placeholder di `assets/images/` dengan foto produk asli.
- Tambahkan logo brand jika file sudah tersedia.
- Periksa nomor WhatsApp di `js/products.js` pada konstanta `WHATSAPP_NUMBER`.
- Tinjau ulang harga, deskripsi, serta kebijakan pesanan bersama mitra.

## File halaman
- `index.php`: Beranda
- `produk.php`: Katalog, pencarian, filter, detail produk
- `tentang.php`: Profil dan sejarah brand
- `kontak.php`: Kontak dan informasi pemesanan
- `keranjang.php`: Pengelolaan keranjang
- `checkout.php`: Formulir checkout dan konfirmasi WhatsApp

## Catatan sistem
Website tidak menggunakan backend atau database. Data produk bersifat statis. Pesanan tidak disimpan di server; pelanggan mengirimkan ringkasan melalui WhatsApp untuk dikonfirmasi admin. Harga subtotal di keranjang menggunakan harga minimum setiap kategori sebagai perkiraan, bukan harga final untuk produk custom. Ongkos kirim dikonfirmasi terpisah.
