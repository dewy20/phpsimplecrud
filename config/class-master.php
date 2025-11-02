<?php
// Memasukkan file koneksi database
include_once 'db-config.php';

// Class MasterData mewarisi koneksi dari class Database
class MasterData extends Database {

       // BAGIAN PRODUK
 
    // Ambil semua produk dari tabel tb_produk
    public function getproduk(){
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
    public function inputproduk($data){
        // HAPUS BARIS ID PRODUK INI KARENA SUDAH AUTO INCREMENT
       // $id_produk = $data['id_produk']; 
    
    $nama_produk = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $id_kategory = $data['id_kategory'];

        // HAPUS id_produk DARI DAFTAR KOLOM
    $query = "INSERT INTO tb_produk (nama_produk, harga_produk, stok_produk, id_kategory)
                VALUES (?, ?, ?, ?)"; // Total 4 parameter
    $stmt = $this->conn->prepare($query);

    if(!$stmt){
        return false;
    }
      // Sesuaikan bind_param: s (nama), s (harga - untuk decimal), i (stok), s (id_kategory)
    $stmt->bind_param("ssis", $nama_produk, $harga, $stok, $id_kategory); 
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
    $nama_produk = $data['nama_produk'];
    // KOREKSI: Gunakan key yang benar yang dikirim dari form POST
    $harga = $data['harga_produk']; // <--- UBAH DARI $data['harga']
    $stok = $data['stok_produk'];   // <--- UBAH DARI $data['stok']
    $id_kategory = $data['id_kategory'];

       // KOREKSI NAMA KOLOM SQL (harga dan stok harus ada _produk, kode_produk dihapus)
    $query = "UPDATE tb_produk 
              SET nama_produk=?, harga_produk=?, stok_produk=?, id_kategory=? 
              WHERE id_produk=?"; 
    $stmt = $this->conn->prepare($query);

    if(!$stmt){
        return false;
    }
        // KOREKSI BIND_PARAM: ss i s i (nama, harga, stok, kategori, id_produk)
        // Harga (s), Stok (i), Kategori (s), ID Produk (i)
    $stmt->bind_param("ssisi", $nama_produk, $harga, $stok, $id_kategory, $id_produk);
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
