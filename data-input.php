<?php
// Panggil file class
include_once 'config/class-master.php';

// Buat objek master
$master = new MasterData();

// Ambil semua kategori dari tabel tb_kategory
$kategoriList = $master->getKategory();

// Alert notifikasi
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'failed') {
        echo "<script>alert('Gagal menambahkan data produk.');</script>";
    } elseif ($_GET['status'] == 'success') {
        echo "<script>alert('Berhasil menambahkan data produk!');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php'; ?>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Input Produk</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Formulir Produk</h3>
                            </div>

                            <!-- FORM INPUT -->
                            <form action="proses/proses-input.php" method="POST">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="kode" class="form-label">Kode Produk</label>
                                        <input type="text" class="form-control" id="kode" name="kode_produk" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama" name="nama_produk" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" class="form-control" id="harga" name="harga" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" class="form-control" id="stok" name="stok" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="id_kategory" required>
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            <?php 
                                            foreach ($kategoriList as $kategori){
                                                echo '<option value="'.$kategori['id'].'">'.$kategori['nama'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                    <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'template/footer.php'; ?>

</div>
<?php include 'template/script.php'; ?>
</body>
</html>
