<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class Produk extends Database {

    // Method untuk input data produk
    public function inputProduk($data){
        $id     = $data['id'];
        $nama      = $data['nama'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $stok      = $data['stok'];
        $deskripsi = $data['deskripsi'];

        $query = "INSERT INTO tb_produk (kode_produk, nama_produk, kategori_produk, harga, stok, deskripsi) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("sssdis", $kode, $nama, $kategori, $harga, $stok, $deskripsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mengambil semua data produk
    public function getAllProduk(){
        $query = "SELECT id_produk, kode_produk, nama_produk, nama_kategori, harga, stok, deskripsi
                  FROM tb_produk
                  JOIN tb_kategori ON kategori_produk = kode_kategori";
        $result = $this->conn->query($query);
        $produk = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $produk[] = [
                    'id' => $row['id_produk'],
                    'kode' => $row['kode_produk'],
                    'nama' => $row['nama_produk'],
                    'kategori' => $row['nama_kategori'],
                    'harga' => $row['harga'],
                    'stok' => $row['stok'],
                    'deskripsi' => $row['deskripsi']
                ];
            }
        }
        return $produk;
    }

    // Method untuk mengambil data produk berdasarkan ID
    public function getUpdateProduk($id){
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id' => $row['id_produk'],
                'kode' => $row['kode_produk'],
                'nama' => $row['nama_produk'],
                'kategori' => $row['kategori_produk'],
                'harga' => $row['harga'],
                'stok' => $row['stok'],
                'deskripsi' => $row['deskripsi']
            ];
        }
        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data produk
    public function editProduk($data){
        $id        = $data['id'];
        $kode      = $data['kode'];
        $nama      = $data['nama'];
        $kategori  = $data['kategori'];
        $harga     = $data['harga'];
        $stok      = $data['stok'];
        $deskripsi = $data['deskripsi'];

        $query = "UPDATE tb_produk 
                  SET kode_produk = ?, nama_produk = ?, kategori_produk = ?, harga = ?, stok = ?, deskripsi = ? 
                  WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("sssdisi", $kode, $nama, $kategori, $harga, $stok, $deskripsi, $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data produk
    public function deleteProduk($id){
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

    // Method untuk mencari produk berdasarkan kata kunci
    public function searchProduk($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_produk, kode_produk, nama_produk, nama_kategori, harga, stok, deskripsi
                  FROM tb_produk
                  JOIN tb_kategori ON kategori_produk = kode_kategori
                  WHERE kode_produk LIKE ? OR nama_produk LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return [];
        }
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $produk = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $produk[] = [
                    'id' => $row['id_produk'],
                    'kode' => $row['kode_produk'],
                    'nama' => $row['nama_produk'],
                    'kategori' => $row['nama_kategori'],
                    'harga' => $row['harga'],
                    'stok' => $row['stok'],
                    'deskripsi' => $row['deskripsi']
                ];
            }
        }
        $stmt->close();
        return $produk;
    }

}

?>
