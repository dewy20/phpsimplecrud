<?php
<<<<<<< HEAD
// Menghubungkan ke file konfigurasi database
include_once 'db-config.php';

class produk extends Database {

    // ===== 1️⃣ INPUT MENU BARU =====
    public function inputproduk($data){
        // Mengambil data dari form (array $data)
        $nama      = $data['nama'];
        $kategori  = $data['kategory'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];

        // ⚠️ Gunakan query INSERT untuk menambah data
        $query = "INSERT INTO tb_produk (nama_menu, kategory, harga, deskripsi, status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        // Cek apakah statement berhasil dibuat
        if(!$stmt){
            return false;
        }

        // Mengikat parameter ke query
        $stmt->bind_param("ssiss", $nama, $kategori, $harga, $deskripsi, $status);

        // Eksekusi dan simpan hasilnya
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 2️⃣ MENGAMBIL SEMUA DATA MENU =====
    public function getAllproduk(){
        $query = "SELECT id_produk, nama_produk, kategory, harga, stok deskripsi, status FROM tb_produk";
        $result = $this->conn->query($query);
        $menu = [];

        if($result && $result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $menu[] = $row;
            }
        }
        return $menu;
    }

    // ===== 3️⃣ MENGAMBIL MENU BERDASARKAN ID (getUpdateMenu - lama) =====
    public function getUpdateproduk($id){
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    // ✅ ===== 3b️⃣ TAMBAHAN BARU: getMenuById() =====
    // (fungsi ini yang dipakai oleh data-edit.php)
    public function getprodukById($id){
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        return $data;
    }

    // ===== 4️⃣ MENGEDIT MENU =====
    public function editproduk($data){
        $id        = $data['id_produk'];
        $nama      = $data['nama_produk'];
        $kategori  = $data['kategory'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];

        $query = "UPDATE tb_produk SET nama_produk = ?, kategory = ?, harga = ?, deskripsi = ?, status = ? WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssissi", $nama, $kategory, $harga, $deskripsi, $status, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 5️⃣ MENGHAPUS MENU =====
    public function deleteproduk($id){
        $query = "DELETE FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 6️⃣ MENCARI MENU BERDASARKAN NAMA ATAU KATEGORI =====
    public function searchproduk($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_produk, nama_produk, kategory, harga, deskripsi, status 
                  FROM tb_produk 
                  WHERE nama_produk LIKE ? OR kategory LIKE ?";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return [];
        }
=======
// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Produk extends Database {

    // ---------------- INPUT PRODUK ----------------
    public function inputProduk($data) {
        $id     = $data['id_produk'];
        $nama   = $data['nama'];
        $harga  = $data['harga'];
        $stok   = $data['stok'];

        $query = "INSERT INTO tb_produk (id_produk, nama_produk, harga_produk, stok_produk)
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("ssii", $id, $nama, $harga, $stok);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ---------------- AMBIL SEMUA PRODUK ----------------
    public function getAllProduk() {
        $query = "SELECT id_produk, nama_produk, harga_produk, stok_produk FROM tb_produk";
        $result = $this->conn->query($query);

        $produk = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $produk[] = [
                    'id_produk'    => $row['id_produk'],
                    'nama_produk'  => $row['nama_produk'],
                    'harga'        => $row['harga_produk'],
                    'stok'         => $row['stok_produk']
                ];
            }
        }
        return $produk;
    }

    // ---------------- AMBIL PRODUK BERDASARKAN ID ----------------
    public function getUpdateProduk($id) {
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = false;
        if($result->num_rows > 0) {
            $data = $result->fetch_assoc();
        }

        $stmt->close();
        return $data;
    }

    // ---------------- EDIT PRODUK ----------------
    public function editProduk($data) {
        $id     = $data['id_produk'];
        $nama   = $data['nama'];
        $harga  = $data['harga'];
        $stok   = $data['stok'];

        $query = "UPDATE tb_produk 
                  SET nama_produk = ?, harga_produk = ?, stok_produk = ? 
                  WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("siis", $nama, $harga, $stok, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ---------------- HAPUS PRODUK ----------------
    public function deleteProduk($id) {
        $query = "DELETE FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // ---------------- CARI PRODUK ----------------
    public function searchProduk($kataKunci) {
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_produk, nama_produk, harga_produk, stok_produk
                  FROM tb_produk
                  WHERE id_produk LIKE ? OR nama_produk LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return [];
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
<<<<<<< HEAD
        $produk = [];

        while($row = $result->fetch_assoc()){
            $produk[] = $row;
        }

=======

        $produk = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $produk[] = [
                    'id_produk'    => $row['id_produk'],
                    'nama_produk'  => $row['nama_produk'],
                    'harga'        => $row['harga_produk'],
                    'stok'         => $row['stok_produk']
                ];
            }
        }
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
        $stmt->close();
        return $produk;
    }
}
?>
