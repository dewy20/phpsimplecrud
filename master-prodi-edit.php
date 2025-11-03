<?php
include 'config/class-master.php';
$master = new MasterData();

// Cek apakah ada parameter id
if (!isset($_GET['id'])) {
    header("Location: master-prodi-list.php?status=noid");
    exit();
}

$id = $_GET['id'];

// Ambil data menu berdasarkan id
$dataMenu = $master->getUpdateMenu($id);
if (!$dataMenu) {
    header("Location: master-prodi-list.php?status=notfound");
    exit();
}

// Cek status error jika ada
$statusFailed = isset($_GET['status']) && $_GET['status'] == 'failed';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Menu</title>
    <?php include 'template/header.php'; ?>
</head>
<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">
    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php'; ?>

    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Edit Menu: <?= htmlspecialchars($dataMenu['nama']) ?></h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <?php if ($statusFailed): ?>
                    <div class="alert alert-danger" role="alert">
                        Gagal menyimpan perubahan, silakan coba lagi.
                    </div>
                <?php endif; ?>

                <form action="proses/proses-prodi.php?aksi=updatemenu" method="POST">
                    <input type="hidden" name="kode" value="<?= htmlspecialchars($dataMenu['id']) ?>">

                    <div class="mb-3">
                        <label>Nama Menu</label>
                        <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($dataMenu['nama']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="<?= htmlspecialchars($dataMenu['kategori']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Harga</label>
                        <input type="number" name="harga" class="form-control" value="<?= htmlspecialchars($dataMenu['harga']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Porsi</label>
                        <input type="number" name="porsi" class="form-control" value="<?= htmlspecialchars($dataMenu['porsi']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Bahan Utama</label>
                        <input type="text" name="bahan" class="form-control" value="<?= htmlspecialchars($dataMenu['bahan']) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    <a href="master-prodi-list.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </main>

    <?php include 'template/footer.php'; ?>
</div>

<?php include 'template/script.php'; ?>
</body>
</html>
