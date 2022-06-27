<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../produk/produk.php';

$database = new Database();
$dbname = $database->koneksi();

$produk = new produk($dbname);
$produk->id_produk = isset($_GET['id']) ? $_GET['id'] : die();

$produk->getById();

if ($produk->nama_produk != null) {
    $byId = array(
        'id_produk' => $produk->id_produk,
        'id_kategori' => $produk->id_kategori,
        'nama_produk' => $produk->nama_produk,
        'harga_produk' => $produk->harga_produk,
        'gambar_produk' => $produk->gambar_produk,
        'status_produk' => $produk->status_produk
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
