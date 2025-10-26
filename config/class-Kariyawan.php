<?php 

// Memasukkan file konfigurasi database
  include_once 'db-config.php';

  class Kariyawan extends Database {

    // Method untuk input data mahasiswa
    public function inputKariyawan($data){
        // Mengambil data dari parameter $data
        $nik      = $data['nik'];
        $nama     = $data['nama'];
        $jabatan  = $data['jabatan'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_Kariyawan (nik_kyw, nama_kyw, jabatan_kyw, alamat, provinsi, email, telp, status_kyw) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ssssssss", $nik, $nama, $jabatan, $alamat, $provinsi, $email, $telp, $status);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mengambil semua data kariyawan
    public function getAllKariyawan(){
        // Menyiapkan query SQL untuk mengambil data Kariyawan beserta prodi dan provinsi
        $query = "SELECT id_kyw, nik_kyw, nama_kyw, nama_jabatan, nama_provinsi, alamat, email, telp, status_kyw
              FROM tb_Kariyawan
              JOIN tb_jabatan ON jabatan_kyw = id_jabatan
              JOIN tb_provinsi ON provinsi = id_provinsi";
    $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data Kariyawan 
        $Kariyawan = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){ 
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            $Kariyawan[] = [ 
                'id' => $row['id_kyw'],
                'nik' => $row['nik_kyw'],
                'nama' => $row['nama_kyw'],
                'jabatan' => $row['nama_jabatan'],
                'provinsi' => $row['nama_provinsi'],
                'alamat' => $row['alamat'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_kyw']
            ];
        }
    }
    return $Kariyawan;
  {
       
 }

    // Method untuk mengambil data mahasiswa berdasarkan ID
    public function getUpdateKariyawan($id){
        // Menyiapkan query SQL untuk mengambil data kariyawan berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_Kariyawan WHERE id_kyw = ?";
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
                'id' => $row['id_kyw'],
                'nik' => $row['nik_kyw'],
                'nama' => $row['nama_kyw'],
                'jabatan' => $row['jabatan_kyw'],
                'alamat' => $row['alamat'],
                'provinsi' => $row['provinsi'],
                'email' => $row['email'],
                'telp' => $row['telp'],
                'status' => $row['status_kyw']
            ];
        }
        $stmt->close();
        return $data;
    }

    // Method untuk mengedit data kariyawan
    public function editKariyawan($data){
        // Mengambil data dari parameter $data
         $nik      = $data['nik'];
        $nama     = $data['nama'];
        $jabatan  = $data['jabatan'];
        $alamat   = $data['alamat'];
        $provinsi = $data['provinsi'];
        $email    = $data['email'];
        $telp     = $data['telp'];
        $status   = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_Kariyawan SET nik_kyw = ?, nama_kyw = ?, jabatan_kyw = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_kyw = ? WHERE id_kyw = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $query = "UPDATE tb_Kariyawan SET nik_kyw = ?, nama_kyw = ?, jabatan_kyw = ?, alamat = ?, provinsi = ?, email = ?, telp = ?, status_kyw = ? WHERE id_kyw = ?";
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data mahasiswa
    public function deleteKariyawan($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_Kariyawan WHERE id_kyw = ?";
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
    public function searchKariyawan($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data mahasiswa menggunakan prepared statement
        $query = "SELECT id_kyw, nik_kyw, nama_kyw, nama_jabatan, nama_provinsi, alamat, email, telp, status_kyw 
                  FROM tb_kariyawan
                  JOIN tb_jabatan ON jabatan_kyw = id_jabatan
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE nik_kyw LIKE ? OR nama_kyw LIKE ?";
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
                    'id' => $row['id_kyw'],
                    'nik' => $row['nik_kyw'],
                    'nama' => $row['nama_kyw'],
                    'jabatan' => $row['nama_jabatan'],
                    'provinsi' => $row['nama_provinsi'],
                    'alamat' => $row['alamat'],
                    'email' => $row['email'],
                    'telp' => $row['telp'],
                    'status' => $row['status_kyw']
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data kariyawan yang ditemukan
        return $Kariyawan;
    }

}

?>