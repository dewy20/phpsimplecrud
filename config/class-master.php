<?php
// Memasukkan file koneksi database
include_once 'db-config.php';

// Class MasterData mewarisi koneksi dari class Database
class MasterData extends Database {

<<<<<<< HEAD
    // Method untuk mendapatkan daftar menu
    public function getMenu(){
        $query = "SELECT * FROM tb_epic";
        $result = $this->conn->query($query);
        $menu = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $menu[] = [
                    'id' => $row['kode_menu'],
                    'nama' => $row['nama_menu'],
                    'kategori' => $row['kategori'],
                    'harga' => $row['harga'],
                    'porsi' => $row['porsi'],
                    'bahan' => $row['bahan_utama']
                ];
            }
        }
        return $menu;
=======
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
>>>>>>> b30687c9df5c56b155ab077eb9e320ad94a897fa
    }

    // Input produk baru ke tabel tb_produk
    public function inputproduk($data){
        // HAPUS BARIS ID PRODUK INI KARENA SUDAH AUTO INCREMENT
       // $id_produk = $data['id_produk']; 
    
    $nama_produk = $data['nama_produk'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $id_kategory = $data['id_kategory'];

<<<<<<< HEAD
    // Method untuk mendapatkan daftar status
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Tersedia'],
            ['id' => 2, 'nama' => 'Tidak tersedia'],
        ];
    }

    // Method untuk input data menu
    public function inputMenu($data){
        $kodemenu = $data['kode'];
        $namamenu = $data['nama'];
        $kategori = $data['kategori'];
        $harga = $data['harga'];
        $porsi = $data['porsi'];
        $bahanutama = $data['bahan'];

        $query = "INSERT INTO tb_epic (kode_menu, nama_menu, kategori, harga, porsi, bahan_utama) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // harga = double (d), porsi = integer (i)
        $stmt->bind_param("sssdis", $kodemenu, $namamenu, $kategori, $harga, $porsi, $bahanutama);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data menu berdasarkan kode
    public function getUpdateMenu($id){
        $query = "SELECT * FROM tb_epic WHERE kode_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $menu = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $menu = [
                'id' => $row['kode_menu'],
                'nama' => $row['nama_menu'],
                'kategori' => $row['kategori'],
                'harga' => $row['harga'],
                'porsi' => $row['porsi'],
                'bahan' => $row['bahan_utama']
            ];
        }
        $stmt->close();
        return $menu;
    }

    // Method untuk mengedit data menu
    public function updateMenu($data){
        $kodemenu = $data['kode'];
        $namamenu = $data['nama'];
        $kategori = $data['kategori'];
        $harga = $data['harga'];
        $porsi = $data['porsi'];
        $bahanutama = $data['bahan'];

        $query = "UPDATE tb_epic SET nama_menu = ?, kategori = ?, harga = ?, porsi = ?, bahan_utama = ? WHERE kode_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // tipe parameter sesuai urutan: nama_menu(s), kategori(s), harga(d), porsi(i), bahan_utama(s), kode_menu(s)
        $stmt->bind_param("ssdiss", $namamenu, $kategori, $harga, $porsi, $bahanutama, $kodemenu);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data menu
    public function deleteMenu($id){
        $query = "DELETE FROM tb_epic WHERE kode_menu = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

=======
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
