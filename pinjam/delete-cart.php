<?php
// Perpustakaan/pinjam/delete-cart.php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data buku yang akan dihapus dari permintaan pengguna
    $bookIdToRemove = $_POST['book_id'];

    // Menghapus buku dari keranjang belanja dalam sesi
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $book) {
            if ($book['book_id'] == $bookIdToRemove) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }

    // Redirect kembali ke halaman keranjang belanja
    header("Location: read-cart.php");
} else {
    // Tampilkan formulir untuk menghapus buku dari keranjang belanja
    echo '<form method="POST" action="delete-cart.php">
            <input type="text" name="book_id" placeholder="ID Buku yang akan dihapus">
            <input type="submit" value="Hapus dari Keranjang">
          </form>';
}
?>
