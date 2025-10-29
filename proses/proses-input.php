<?php
// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

// Membuat objek dari class MasterData
$produk = new MasterData();

// Mengambil data produk dari form input menggunakan metode POST dan menyimpannya dalam array
$dataProduk = [
    'kode_produk' => $_POST['kode_produk'],
    'nama_produk' => $_POST['nama_produk'],
    'harga' => $_POST['harga'],
    'stok' => $_POST['stok'],
    'id_kategory' => $_POST['id_kategory']
];

// Memanggil method inputProduk untuk memasukkan data produk dengan parameter array $dataProduk
$input = $produk->inputProduk($dataProduk);

// Mengecek apakah proses input berhasil atau tidak
if ($input) {
    // Jika berhasil, redirect ke halaman data-input.php dengan status success
    header("Location: ../data-input.php?status=success");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}
?>
