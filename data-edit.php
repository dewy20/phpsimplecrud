<?php
// 1️⃣ Memanggil file class-menu.php
include_once 'config/class-menu.php';

// 2️⃣ Membuat objek dari class Menu
$produk = new Menu();

// 3️⃣ Mengecek apakah ada parameter ID di URL (misalnya: data-edit.php?id=3)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // 4️⃣ Mengambil data menu berdasarkan ID
    $dataMenu = $menu->getMenuById($id);

    // 5️⃣ Jika data tidak ditemukan, tampilkan pesan error
    if (!$dataMenu) {
        echo "<script>alert('Data menu tidak ditemukan!'); window.location.href='data-list.php';</script>";
        exit;
    }
} else {
    // Jika tidak ada ID di URL, kembalikan ke halaman list
    echo "<script>alert('ID menu tidak ditemukan!'); window.location.href='data-list.php';</script>";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>

<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">

        <!-- Navbar dan Sidebar -->
        <?php include 'template/navbar.php'; ?>
        <?php include 'template/sidebar.php'; ?>

        <main class="app-main">

            <!-- Header Halaman -->
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Edit Data Menu</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Menu</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Isi Utama Halaman -->
            <div class="app-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Form Edit Menu</h3>
                                </div>

                                <!-- Form Edit Data Menu -->
                                <form action="proses/proses-edit.php" method="POST">
                                    <div class="card-body">
                                        
                                        <!-- Input tersembunyi untuk ID -->
                                        <input type="hidden" name="id_menu" value="<?php echo htmlspecialchars($dataMenu['id_menu']); ?>">

                                        <!-- Nama Menu -->
                                        <div class="mb-3">
                                            <label for="nama_menu" class="form-label">Nama Menu</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="nama_menu" 
                                                name="nama_menu"
                                                value="<?php echo htmlspecialchars($dataMenu['nama_menu']); ?>" 
                                                required>
                                        </div>

                                        <!-- Kategori -->
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="kategori" 
                                                name="kategori"
                                                value="<?php echo htmlspecialchars($dataMenu['kategori']); ?>" 
                                                required>
                                        </div>

                                        <!-- Harga -->
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input 
                                                type="number" 
                                                class="form-control" 
                                                id="harga" 
                                                name="harga"
                                                value="<?php echo htmlspecialchars($dataMenu['harga']); ?>" 
                                                required>
                                        </div>

                                        <!-- Deskripsi -->
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea 
                                                class="form-control" 
                                                id="deskripsi" 
                                                name="deskripsi" 
                                                rows="3"
                                                required><?php echo htmlspecialchars($dataMenu['deskripsi']); ?></textarea>
                                        </div>

                                        <!-- Status -->
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="Tersedia" <?php echo ($dataMenu['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                                                <option value="Tidak Tersedia" <?php echo ($dataMenu['status'] == 'Tidak Tersedia') ? 'selected' : ''; ?>>Tidak Tersedia</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Tombol Simpan -->
                                    <div class="card-footer">
                                        <a href="data-list.php" class="btn btn-secondary me-2 float-start">Batal</a>
                                        <button type="submit" class="btn btn-warning float-end">Update Data</button>
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
