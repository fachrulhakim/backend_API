<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../kategori/kategori.php';

$database = new Database();
$dbname = $database->koneksi();

$kategori = new kategori($dbname);

//memanggil query get_kategori di class kategori
$stmt = $kategori->get();
$num = $stmt->rowCount();

$respone = [];
if ($num > 0) {

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {        
        extract($row);

        $kategori_item[] = array(
            "id_kategori" => $id_kategori,
            "nama_kategori" => $nama_kategori,
            "status_kategori" => $status_kategori,
            "gambar_kategori" => $gambar_kategori,
            "tanggal_buat" => $tanggal_buat,
            "status_kategori" => $tanggal_update
        );
    }

    //format json yang akan dikirim ke client
    $respone = array(
        'status' =>  array(
            'messsage' => 'Success', 'code' => http_response_code(200)
        ), 'data' => $kategori_item
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