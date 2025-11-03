<?php
// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

<<<<<<< HEAD
// Memasukkan file class-menu.php untuk mengakses class menu
include '../config/class-menu.php';
// Membuat objek dari class menu
$menu = new Menu();
// Mengambil data menu dari form input menggunakan metode POST dan menyimpannya dalam array
$dataMenu = [
    'nama' => $_POST['nama'],
    'kategori' => $_POST['kategori'],
    'harga' => $_POST['harga'],
    'deskripsi' => $_POST['deskripsi'],
    'status' => $_POST['status'],
];
// Memanggil method inputmenu untuk memasukkan data mahasiswa dengan parameter array $datamenu
$input = $menu->inputMenu($dataMenu);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}
=======
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
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa

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