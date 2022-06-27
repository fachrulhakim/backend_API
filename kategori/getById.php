<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../kategori/kategori.php';

$database = new Database();
$dbname = $database->koneksi();

$kategori = new kategori($dbname);
$kategori->id_kategori = isset($_GET['id']) ? $_GET['id'] : die();

$kategori->getById();

if ($kategori->nama_kategori != null) {
    $byId = array(
        'id_kategori' => $kategori->id_kategori,
        'nama_kategori' => $kategori->nama_kategori,
        'status_kategori' => $kategori->harga_kategori,
        'gambar_kategori' => $kategori->gambar_kategori,
        'tanggal_buat' => $kategori->tanggal_buat,
        'tanggal_update' => $kategori->tanggal_update
    );

    $respone = array(
        'status' =>  array(
            'messsage' => 'Success', 'code' => (http_response_code(200))
        ), 'data' => $byId
    );
} else {
    http_response_code(404);
    $respone = array(
        'status' =>  array(
            'messsage' => 'No Data Found', 'code' => http_response_code()
        )
    );
}
echo json_encode($respone);
