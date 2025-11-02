<?php
// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

// Membuat objek dari class MasterData (asumsi ini menginisialisasi koneksi)
$produk = new MasterData();

// Mengambil data produk dari form input menggunakan metode POST dan menyimpannya dalam array
$dataproduk = [
         // id_produk DIHAPUS karena AUTO INCREMENT
'nama_produk' => $_POST['nama_produk'],
 'harga' => $_POST['harga_produk'], // Sesuaikan dengan key yang digunakan di class-master.php
 'stok' => $_POST['stok_produk'],
  'id_kategory' => $_POST['kategory']
];

// Memanggil method inputProduk untuk memasukkan data produk dengan parameter array $dataProduk
$input = $produk->inputproduk($dataproduk);

// Mengecek apakah proses input berhasil atau tidak
if ($input) {
// Jika berhasil, redirect ke halaman daftar produk
 header("Location: ../data-list.php?status=success");
    exit;
} else {
// Jika gagal, redirect ke halaman input
header("Location: ../data-input.php?status=failed");
    exit;
}
?>