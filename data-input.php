<<<<<<< HEAD
<?php 

include_once 'config/class-menu.php';
$menu = new Menu();

// Daftar status menu (bukan status mahasiswa)
$statusList = [
    ['id' => 1, 'nama' => 'Tersedia'],
    ['id' => 2, 'nama' => 'Tidak Tersedia']
];
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'failed') {
        echo "<script>alert('Gagal menambahkan data menu. Silakan coba lagi.');</script>";

=======
<?php
// Panggil file class
include_once 'config/class-master.php';

// Buat objek master
$master = new MasterData();

// --- Kategori manual: Sirih Daun & Sirih Buah ---
$kategoriList = [
    ['id' => 1, 'nama' => 'Sirih Daun'],
    ['id' => 2, 'nama' => 'Sirih Buah']
];

// Alert notifikasi
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'failed') {
        echo "<script>alert('Gagal menambahkan data produk.');</script>";
    } elseif ($_GET['status'] == 'success') {
        echo "<script>alert('Berhasil menambahkan data produk!');</script>";
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
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

<<<<<<< HEAD
				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Input Menu</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Input Menu</li>
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
										<h3 class="card-title">Formulir Data Menu</h3>
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
                                    <form action="proses/proses-input.php" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Menu</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Menu" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="kategori" class="form-label">Kategori</label>
                                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukkan kategori menu" required>
                                            <div class="mb-3">
                                                <label for="harga" class="form-label">Harga</label>
                                                <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga menu" required>
                                            </div>           
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi menu" required>
                                            </div>   
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($statusList as $status){
                                                        echo '<option value="'.$status['id'].'">'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
										<button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
										<button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
										<button type="submit" class="btn btn-primary float-end">Submit</button>

                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
=======
                                    <div class="mb-3">
                                        <label for="id_produk" class="form-label">ID Produk</label>
                                        <input type="text" class="form-control" id="id_produk" name="id_produk" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="nama" name="nama_produk" required>
                                    </div>
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa

                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga Produk</label>
                                        <input type="number" class="form-control" id="harga" name="harga_produk" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok Produk</label>
                                        <select class="form-select" id="stok" name="stok_produk" required>
                                            <option value="" selected disabled>Pilih Status Stok</option>
                                            <option value="Masih Ada">Masih Ada</option>
                                            <option value="Hampir Habis">Hampir Habis</option>
                                            <option value="Habis">Habis</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategory" required>
                                            <option value="" selected disabled>Pilih Kategori</option>
                                            <?php 
                                            foreach ($kategoriList as $kategori){
                                                echo '<option value="'.$kategori['nama'].'">'.$kategori['nama'].'</option>';
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
