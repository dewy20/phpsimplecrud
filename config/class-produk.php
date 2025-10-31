<?php
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

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();

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
        $stmt->close();
        return $produk;
    }
}
?>
