<?php

class Kategori{
    
    public $id_kategori;
    public $nama_kategori;
    public $status_kategori;
    public $gambar_kategori;
    public $tanggal_buat;    
    public $tanggal_update;

    private $con;
    private $tabel = "tbl_kategori";
      
    public function __construct($dbname){
        $this->con = $dbname;
    }

    function get()
    {
        $query = "SELECT * FROM " . $this->tabel . "";        
        $stmt = $this->con->prepare($query);        
        $stmt->execute();
        return $stmt;
    }

    function getById()
    {
        $query = "SELECT * FROM " . $this->tabel . " k          
                WHERE
                    k.id_kategori = ?
                LIMIT
                0,1";

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, $this->id_kategori);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // memasukkan nilai ke object      
        $this->nama_kategori = $row['nama_kategori'];
        $this->status_kategori = $row['status_kategori'];
        $this->gambar_kategori = $row['gambar_kategori'];
        $this->tanggal_buat = $row['tanggal_buat'];
        $this->tanggal_update = $row['tanggal_update'];
    }
    
    //fungsi input data mahasiswa
    function insert()
    {        
        $query = "INSERT INTO
                " . $this->tabel . "
            SET
            nama_kategori=:nama_kategori, status_kategori=:status_kategori, 
            gambar_kategori=:gambar_kategori, tanggal_buat=:tanggal_buat, 
            tanggal_update=:tanggal_update";

        $stmt = $this->con->prepare($query);     
        $stmt->bindParam('nama_kategori', $this->nama_kategori);
        $stmt->bindParam('status_kategori', $this->status_kategori);
        $stmt->bindParam('gambar_kategori', $this->gambar_kategori);
        $stmt->bindParam('tanggal_buat', $this->tanggal_buat);
        $stmt->bindParam('tanggal_update', $this->tanggal_update);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //fungsi updete data mahasiswa
    function update()
    {        
        $query = "UPDATE
                " . $this->tabel . "
            SET
            nama_kategori=:nama_kategori, status_kategori=:status_kategori, 
            gambar_kategori=:gambar_kategori, tanggal_buat=:tanggal_buat, 
            tanggal_update=:tanggal_update
            WHERE
            id_kategori = :id_kategori";
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam('nama_kategori', $this->nama_kategori);
        $stmt->bindParam('status_kategori', $this->status_kategori);
        $stmt->bindParam('gambar_kategori', $this->gambar_kategori);
        $stmt->bindParam('tanggal_buat', $this->tanggal_buat);
        $stmt->bindParam('tanggal_update', $this->tanggal_update);
        $stmt->bindParam('id_kategori', $this->id_kategori);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //fungsi delete mahasiswa
    function delete()
    {        
        $query = "DELETE FROM " . $this->tabel . " WHERE id_kategori = ?";        
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, $this->id_kategori);    
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>