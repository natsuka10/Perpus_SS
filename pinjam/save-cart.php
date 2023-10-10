<?php
echo "test";
// Perpustakaan/pinjam/save-cart.php

// Hubungkan ke sesi (jika diperlukan)
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan ada sesi keranjang belanja yang tersedia
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Hubungkan ke database (gunakan PDO sebagai contoh)
        $dsn = 'mysql:host=localhost;dbname=perpustakaan;charset=utf8mb4';
        $username = 'root';
        $password = 'farid23';

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Koneksi ke database gagal: ' . $e->getMessage());
        }

        try {
            // Hitung jumlah buku dalam keranjang belanja
            $jumlahPeminjaman = count($_SESSION['cart']);
            
            // Simpan peminjaman buku
            $tanggalPeminjaman = $_POST['tanggal_peminjaman']; 
            $tanggalPeminjamanFormatted = date("Y-m-d", strtotime($tanggalPeminjaman));
            $query = "INSERT INTO peminjaman (jumlah, tanggal) VALUES (:jumlah, :tanggal)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':jumlah', $jumlahPeminjaman, PDO::PARAM_INT);
            $stmt->bindParam(':tanggal', $tanggalPeminjamanFormatted);
            $stmt->execute();

            // Dapatkan ID peminjaman yang baru saja dimasukkan
            $idPeminjaman = $pdo->lastInsertId();

            // Simpan setiap buku dalam keranjang sebagai bagian dari peminjaman
            $query = "INSERT INTO dipinjam (peminjaman_id, buku_id, hari) VALUES (:peminjamanId, :bukuId, :hari)";
            $stmt = $pdo->prepare($query);

            foreach ($_SESSION['cart'] as $book) {
                $stmt->bindParam(':peminjamanId', $idPeminjaman, PDO::PARAM_INT);
                $stmt->bindParam(':bukuId', $book['book_id'], PDO::PARAM_INT);
                $stmt->bindParam(':hari', $book['jumlah'], PDO::PARAM_INT);
                $stmt->execute();
            }

            // Commit transaksi
            $pdo->commit();
            
            // Hapus keranjang belanja setelah berhasil menyimpan peminjaman
            unset($_SESSION['cart']);
            
        } catch (PDOException $e) {
            // Rollback transaksi jika ada kesalahan
            $pdo->rollback();
            echo "Gagal menyimpan peminjaman: " . $e->getMessage();
        }
    } else {
        echo "Keranjang Kosong";
    }
} else {
    echo '<form method="POST" action="save-cart.php">
            <input type="date" name="tanggal_peminjaman" placeholder="Tanggal Peminjaman">
            <input type="submit" value="Simpan Peminjaman">
          </form>';
}
?>
