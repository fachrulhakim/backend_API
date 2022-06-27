<?php

class Produk{
    
    public $id_produk;
    public $id_kategori;
    public $nama_produk;
    public $harga_produk;
    public $gambar_produk;    
    public $status_produk;

    private $con;
    private $tabel = "tbl_produk";
      
    public function __construct($dbname){
        $this->con = $dbname;
    }

    //Get Semua data Mahasiswa
    function get()
    {
        $query = "SELECT * FROM " . $this->tabel . "";        
        $stmt = $this->con->prepare($query);        
        $stmt->execute();
        return $stmt;
    }

    //fungsi get mahasiswa by nim
    function getById()
    {
        $query = "SELECT * FROM " . $this->tabel . " p          
                WHERE
                    p.id_produk  = ?
                LIMIT
                0,1";

        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, $this->id_produk);
        
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // memasukkan nilai ke object      
        $this->id_kategori = $row['id_kategori'];
        $this->nama_produk = $row['nama_produk'];
        $this->harga_produk = $row['harga_produk'];
        $this->gambar_produk = $row['gambar_produk'];
        $this->status_produk = $row['status_produk'];
    }
    
    //fungsi input data mahasiswa
    function insert()
    {        
        $query = "INSERT INTO
                " . $this->tabel . "
            SET
            id_kategori=:id_kategori, nama_produk=:nama_produk, 
            harga_produk=:harga_produk, gambar_produk=:gambar_produk, 
            status_produk=:status_produk";

        $stmt = $this->con->prepare($query);     
        $stmt->bindParam('id_kategori', $this->id_kategori);
        $stmt->bindParam('nama_produk', $this->nama_produk);
        $stmt->bindParam('harga_produk', $this->harga_produk);
        $stmt->bindParam('gambar_produk', $this->gambar_produk);
        $stmt->bindParam('status_produk', $this->status_produk);
        
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
            id_kategori=:id_kategori, nama_produk=:nama_produk, 
            harga_produk=:harga_produk, gambar_produk=:gambar_produk, 
            status_produk=:status_produk
            WHERE
                id_produk = :id_produk";
        
        $stmt = $this->con->prepare($query);

        $stmt->bindParam('id_kategori', $this->id_kategori);
        $stmt->bindParam('nama_produk', $this->nama_produk);
        $stmt->bindParam('harga_produk', $this->harga_produk);
        $stmt->bindParam('gambar_produk', $this->gambar_produk);
        $stmt->bindParam('status_produk', $this->status_produk);
        $stmt->bindParam('id_produk', $this->id_produk);
        
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //fungsi delete mahasiswa
    function delete()
    {        
        $query = "DELETE FROM " . $this->tabel . " WHERE id_produk = ?";        
        $stmt = $this->con->prepare($query);
        $stmt->bindParam(1, $this->nim);    
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>