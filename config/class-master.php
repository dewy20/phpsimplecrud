<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

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
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nama_provinsi']
                ];
            }
        }
        return $provinsi;
    }

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

?>
