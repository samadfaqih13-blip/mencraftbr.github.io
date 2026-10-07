
/* Data produk statis. Ganti nama file gambar pada properti image setelah foto mitra tersedia. */

let PRODUCTS = [
    {
        id: "bunga",
        name: "Bucket Bunga",
        category: "Bucket Bunga",
        price: 35000,
        description: "Bucket bunga artificial dengan pilihan warna wrapping.",
        image: "bunga.jpeg"
    },
    {
        id: "uang",
        name: "Bucket Uang",
        category: "Bucket Uang",
        price: 85000,
        description: "Harga sesuai jumlah lembaran uang yang ditentukan customer.",
        image: "uang.jpeg"
    },
    {
        id: "snack",
        name: "Bucket Snack",
        category: "Bucket Snack",
        price: 50000,
        description: "Harga menyesuaikan jenis dan jumlah snack di dalam bucket.",
        image: "snack.jpeg"
    },
    {
        id: "round",
        name: "Round Bucket",
        category: "Round Bucket",
        price: 200000,
        description: "Round bucket menggunakan wrapping yang lebih premium.",
        image: "round.jpeg"
    },
    {
        id: "boneka",
        name: "Bucket Boneka",
        category: "Bucket Boneka",
        price: 65000,
        description: "Bucket yang memadukan boneka dan bunga.",
        image: "boneka.jpeg"
    },
    {
        id: "profesi",
        name: "Bucket Profesi",
        category: "Bucket Profesi",
        price: 200000,
        description: "Tersedia tema profesi Polisi, Pelayaran, TNI, Satpam, dan Dokter.",
        image: "profesi.jpeg"
    },
];

const WHATSAPP_NUMBER = "6285299829622"; // Periksa kembali nomor sebelum website dipublikasikan.

const formatRupiah = n =>
    new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
        maximumFractionDigits: 0
    }).format(n);

const priceRange = p => formatRupiah(p.price);

const getCart = () =>
    JSON.parse(localStorage.getItem("mencraftCart") || "[]");

const saveCart = cart => {
    localStorage.setItem("mencraftCart", JSON.stringify(cart));
    updateCartCount();
};

function updateCartCount() {
    const count = getCart().reduce((sum, item) => sum + item.qty, 0);

    document.querySelectorAll(".cart-count").forEach(el => {
        el.textContent = count;
    });
}

function addToCart(
    id,
    qty = 1,
    color = "Belum ditentukan",
    model = "Belum ditentukan"
) {
    const product = PRODUCTS.find(p => p.id === id);

    if (!product) return;

    const cart = getCart();
    const key = `${id}-${color}-${model}`;
    const existing = cart.find(item => item.key === key);

    if (existing) {
        existing.qty += qty;
    } else {
        cart.push({ key, id, qty, color, model });
    }

    saveCart(cart);
    alert(`${product.name} ditambahkan ke keranjang.`);
}

function productCard(p) {
    return `
        <div class="col-6 col-lg-4">
            <article class="product-card h-100">
                <img
                    src="${p.image}"
                    alt="${p.name}"
                    onerror="this.src='https://placehold.co/600x500/F0E5D8/49382B?text=${encodeURIComponent(p.name)}'"
                >

                <div class="product-card-body">
                    <span class="product-category">${p.category}</span>
                    <h3>${p.name}</h3>
                    <p class="product-price">${priceRange(p)}</p>
                    <p class="product-desc">${p.description}</p>

                    <button
                        class="btn btn-outline-primary w-100"
                        onclick="showProduct('${p.id}')"
                    >
                        Lihat Detail
                    </button>
                </div>
            </article>
        </div>
    `;
}

function showProduct(id) {
    const p = PRODUCTS.find(x => x.id === id);

    if (!p) return;

    $("#modal-product-content").html(`
        <div class="row g-4">
            <div class="col-md-6">
                <img
                    class="img-fluid rounded-4 w-100"
                    src="${p.image}"
                    alt="${p.name}"
                    onerror="this.src='https://placehold.co/600x500/F0E5D8/49382B?text=${encodeURIComponent(p.name)}'"
                >
            </div>

            <div class="col-md-6">
                <p class="eyebrow">${p.category}</p>
                <h2>${p.name}</h2>
                <h5 class="product-price">${priceRange(p)}</h5>
                <p>${p.description}</p>

                <p class="small text-muted">
                    Harga akhir dapat bergantung pada pilihan dan permintaan custom.
                    Silakan konfirmasi kepada admin.
                </p>

                <label class="form-label">Warna wrapping</label>
                <input
                    id="detail-color"
                    class="form-control mb-3"
                    placeholder="Contoh: cream dan dusty pink"
                >

                <label class="form-label">Model / catatan custom</label>
                <input
                    id="detail-model"
                    class="form-control mb-3"
                    placeholder="Tuliskan model yang diinginkan"
                >

                <label class="form-label">Jumlah</label>
                <input
                    id="detail-qty"
                    class="form-control mb-3"
                    type="number"
                    min="1"
                    value="1"
                >

                <button
                    class="btn btn-primary w-100"
                    onclick="addToCart(
                        '${p.id}',
                        Math.max(1, parseInt($('#detail-qty').val()) || 1),
                        $('#detail-color').val() || 'Belum ditentukan',
                        $('#detail-model').val() || 'Belum ditentukan'
                    )"
                >
                    Tambah ke Keranjang
                </button>
            </div>
        </div>
    `);

    bootstrap.Modal
        .getOrCreateInstance(document.getElementById("productModal"))
        .show();
}

