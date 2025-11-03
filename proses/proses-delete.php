<?php
// 1️⃣ Menghubungkan ke file class-menu.php
include_once '../config/class-produk.php';

// 2️⃣ Membuat objek dari class Menu
$menu = new Menu();

// 3️⃣ Mengecek apakah ada ID dikirim lewat URL (GET)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 4️⃣ Memanggil fungsi deleteMenu dari class Menu
    $delete = $produk->deleteProduk($id);

    // 5️⃣ Cek apakah proses berhasil
    if ($delete) {
        header("Location: ../data-list.php?status=deletesuccess");
    } else {
        header("Location: ../data-list.php?status=deletefailed");
    }
} else {
    // Jika tidak ada ID di URL
    header("Location: ../data-list.php?status=noid");
}
?>
