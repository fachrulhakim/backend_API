<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../produk/produk.php';

$database = new Database();
$dbname = $database->koneksi();

$produk = new produk($dbname);

// get nim menggunkan file_get_contents
$data = json_decode(file_get_contents("php://input"));

$produk->id_produk = $data->id_produk;

// set property produk 
$produk->id_kategori = $data->id_kategori;
$produk->nama_produk = $data->nama_produk;
$produk->harga_produk = $data->harga_produk;
$produk->gambar_produk = $data->gambar_produk;
$produk->status_produk = $data->status_produk;

if ($produk->update()) {

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
