<?php
// Perpustakaan/fitur.php

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
        case 'baca-riwayat':
            // Logika untuk membaca riwayat peminjaman
            echo "Anda membaca riwayat peminjaman.";
            break;

        case 'lihat-profil':
            // Logika untuk melihat profil pengguna
            echo "Anda melihat profil pengguna.";
            break;

        default:
            // Menampilkan halaman utama dengan daftar fitur
            echo "<h2>Fitur-fitur Perpustakaan:</h2>";
            echo "<ul>";
            echo "<li><a href='fitur.php?action=baca-riwayat'>Baca Riwayat Peminjaman</a></li>";
            echo "<li><a href='fitur.php?action=lihat-profil'>Lihat Profil</a></li>";
            // Tambahkan fitur lainnya di sini
            echo "</ul>";
            break;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima permintaan berdasarkan metode POST
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    // Melakukan aksi sesuai dengan permintaan pengguna
    switch ($action) {
        case 'ganti-password':
            // Logika untuk mengganti kata sandi pengguna
            // Validasi dan pemrosesan ganti kata sandi di sini
            echo "Kata sandi berhasil diganti.";
            break;

        case 'perbarui-profil':
            // Logika untuk memperbarui profil pengguna
            // Validasi dan pemrosesan pembaruan profil di sini
            echo "Profil pengguna berhasil diperbarui.";
            break;

        default:
            // Menampilkan halaman utama dengan daftar fitur
            echo "<h2>Fitur-fitur Perpustakaan:</h2>";
            echo "<ul>";
            echo "<li><a href='fitur.php?action=baca-riwayat'>Baca Riwayat Peminjaman</a></li>";
            echo "<li><a href='fitur.php?action=lihat-profil'>Lihat Profil</a></li>";
            // Tambahkan fitur lainnya di sini
            echo "</ul>";
            break;
    }
} else {
    // Metode permintaan tidak valid
    showErrorMessage("Metode permintaan tidak valid.");
}
?>
