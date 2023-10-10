<?php
// Perpustakaan/pinjam/read-cart.php

// Hubungkan ke sesi (jika diperlukan)
session_start();

// Fungsi untuk menampilkan pesan kesalahan
function showErrorMessage($message) {
    echo "<div style='color: red;'>$message</div>";
}

// Mengecek apakah sesi keranjang belanja ada dan tidak kosong
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    echo "<h2>Keranjang Belanja:</h2>";
    echo "<ul>";
    
    // Menampilkan buku-buku dalam keranjang sesi pengguna saat ini
    foreach ($_SESSION['cart'] as $book) {
        echo "<li>Judul Buku: "  . $book['judul_buku'] . "</li>";
        echo "<li>Jumlah: " . $book['jumlah'] . "</li>";
        echo "<hr>";
    }
    
    echo "</ul>";
} else {
    // Tampilkan pesan jika keranjang belanja kosong
    showErrorMessage("Keranjang belanja Anda kosong.");
}
?>
