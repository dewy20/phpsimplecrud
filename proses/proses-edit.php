<?php

// Memasukkan file class-mmenu.php untuk mengakses class Menu
include_once '../config/class-produk.php';
// Membuat objek dari class Menu
$produk = new Produk();
// Mengambil data menu dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataProdukh = [
    'nama' => $_POST['nama'],
    'kategori' => $_POST['kategori'],
    'harga' => $_POST['harga'],
    'deskripsi' => $_POST['deskripsi'],
    'status' => $_POST['status'],
];
// Memanggil method editMenu untuk mengupdate data menu dengan parameter array $dataMenu
$edit = $menu->editMenu($dataMenu);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id menu
    header("Location: ../data-edit.php?id=".$dataMenu['id']."&status=failed");
}

?>