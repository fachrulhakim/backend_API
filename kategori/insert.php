<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../dbconfig/database.php';
include_once '../kategori/kategori.php';

$database = new Database();
$dbname = $database->koneksi();

$kategori = new kategori($dbname);

// mengambil data post
$data = json_decode(file_get_contents("php://input"));

//validasi data yang akan diinput
if (
    !empty($data->nama_kategori) &&
    !empty($data->status_kategori) &&
    !empty($data->gambar_kategori) &&
    !empty($data->tanggal_buat) &&
    !empty($data->tanggal_update) 
) {

    // set property kategori 
    $kategori->nama_kategori = $data->nama_kategori;
    $kategori->status_kategori = $data->status_kategori;
    $kategori->gambar_kategori = $data->gambar_kategori;
    $kategori->tanggal_buat = $data->tanggal_buat;
    $kategori->status_tanggal_update = $data->tanggal_update;

    // proses input data siswa
    if ($kategori->insert()) {

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
