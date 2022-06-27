<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../produk/produk.php';

$database = new Database();
$dbname = $database->koneksi();

$produk = new produk($dbname);

//memanggil query get_produk di class produk
$stmt = $produk->get();
$num = $stmt->rowCount();

$respone = [];
if ($num > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {        
        extract($row);

        $produk_item[] = array(
            "id_produk" => $id_produk,
            "id_kategori" => $id_kategori,
            "nama_produk" => $nama_produk,
            "harga_produk" => $harga_produk,
            "gambar_produk" => $gambar_produk,
            "status_produk" => $status_produk
        );
    }

    //format json yang akan dikirim ke client
    $respone = array(
        'status' =>  array(
            'messsage' => 'Success', 'code' => http_response_code(200)
        ), 'data' => $produk_item
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