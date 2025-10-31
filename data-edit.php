<?php 
include_once 'config/class-master.php';
include_once 'config/class-produk.php';

$master = new MasterData();
$produk = new Produk();

// Ambil daftar kategori dari database
$kategoriList = $master->getKategory();

// Ambil data produk berdasarkan id
$dataProduk = $produk->getUpdateProduk($_GET['id']);

// Pesan gagal update
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data produk. Silakan coba lagi.');</script>";
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
                                <h3 class="mb-0">Edit Produk</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
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
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
                                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <form action="proses/proses-edit-produk.php" method="POST">
                                        <div class="card-body">
                                            <input type="hidden" name="id_produk" value="<?php echo $dataProduk['id_produk']; ?>">

                                            <div class="mb-3">
                                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" 
                                                       placeholder="Masukkan Nama Produk" 
                                                       value="<?php echo $dataProduk['nama_produk']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga Produk</label>
                                                <input type="number" class="form-control" id="harga" name="harga" 
                                                       placeholder="Masukkan Harga Produk" 
                                                       value="<?php echo $dataProduk['harga']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="stok" class="form-label">Stok Produk</label>
                                                <input type="number" class="form-control" id="stok" name="stok" 
                                                       placeholder="Masukkan Jumlah Stok" 
                                                       value="<?php echo $dataProduk['stok']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="id_kategory" class="form-label">Kategori Produk</label>
                                                <select class="form-select" id="id_kategory" name="id_kategory" required>
                                                    <option value="" selected disabled>Pilih Kategori</option>
                                                    <?php 
                                                    foreach ($kategoriList as $kategori){
                                                        $selected = ($dataProduk['id_kategory'] == $kategori['id_kategory']) ? "selected" : "";
                                                        echo '<option value="'.$kategori['id_kategory'].'" '.$selected.'>'.$kategori['nama_kategory'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-produk.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Produk</button>
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
