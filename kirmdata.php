<?php

// Sumber database MS Access
// $accessDatabase = 'C:\absen\Att\New folder\attBackup2.mdb'; // Sesuaikan dengan lokasi file MS Access Anda
$accessDsn = "absen";


// Tujuan database SQL Server

define('DB_NAME', 'db_absensi');

$dbname = DB_NAME;
$user = 'sa';
$pass = '';

$dsn = 'Driver={SQL Server};Driver={SQL Server};Server=(LOCAL);Database='. $dbname;
// Koneksi ke database MS Access
$accessConn = odbc_connect($accessDsn, '', '');

// Koneksi ke database SQL Server
$serverConn = odbc_connect($dsn,$user,$pass);


// Periksa koneksi MS Access
if (!$accessConn) {
    die("Koneksi ke MS Access gagal: " . odbc_errormsg());
}

// Periksa koneksi SQL Server
if (!$serverConn) {
    //die("Koneksi ke SQL Server gagal: " . sqlsrv_errors());
}

// Ambil data dari MS Access
$sql = "SELECT USERID,CHECKTIME,CHECKTYPE FROM CHECKINOUT"; // Gantilah YourAccessTable dengan nama tabel Anda
$result = odbc_exec($accessConn, $sql);

$data =[];
while(odbc_fetch_row($result)){
    $data[] = array(
        "USERID"=>rtrim(odbc_result($result,'USERID')),
        "CHECKTIME"=>rtrim(odbc_result($result,'CHECKTIME')),
        "CHECKTYPE"=>rtrim(odbc_result($result,'CHECKTYPE')),
    );
    }


    foreach($data as $item){
        $userid = $item["USERID"];
        $checktype = $item["CHECKTYPE"];
        $checktime = $item["CHECKTIME"];
        $query ="SP_INSERT_BASEN_checkinout '".$userid."','".$checktype."','".$checktime."'";
        $result = odbc_exec($serverConn, $query);

    }

// Periksa keberhasilan eksekusi query
if (!$result) {
    die("Query gagal dieksekusi: " . odbc_errormsg());
}

// Loop melalui hasil dan masukkan ke SQL Server


echo "Data berhasil diimpor dari MS Access ke SQL Server.";
?>
