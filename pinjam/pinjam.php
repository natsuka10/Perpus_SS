<?php
// Perpustakaan/pinjam/pinjam.php

// Hubungkan ke sesi (jika diperlukan)
session_start();

// Fungsi untuk menampilkan pesan kesalahan
function showErrorMessage($message) {
    echo "<div style='color: red;'>$message</div>";
}

// Mengecek permintaan pengguna (biasanya menggunakan parameter URL atau POST data)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Menerima permintaan berdasarkan metode GET
    $action = isset($_GET['action']) ? $_GET['action'] : '';

    // Melakukan aksi sesuai dengan permintaan pengguna
    switch ($action) {
        case 'tampilkan-keranjang':
            // Logika untuk menampilkan isi keranjang belanja
            include('read-cart.php'); // Mengarahkan ke file read-cart.php
            break;

        case 'tambahkan-buku':
            // Logika untuk menambahkan buku ke keranjang belanja
            include('add-cart.php'); // Mengarahkan ke file add-cart.php
            break;

        case 'hapus-buku':
            // Logika untuk menghapus buku dari keranjang belanja
            include('delete-cart.php'); // Mengarahkan ke file delete-cart.php
            break;

        case 'simpan-peminjaman':
            // Logika untuk menyimpan peminjaman buku
            include('save-cart.php'); // Mengarahkan ke file save-cart.php
            break;

        default:
            // Menampilkan halaman utama dengan tautan ke aksi-aksi peminjaman
            echo "<h2>Aksi Peminjaman:</h2>";
            echo "<ul>";
            echo "<li><a href='read-cart.php'>Tampilkan Keranjang Belanja</a></li>";
            echo "<li><a href='pinjam.php?action=tambahkan-buku'>Tambahkan Buku ke Keranjang</a></li>";
            echo "<li><a href='pinjam.php?action=hapus-buku'>Hapus Buku dari Keranjang</a></li>";
            echo "<li><a href='pinjam.php?action=simpan-peminjaman'>Simpan Peminjaman</a></li>";
            // Tambahkan aksi peminjaman lainnya di sini
            echo "</ul>";
            break;
    }
} else {
    // Metode permintaan tidak valid
    showErrorMessage("Metode permintaan tidak valid.");
}
?>
