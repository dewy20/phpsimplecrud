<?php
// Menghubungkan ke file konfigurasi database
include_once 'db-config.php';

class Menu extends Database {

    // ===== 1️⃣ INPUT MENU BARU =====
    public function inputMenu($data){
        // Mengambil data dari form (array $data)
        $nama      = $data['nama'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];

        // ⚠️ Gunakan query INSERT untuk menambah data
        $query = "INSERT INTO tb_menu (nama_menu, kategori, harga, deskripsi, status) VALUES (?, ?, ?, ?, ?)";
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
    public function getAllMenu(){
        $query = "SELECT id_menu, nama_menu, kategori, harga, deskripsi, status FROM tb_menu";
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
    public function getUpdateMenu($id){
        $query = "SELECT * FROM tb_menu WHERE id_menu = ?";
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
    public function getMenuById($id){
        $query = "SELECT * FROM tb_menu WHERE id_menu = ?";
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
    public function editMenu($data){
        $id        = $data['id_menu'];
        $nama      = $data['nama_menu'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $deskripsi = $data['deskripsi'];
        $status    = $data['status'];

        $query = "UPDATE tb_menu SET nama_menu = ?, kategori = ?, harga = ?, deskripsi = ?, status = ? WHERE id_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssissi", $nama, $kategori, $harga, $deskripsi, $status, $id);
        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    // ===== 5️⃣ MENGHAPUS MENU =====
    public function deleteMenu($id){
        $query = "DELETE FROM tb_menu WHERE id_menu = ?";
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
    public function searchMenu($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_menu, nama_menu, kategori, harga, deskripsi, status 
                  FROM tb_menu 
                  WHERE nama_menu LIKE ? OR kategori LIKE ?";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return [];
        }

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $menu = [];

        while($row = $result->fetch_assoc()){
            $menu[] = $row;
        }

        $stmt->close();
        return $menu;
    }
}
?>
