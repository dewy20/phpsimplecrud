<?php 
include_once 'config/class-master.php';
include_once 'config/class-produk.php';

<<<<<<< HEAD
include_once 'config/class-menu.php';
$menu = new Menu();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data menu berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data menu berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data menu berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data menu. Silakan coba lagi.');</script>";
	}
}
$datamenu = $menu->getAllMenu();

=======
$produk = new produk();
$master = new MasterData();

// Ambil semua data produk
$dataproduk = $produk->getAllproduk();

// Pesan setelah proses hapus/update/tambah
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'success') {
        echo "<script>alert('Data berhasil diproses!');</script>";
    } elseif ($_GET['status'] == 'failed') {
        echo "<script>alert('Gagal memproses data. Silakan coba lagi.');</script>";
    }
}
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
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
                                <h3 class="mb-0">Data produk</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Produk</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

<<<<<<< HEAD
			<main class="app-main">
				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Daftar Menu</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Home</li>
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
										<h3 class="card-title">Tabel Menu</h3>
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
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Menu</th>
													<th>Kategori</th>
													<th>Harga</th>
													<th>Deskripsi</th>
													<th class="text-center">Status</th>
												</tr>
											</thead>
											<tbody>
									<?php
									if(count($datamenu) == 0){
										echo '<tr class="align-middle">
										<td colspan="10" class="text-center">Tidak ada data menu.</td>
										</tr>';
									} else {
										foreach ($datamenu as $index => $menu){
										// Status tampilan
										if($menu['status'] == 1 || strtolower($menu['status']) == 'tersedia'){
										$status = '<span class="badge bg-success">Tersedia</span>';
										} else {
										$status = '<span class="badge bg-danger">Tersedia</span>';
										$status = '<span class="badge bg-danger">Tidak tersedia</span>';
									}

									echo '<tr class="align-middle">
										<td>'.($index + 1).'</td>
										<td>'.$menu['nama_menu'].'</td>
										<td>'.$menu['kategori'].'</td>
										<td>'.$menu['harga'].'</td>
										<td>'.$menu['deskripsi'].'</td>
										<td class="text-center">'.$status.'</td>
										<td class="text-center">
										<a href="data-edit.php?id='.$menu['id_menu'].'" class="btn btn-sm btn-warning me-1">Edit</a>
										<a href="proses/proses-delete.php?id='.$menu['id_menu'].'" class="btn btn-sm btn-danger" onclick="return confirm(\'Yakin ingin menghapus?\')">Hapus</a>
													</td>
												</tr>';
											}
										}
										?>

											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-edit.php'"><i class="bi bi-plus-lg"></i> Tambah Menu</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
=======
                <div class="app-content">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Produk</h3>
                                <div class="card-tools">
                                    <a href="input-produk.php" class="btn btn-success btn-sm">
                                        <i class="bi bi-plus-circle"></i> Tambah Produk
                                    </a>
                                </div>
                            </div>

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>id produk</th>
                                            <th>nama produk</th>
                                            <th>harga</th>
                                            <th>stok</th>
                                            <th>kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if (!empty($dataproduk)) {
                                            $no = 1;
                                            foreach ($dataproduk as $p) {

                                                // Pastikan semua data aman dari error undefined
                                                // KOREKSI NAMA KUNCI JIKA DATABASE MENGGUNAKAN NAMA BERBEDA
                                                $id_produk = $p['id_produk'] ?? '-';
                                                $nama_produk = $p['nama_produk'] ?? '-';
                                                // --- KODE YANG ANDA TANYAKAN DIMULAI DARI SINI ---
                                                $harga = isset($p['harga_produk']) ? number_format($p['harga_produk'], 0, ',', '.') : '0'; 
                                                $stok = $p['stok_produk'] ?? '0'; 
                                                $kategori = $p['nama_kategory'] ?? ($p['id_kategory'] ?? '-'); 
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa

                                                echo "
                                                <tr class='text-center'>
                                                    <td>{$no}</td>
                                                    <td>{$id_produk}</td>
                                                    <td>{$nama_produk}</td>
                                                    <td>Rp {$harga}</td>
                                                    <td>{$stok}</td>
                                                    <td>{$kategori}</td>
                                                    <td>
                                                    <a href='edit-produk.php?id={$id_produk}' class='btn btn-warning btn-sm'>
                                                    <i class='bi bi-pencil-square'></i> Edit
                                                    </a>
                                                    <a href='proses/proses-hapus-produk.php?id={$id_produk}' 
                                                    class='btn btn-danger btn-sm' 
                                                    onclick=\"return confirm('Apakah Anda yakin ingin menghapus produk ini?');\">
                                                    <i class='bi bi-trash'></i> Hapus
                                                    </a>
                                                </td>
                                                </tr>";
                                                    $no++;
                                                }
                                                } else {
                                                    echo "<tr><td colspan='7' class='text-center'>Belum ada data produk</td></tr>";
                                                }
                                           ?>
                                    </tbody>
                                 </table>
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
