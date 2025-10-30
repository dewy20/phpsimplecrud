<?php
include_once 'db-config.php';

class Produk extends Database {

    // Ambil semua produk
    public function getAllProduk(){
        $query = "SELECT p.*, k.nama_kategory 
                  FROM tb_produk p 
                  LEFT JOIN tb_kategory k ON p.id_kategory = k.id_kategory";
        $result = $this->conn->query($query);

        $produk = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $produk[] = $row;
            }
        }
        return $produk;
    }

    // Input produk baru
    public function inputProduk($data){
        $kode_produk = $data['kode_produk'];
        $nama_produk = $data['nama_produk'];
        $harga = $data['harga'];
        $stok = $data['stok'];
        $id_kategory = $data['id_kategory'];

        $query = "INSERT INTO tb_produk (kode_produk, nama_produk, harga, stok, id_kategory)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssiii", $kode_produk, $nama_produk, $harga, $stok, $id_kategory);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil produk berdasarkan ID
    public function getUpdateProduk($id){
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){ return false; }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $produk = $result->num_rows > 0 ? $result->fetch_assoc() : null;
        $stmt->close();
        return $produk;
    }

    // Update data produk
    public function updateProduk($data){
        $id_produk = $data['id_produk'];
        $kode_produk = $data['kode_produk'];
        $nama_produk = $data['nama_produk'];
        $harga = $data['harga'];
        $stok = $data['stok'];
        $id_kategory = $data['id_kategory'];

        $query = "UPDATE tb_produk 
                  SET kode_produk=?, nama_produk=?, harga=?, stok=?, id_kategory=? 
                  WHERE id_produk=?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){ return false; }

        $stmt->bind_param("ssiiii", $kode_produk, $nama_produk, $harga, $stok, $id_kategory, $id_produk);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Hapus produk
    public function deleteProduk($id){
        $query = "DELETE FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){ return false; }

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil kategori
    public function getKategory(){
        $query = "SELECT * FROM tb_kategory ORDER BY nama_kategory ASC";
        $result = $this->conn->query($query);

        $kategori = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $kategori[] = [
                    'id_kategory' => $row['id_kategory'],
                    'nama_kategory' => $row['nama_kategory']
                ];
            }
        }
        return $kategori;
    }
}
?>
