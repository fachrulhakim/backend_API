<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../kategori/kategori.php';

$database = new Database();
$dbname = $database->koneksi();

$kategori = new kategori($dbname);

// get nim menggunkan file_get_contents
$data = json_decode(file_get_contents("php://input"));

$kategori->id_kategori = $data->id_kategori;

// set property kategori 
$kategori->nama_kategori = $data->nama_kategori;
$kategori->status_kategori = $data->status_kategori;
$kategori->harga_kategori = $data->harga_kategori;
$kategori->gambar_kategori = $data->gambar_kategori;
$kategori->status_kategori = $data->status_kategori;

if ($kategori->update()) {

    //format json yang dikirim ke client
    $respone = array(
        'messsage' => 'Update Success',
        'code' => http_response_code(200)

    );
} else {
    // set respone 400 'Bad Request' jika update gagal
    http_response_code(400);
    $respone = array(
        'messsage' => 'Update Failed',
        'code' => http_response_code()
    );
}
echo json_encode($respone);
