<?php
// Perpustakaan/cari.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data pencarian dari pengguna
    $searchTerm = $_POST['search_term'];

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

    // Jalankan kueri pencarian
    $query = "SELECT * FROM buku WHERE judul_buku LIKE :searchTerm";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $stmt->execute();

    // Ambil hasil pencarian
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Tampilkan hasil pencarian
    foreach ($results as $result) {
        echo $result['judul_buku'] . "<br>";
    }
} else {
    // Tampilkan formulir pencarian jika tidak ada permintaan POST
    echo '<form method="POST" action="cari.php">
            <input type="text" name="search_term" placeholder="Masukkan kata kunci">
            <input type="submit" value="Cari">
          </form>';
}
?>
