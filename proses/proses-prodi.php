<?php
// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

// Membuat objek dari class MasterData
$master = new MasterData();

// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if ($_GET['aksi'] == 'inputmenu') {
    // Mengambil data menu dari form input menggunakan POST
    $dataMenu = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga' => $_POST['harga'],
        'porsi' => $_POST['porsi'],
        'bahan' => $_POST['bahan']
    ];

    // Memanggil method inputMenu untuk memasukkan data menu
    $input = $master->inputMenu($dataMenu);

    if ($input) {
        header("Location: ../master-prodi-list.php?status=inputsuccess");
        exit();
    } else {
        header("Location: ../master-prodi-input.php?status=failed");
        exit();
    }

} elseif ($_GET['aksi'] == 'updatemenu') {
    // Mengambil data menu dari form edit menggunakan POST
    $dataMenu = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama'],
        'kategori' => $_POST['kategori'],
        'harga' => $_POST['harga'],
        'porsi' => $_POST['porsi'],
        'bahan' => $_POST['bahan']
    ];

    // Memanggil method updatemenu untuk mengupdate data menu
    $update = $master->updatemenu($dataMenu);

    if ($update) {
        header("Location: ../master-prodi-list.php?status=editsuccess");
        exit();
    } else {
        header("Location: ../master-prodi-edit.php?id=" . $dataMenu['kode'] . "&status=failed");
        exit();
    }

} elseif ($_GET['aksi'] == 'deletemenu') {
    // Mengambil id menu dari parameter GET
    $id = $_GET['id'];

    // Memanggil method deletemenu untuk menghapus data menu
    $delete = $master->deletemenu($id);

    if ($delete) {
        header("Location: ../master-prodi-list.php?status=deletesuccess");
        exit();
    } else {
        header("Location: ../master-prodi-list.php?status=deletefailed");
        exit();
    }
}
?>
