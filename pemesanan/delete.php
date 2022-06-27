<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../produk/produk.php';

$database = new Database();
$dbname = $database->koneksi();

$produk = new produk($dbname);

//mengambil input post nim
$data = json_decode(file_get_contents("php://input"));

$produk->id_produk = $data->id_produk ;

//memanggil query delete_mhs di class produk
if ($produk->delete()) {

    $respone = array(
        'messsage' => 'Delete Success',
        'code' => http_response_code(200)
    );
} else {

    // set respone 400 'Bad Request' jika delete gagal
    http_response_code(400);
    $respone = array(
        'messsage' => 'Delete Failed',
        'code' => http_response_code()
    );
}

echo json_encode($respone);
