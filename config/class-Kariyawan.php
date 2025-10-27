<?php 

// Memasukkan file konfigurasi database
  include_once 'db-config.php';

  class produk extends Database {

    // Method untuk input data mahasiswa
    public function inputproduk($data){
        // Mengambil data dari parameter $data
        $nik      = $data['id_produk'];
        $nama     = $data['nama'];
        $jabatan  = $data['harga'];
        $alamat   = $data['stok'];
        
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_produk (id_produk, nama_produk, harga_produk, stok_produk,  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $id, $nama, $harga, $stok);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }
       
}
    // Method untuk mengambil semua data produk
    public function getAllproduk(){
        // Menyiapkan query SQL untuk mengambil data produk beserta prodi dan provinsi
        $query = "SELECT id_produk, nama_produk, harga_produk, stok_produk
              FROM tb_produk
              JOIN tb_produk ON nama_produk = id_produk"{
              
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data Kariyawan 
        $Kariyawan = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){ 
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            $Kariyawan[] = [ 
                'id' => $row['id_produk'],
                'nama' => $row['nama_produk'],
                'harga' => $row['harga_produk'],
                'stok' => $row['stok_produk'],
            ];
        }
        return $produk;
    }
        
    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateproduk($id){
        // Menyiapkan query SQL untuk mengambil data kariyawan berdasarkan ID menggunakan prepared statement
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
            // Mengambil data Kariyawan 
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
                'id' => $row['id_produk'],
                'nik' => $row['nama_produk'],
                'nama' => $row['harga_produk'],
                'jabatan' => $row['stok_produk'],
                
            ];
        }
        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data kariyawan
    public function editproduk($data){
        // Mengambil data dari parameter $data
         $nik      = $data['id_produk'];
        $nama     = $data['nama'];
        $harga  = $data['harga'];
        $stok   = $data['stok'];
        
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_produk SET id_produk = ?, nama_produk = ?, harga_produk = ?, stok  = ? WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $query = "UPDATE tb_produk SET id_produk = ?, nama_produk = ?, harga_produk = ?, stok  = ? WHERE id_produk = ?";
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
    public function deleteproduk($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_produk WHERE id_produk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data mahasiswa berdasarkan kata kunci
    public function searchproduk($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_produk, nama_produk, harga_produk, stok_produk
                  JOIN tb_kategory ON nama_produk = id_produk
                  WHERE id_produk LIKE ? OR nama_produk LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data mahasiswa
        $Kariyawan = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data Kariyawan dalam array
                $Kariyawan[] = [
                    'id' => $row['id_produk'],
                    'nama' => $row['nama_produk'],
                    'harga' => $row['harga_produk'],
                    'stok' => $row['stok_produk'],
                    
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data kariyawan yang ditemukan
        return $Kariyawan;
    }

}

?>