function renderCart() {
    const cart = getCart();
    const target = $("#cart-content");

    if (!cart.length) {
        target.html(`
            <div class="empty-state">
                <h3>Keranjangmu masih kosong</h3>
                <p>Yuk, temukan bucket untuk momen spesialmu.</p>
                <a href="produk.php" class="btn btn-primary">
                    Jelajahi Produk
                </a>
            </div>
        `);

        return;
    }

    let subtotal = 0;

    const rows = cart.map(item => {
        const p = PRODUCTS.find(x => x.id === item.id);

        if (!p) return "";

        const line = p.price * item.qty;
        subtotal += line;

        return `
            <div class="cart-row">
                <img
                    src="${p.image}"
                    alt="${p.name}"
                    onerror="this.src='https://placehold.co/120x120/F0E5D8/49382B?text=Bucket'"
                >

                <div class="flex-grow-1">
                    <h5>${p.name}</h5>

                    <small>
                        Warna: ${item.color}<br>
                        Model: ${item.model}
                    </small>

                    <div class="text-muted small mt-1">
                        ${priceRange(p)} / item
                    </div>
                </div>

                <div class="cart-controls">
                    <button
                        class="btn btn-sm btn-light"
                        onclick="changeQty('${item.key}', -1)"
                    >
                        −
                    </button>

                    <span>${item.qty}</span>

                    <button
                        class="btn btn-sm btn-light"
                        onclick="changeQty('${item.key}', 1)"
                    >
                        +
                    </button>

                    <button
                        class="btn btn-sm btn-link text-danger"
                        onclick="removeItem('${item.key}')"
                    >
                        Hapus
                    </button>
                </div>
            </div>
        `;
    }).join("");

    target.html(`
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-card">
                    ${rows}
                </div>
            </div>

            <div class="col-lg-4">
                <aside class="summary-card">
                    <h4>Ringkasan belanja</h4>

                    <div class="d-flex justify-content-between">
                        <span>Subtotal minimum</span>
                        <strong>${formatRupiah(subtotal)}</strong>
                    </div>

                    <p class="small text-muted mt-2">
                        Harga akhir dapat berubah sesuai custom.
                        Ongkos kirim belum dihitung.
                    </p>

                    <a href="checkout.php" class="btn btn-primary w-100 mt-2">
                        Lanjut Checkout
                    </a>

                    <a href="produk.php" class="btn btn-outline-primary w-100 mt-2">
                        Lanjut Belanja
                    </a>
                </aside>
            </div>
        </div>
    `);
}

function changeQty(key, delta) {
    const cart = getCart();
    const item = cart.find(x => x.key === key);

    if (item) {
        item.qty = Math.max(1, item.qty + delta);
    }

    saveCart(cart);
    renderCart();
}

function removeItem(key) {
    saveCart(getCart().filter(x => x.key !== key));
    renderCart();
}

function renderCheckout() {
    const cart = getCart();
    let subtotal = 0;

    if (!cart.length) {
        $("#checkout-summary").html(`
            <p>Keranjang masih kosong.</p>
            <a href="produk.php">Pilih produk</a>
        `);

        $("#checkout-form button[type=submit]").prop("disabled", true);

        return;
    }

    const html = cart.map(item => {
        const p = PRODUCTS.find(x => x.id === item.id);

        if (!p) return "";

        subtotal += p.price * item.qty;

        return `
            <div class="summary-item">
                <span>
                    ${p.name} × ${item.qty}

                    <small class="d-block text-muted">
                        ${item.color} · ${item.model}
                    </small>
                </span>

                <strong>${formatRupiah(p.price * item.qty)}</strong>
            </div>
        `;
    }).join("");

    $("#checkout-summary").html(html);
    $("#checkout-total").text(formatRupiah(subtotal));
}

