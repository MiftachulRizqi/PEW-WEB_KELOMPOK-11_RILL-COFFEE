<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'rill_coffee';

// Buat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['Nama'];
$alamat = $_POST['Alamat-Yang-Dituju'];
$minuman = $_POST['Pilih-Minuman'];
$jumlah = $_POST['Jumlah-Pesanan'];
$hargaPerItem = 15000; // Harga tetap per minuman
$totalHarga = $hargaPerItem * $jumlah;

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO orders (nama, alamat, minuman, jumlah, total_harga) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssii", $nama, $alamat, $minuman, $jumlah, $totalHarga);

if ($stmt->execute()) {
    // Redirect ke halaman checkout dengan parameter
    header("Location: checkout.html?Nama=$nama&Alamat-Yang-Dituju=$alamat&Pilih-Minuman=$minuman&Jumlah-Pesanan=$jumlah");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
