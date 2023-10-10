<?php
// Perpustakaan/pinjam/add-cart.php
session_start();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menerima data buku yang akan ditambahkan dari permintaan pengguna
    $bookId = $_POST['book_id'];
    $quantity = $_POST['quantity'];

    // Validasi data buku (misalnya, memastikan buku ada dalam database dan jumlahnya mencukupi)
    // ...

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

    // Mengeksekusi kueri untuk mengambil judul buku berdasarkan ID buku
    $query = "SELECT judul_buku FROM buku WHERE id_buku = :bookId";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // Mengambil hasil kueri (judul buku)
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $judulBuku = $result['judul_buku'];

        // Menambahkan buku ke keranjang belanja dalam sesi
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $book = array(
            'book_id' => $bookId,
            'jumlah' => $quantity,
            'judul_buku' => $judulBuku
        );

        $_SESSION['cart'][] = $book;

        // Redirect kembali ke halaman sebelumnya atau halaman keranjang belanja
        header("Location: add-cart.php");
    }
}
 else {
    // Tampilkan formulir untuk menambahkan buku ke keranjang belanja
    echo '<form method="POST" action="add-cart.php">
            <input type="text" name="book_id" placeholder="ID Buku">
            <input type="number" name="quantity" placeholder="Jumlah">
            <input type="submit" value="Tambahkan ke Keranjang">
          </form>';
}
?>