async function loadProductsFromDatabase() {
    try {
        const response = await fetch("api/products.php", { cache: "no-store" });
        const result = await response.json();
        if (result.success && Array.isArray(result.data)) {
            PRODUCTS.length = 0;
            PRODUCTS.push(...result.data);
        }
    } catch (error) {
        console.warn("Produk database tidak dapat dimuat. Menggunakan data bawaan.", error);
    }
}

$(async function () {
    await loadProductsFromDatabase();
    updateCartCount();

    if ($("#featured-products").length) {
        $("#featured-products").html(
            PRODUCTS.slice(0, 4).map(productCard).join("")
        );
    }

    if ($("#product-list").length) {
        PRODUCTS.forEach(p => {
            if (!$(`#category-filter option[value="${p.category}"]`).length) {
                $("#category-filter").append(
                    `<option value="${p.category}">${p.category}</option>`
                );
            }
        });

        const render = () => {
            const term = $("#product-search").val().toLowerCase();
            const cat = $("#category-filter").val();

            const filtered = PRODUCTS.filter(p =>
                (
                    p.name.toLowerCase().includes(term) ||
                    p.description.toLowerCase().includes(term)
                ) &&
                (cat === "all" || p.category === cat)
            );

            $("#product-list").html(filtered.map(productCard).join(""));
            $("#no-results").toggleClass("d-none", filtered.length > 0);
        };

        $("#product-search, #category-filter").on("input change", render);

        render();
    }

    if ($("#cart-content").length) {
        renderCart();
    }

    if ($("#checkout-summary").length) {
        renderCheckout();
    }

    if ($("#contact-whatsapp").length) {
        $("#contact-whatsapp")
            .attr(
                "href",
                `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(
                    "Halo @mencraft.id, saya ingin bertanya tentang produk bucket."
                )}`
            )
            .attr("target", "_blank")
            .attr("rel", "noopener");
    }

    $("#checkout-form").on("submit", async function (e) {
        e.preventDefault();
        if (!this.reportValidity()) return;
        const cart = getCart();
        if (!cart.length) { alert("Keranjang masih kosong."); return; }
        const name = $("#customer-name").val().trim();
        const phone = $("#customer-phone").val().trim();
        const address = $("#customer-address").val().trim();
        const payment = $("#payment-method").val();
        const note = $("#custom-note").val().trim();
        const submitButton = $(this).find("button[type=submit]");
        const originalText = submitButton.text();
        submitButton.prop("disabled", true).text("Menyimpan pesanan...");
        try {
            const saveResponse = await fetch("api/save_order.php", {
                method: "POST", headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ name, phone, address, payment, note, cart })
            });
            const result = await saveResponse.json();
            if (!result.success) throw new Error(result.message || "Pesanan gagal disimpan.");
            const lines = cart.map(item => {
                const p = PRODUCTS.find(x => x.id === item.id);
                return p ? `- ${p.name} x${item.qty}\n  Warna: ${item.color}\n  Model: ${item.model}\n  Harga: ${formatRupiah(p.price * item.qty)}` : "";
            }).filter(Boolean);
            const total = cart.reduce((sum,item) => { const p=PRODUCTS.find(x=>x.id===item.id); return sum+(p?p.price*item.qty:0); },0);
            const message = `Halo @mencraft.id, saya ingin konfirmasi pesanan dari website.\n\nKode Pesanan: ${result.data.order_code}\nNama: ${name}\nWhatsApp pelanggan: ${phone}\nAlamat: ${address}\n\nDetail pesanan:\n${lines.join("\n")}\n\nSubtotal minimum produk: ${formatRupiah(total)}\nMetode pembayaran: ${payment}\nCatatan custom: ${note || "-"}\n\nPesanan sudah tercatat di sistem dengan kode ${result.data.order_code}. Mohon konfirmasi harga akhir, ketersediaan, ongkos kirim, dan detail pembayaran. Saya memahami bucket custom dipesan minimal H-1. Terima kasih.`;
            window.open(`https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(message)}`, "_blank", "noopener");
            localStorage.removeItem("mencraftCart");
            updateCartCount();
            alert(`Pesanan ${result.data.order_code} berhasil disimpan. WhatsApp akan dibuka untuk konfirmasi.`);
            window.location.href = "index.php";
        } catch (error) {
            alert(error.message || "Terjadi kesalahan saat menyimpan pesanan.");
        } finally {
            submitButton.prop("disabled", false).text(originalText);
        }
    });
});