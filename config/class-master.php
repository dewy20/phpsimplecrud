<?php
// Memasukkan file koneksi database
include_once 'db-config.php';

// Class MasterData mewarisi koneksi dari class Database
class MasterData extends Database {

       // BAGIAN PRODUK
 
    // Ambil semua produk dari tabel tb_produk
    public function getProduk(){
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

    // Input produk baru ke tabel tb_produk
    public function inputProduk($data){
        $id_produk = $data['id_produk'];
        $nama_produk = $data['nama_produk'];
        $harga = $data['harga'];
        $stok = $data['stok'];
        $id_kategory = $data['id_kategory'];

        // Gunakan prepared statement agar aman
        $query = "INSERT INTO tb_produk (id_produk, nama_produk, harga_produk, stok_produk, id_kategory)
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssiii", $id_produk, $nama_produk, $harga_produk, $stok_produk, $id_kategory);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil satu produk berdasarkan id
    public function getUpdateProduk($id){
        $query = "SELECT * FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);

        if(!$stmt){
            return false;
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $produk = null;

        if($result->num_rows > 0){
            $produk = $result->fetch_assoc();
        }

        $stmt->close();
        return $produk;
    }

    // Update data produk berdasarkan id
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

        if(!$stmt){
            return false;
        }

        $stmt->bind_param("ssiiii", $kode_produk, $nama_produk, $harga_produk, $stok_produk, $id_kategory, $id_produk);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Hapus produk berdasarkan id
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
      // BAGIAN KATEGORI
    // Ambil semua kategori dari tabel tb_kategory
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
