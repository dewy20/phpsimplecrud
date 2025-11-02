<?php

// Memasukkan class MasterData. Pastikan path ini benar (dari 'proses/' ke 'config/').
include '../config/class-master.php'; 

// Membuat objek dari class MasterData
// Asumsi class MasterData sudah menginisialisasi koneksi database
$master = new MasterData(); 

// 1. Mengambil id produk dari parameter GET
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];
    
    // 2. Memanggil method deleteProduk untuk menghapus data
    // Method deleteProduk($id) ada di class MasterData Anda
    $delete = $master->deleteproduk($id_produk); 

    // 3. Mengecek hasil dan melakukan redirect
    if($delete){
        // Jika berhasil, redirect ke halaman data-list.php dengan status success
        header("Location: ../data-list.php?status=deletesuccess");
        exit;
    } else {
        // Jika gagal, redirect ke halaman data-list.php dengan status failed
        header("Location: ../data-list.php?status=deletefailed");
        exit;
    }
} else {
    // Jika tidak ada ID di URL, redirect kembali ke daftar produk
    header("Location: ../data-list.php?status=deletefailed");
    exit;
}

?>