<?php
include_once 'config/class-produk.php';
$produk = new produk();
$kataKunci = '';

if (isset($_GET['search'])) {
    $kataKunci = $_GET['search'];
    $cariproduk = $produk->searchproduk($kataKunci);
}
?>
<!doctype html>
<html lang="id">
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
                            <h3 class="mb-0">Cari Produk</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Cari Produk</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Form Pencarian -->
                            <div class="card mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">🔍 Pencarian Produk</h5>
                                </div>
                                <div class="card-body">
                                    <form action="data-search.php" method="GET">
                                        <div class="mb-3">
                                            <label for="search" class="form-label">Masukkan nama produk</label>
                                            <input type="text" class="form-control" id="search" name="search"
                                                placeholder="Cari berdasarkan nama produk..."
                                                value="<?php echo htmlspecialchars($kataKunci); ?>" required>
                                        </div>
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-search-heart-fill"></i> Cari
                                        </button>
                                        <a href="data-list.php" class="btn btn-secondary">
                                            <i class="bi bi-arrow-left-circle"></i> Kembali
                                        </a>
                                    </form>
                                </div>
                            </div>

                            <!-- Hasil Pencarian -->
                            <div class="card">
                                <div class="card-header bg-dark text-white">
                                    <h5 class="card-title mb-0">Hasil Pencarian Produk</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (isset($_GET['search'])) {
                                        if (!empty($cariProduk)) {
                                            echo '<table class="table table-striped table-hover text-center align-middle">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>id Produk</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga</th>
                                                        <th>Stok</th>
                                                        <th>Kategori</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                            foreach ($cariproduk as $index => $p) {
                                                echo '<tr>
                                                    <td>' . ($index + 1) . '</td>
                                                    <td>' . htmlspecialchars($p['id_produk']) . '</td>
                                                    <td>' . htmlspecialchars($p['nama_produk']) . '</td>
                                                    <td>Rp' . number_format($p['harga'], 0, ',', '.') . '</td>
                                                    <td>' . $p['stok'] . '</td>
                                                    <td>' . htmlspecialchars($p['nama_kategori'] ?? '-') . '</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning me-1" 
                                                            onclick="window.location.href=\'data-edit.php?id=' . $p['id_produk'] . '\'">
                                                            <i class="bi bi-pencil-fill"></i> Edit
                                                        </button>
                                                        <button class="btn btn-sm btn-danger" 
                                                            onclick="if(confirm(\'Yakin ingin menghapus produk ini?\')){window.location.href=\'proses/proses-delete.php?id=' . $p['id_produk'] . '\'}">
                                                            <i class="bi bi-trash-fill"></i> Hapus
                                                        </button>
                                                    </td>
                                                </tr>';
                                            }
                                            echo '</tbody></table>';
                                        } else {
                                            echo '<div class="alert alert-warning" role="alert">
                                                    Tidak ditemukan produk dengan kata kunci "<strong>' . htmlspecialchars($_GET['search']) . '</strong>".
                                                  </div>';
                                        }
                                    } else {
                                        echo '<div class="alert alert-info" role="alert">
                                                Silakan masukkan nama produk pada kolom di atas untuk memulai pencarian.
                                              </div>';
                                    }
                                    ?>
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
