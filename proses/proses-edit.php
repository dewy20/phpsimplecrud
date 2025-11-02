<?php

// 1. Memasukkan file class-master.php (Sesuaikan path jika berbeda)
include '../config/class-master.php'; 

// 2. Membuat objek dari class MasterData (Asumsi sudah ada db-config di dalamnya)
$master = new MasterData();

// 3. Mengambil data dari form POST
// Pastikan nama keys di sini (id_produk, nama_produk, dst.) sesuai dengan 'name' atribut di form edit Anda
$dataUpdate = [
    // PENTING: ID Produk harus ada untuk kondisi WHERE di SQL UPDATE
    'id_produk' => $_POST['id_produk'], 
    'nama_produk' => $_POST['nama_produk'],
    // Pastikan ini sesuai dengan variabel yang digunakan di method updateProduk()
    'harga' => $_POST['harga_produk'], 
    'stok' => $_POST['stok_produk'], 
    'id_kategory' => $_POST['kategory']
];

// 4. Memanggil method updateProduk
$update = $master->updateProduk($dataUpdate);

// 5. Mengecek hasil dan melakukan redirect
if ($update) {
    // Jika berhasil, redirect ke halaman data-list.php dengan status success
    header("Location: ../data-list.php?status=editsuccess");
    exit; 
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status failed
    header("Location: ../data-list.php?status=editfailed");
    exit;
}
?>