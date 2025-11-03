<?php
// Memanggil class MasterData
include_once 'config/class-master.php';
$master = new MasterData();

// Menampilkan notifikasi berdasarkan status
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'inputsuccess') {
        echo "<script>alert('Data menu berhasil ditambahkan.');</script>";
    } else if ($_GET['status'] == 'editsuccess') {
        echo "<script>alert('Data menu berhasil diubah.');</script>";
    } else if ($_GET['status'] == 'deletesuccess') {
        echo "<script>alert('Data menu berhasil dihapus.');</script>";
    } else if ($_GET['status'] == 'deletefailed') {
        echo "<script>alert('Gagal menghapus data menu. Silakan coba lagi.');</script>";
    }
}

// Ambil data menu dari database
$dataMenu = $master->getMenu();
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
                            <h3 class="mb-0">Data Menu</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Master Menu</li>
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
                                    <h3 class="card-title">Daftar Menu</h3>
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
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Kategori</th>
                                                <th>Harga</th>
                                                <th>Porsi</th>
                                                <th>Bahan Utama</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (count($dataMenu) == 0) {
                                                echo '<tr class="align-middle">
                                                        <td colspan="8" class="text-center">Tidak ada data menu.</td>
                                                    </tr>';
                                            } else {
                                                foreach ($dataMenu as $index => $menu) {
                                                    echo '<tr class="align-middle">
                                                        <td>' . ($index + 1) . '</td>
                                                        <td>' . $menu['id'] . '</td>
                                                        <td>' . $menu['nama'] . '</td>
                                                        <td>' . $menu['kategori'] . '</td>
                                                        <td>' . $menu['harga'] . '</td>
                                                        <td>' . $menu['porsi'] . '</td>
                                                        <td>' . $menu['bahan'] . '</td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'master-prodi-edit.php?id=' . $menu['id'] . '\'">
                                                                <i class="bi bi-pencil-fill"></i> Edit
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data menu ini?\')){window.location.href=\'proses/proses-prodi.php?aksi=deletemenu&id=' . $menu['id'] . '\'}">
                                                                <i class="bi bi-trash-fill"></i> Hapus
                                                            </button>
                                                        </td>
                                                    </tr>';
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='master-prodi-input.php'">
                                        <i class="bi bi-plus-lg"></i> Tambah Menu
                                    </button>
                                </div>
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
