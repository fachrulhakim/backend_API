<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../produk/produk.php';

$database = new Database();
$dbname = $database->koneksi();

$produk = new produk($dbname);

// mengambil data post
$data = json_decode(file_get_contents("php://input"));

//validasi data yang akan diinput
if (
    !empty($data->id_kategori) &&
    !empty($data->nama_produk) &&
    !empty($data->harga_produk) &&
    !empty($data->gambar_produk) &&
    !empty($data->status_produk)

) {

    // set property produk 
    $produk->id_kategori = $data->id_kategori;
    $produk->nama_produk = $data->nama_produk;
    $produk->harga_produk = $data->harga_produk;
    $produk->gambar_produk = $data->gambar_produk;
    $produk->status_produk = $data->status_produk;

    // proses input data siswa
    if ($produk->insert()) {

        $respone = array(
            'messsage' => 'Input Success',
            'code' => http_response_code(200)

        );
    } else {

        // set respone 400 'Bad Request' jika input gagal
        http_response_code(400);
        $respone = array(
            'messsage' => 'Input Failed',
            'code' => http_response_code()
        );
    }
} else {

    // set respone 400 'Bad Request' jika parameter / nilai kosong
    http_response_code(400);
    $respone = array(
        'messsage' => 'Input Failed - Wrong Parameter',
        'code' => http_response_code()
    );
}

echo json_encode($respone);
