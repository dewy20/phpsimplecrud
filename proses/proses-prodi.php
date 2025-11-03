<?php
// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';

// Membuat objek dari class MasterData
$master = new MasterData();

// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
<<<<<<< HEAD
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
=======
if($_GET['aksi'] == 'inputproduk'){
    // Mengambil data prodi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataproduk = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputProdi untuk memasukkan data prodi dengan parameter array $dataProdi
    $input = $master->inputproduk($dataproduk);
    if($input){
        // Jika berhasil, redirect ke halaman master-prodi-list.php dengan status inputsuccess
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
        header("Location: ../master-prodi-list.php?status=inputsuccess");
        exit();
    } else {
        header("Location: ../master-prodi-input.php?status=failed");
        exit();
    }
<<<<<<< HEAD

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
=======
} elseif($_GET['aksi'] == 'updateproduk'){
    // Mengambil data prodi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataProdi = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateProdi untuk mengupdate data prodi dengan parameter array $dataProdi
    $update = $master->updateproduk($dataproduk);
    if($update){
        // Jika berhasil, redirect ke halaman master-prodi-list.php dengan status editsuccess
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
        header("Location: ../master-prodi-list.php?status=editsuccess");
        exit();
    } else {
<<<<<<< HEAD
        header("Location: ../master-prodi-edit.php?id=" . $dataMenu['kode'] . "&status=failed");
        exit();
    }

} elseif ($_GET['aksi'] == 'deletemenu') {
    // Mengambil id menu dari parameter GET
    $id = $_GET['id'];

    // Memanggil method deletemenu untuk menghapus data menu
    $delete = $master->deletemenu($id);

    if ($delete) {
=======
        // Jika gagal, redirect ke halaman master-prodi-edit.php dengan status failed dan membawa id prodi
        header("Location: ../master-prodi-edit.php?id=".$dataprodukk['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deleteproduk'){
    // Mengambil id prodi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProdi untuk menghapus data prodi berdasarkan id
    $delete = $master->deleteproduk($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-prodi-list.php dengan status deletesuccess
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
        header("Location: ../master-prodi-list.php?status=deletesuccess");
        exit();
    } else {
        header("Location: ../master-prodi-list.php?status=deletefailed");
        exit();
    }
}
?>
