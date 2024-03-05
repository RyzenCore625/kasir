<?php
include "connect.php";

session_start();

$kode = isset($_POST["id"]) ? htmlentities($_POST["id"]) :"";
$nama = isset($_POST["namapl"]) ? htmlentities($_POST["namapl"]) :"";
$total = isset($_POST['total']) ? floatval($_POST['total']) : 0.00; // Konversi ke float
$uang = isset($_POST['uang']) ? floatval($_POST['uang']) : 0.00; // Konversi ke float
$kembalian =  $uang - $total;

if (!empty($_POST['bayar_validate'])) {
    if ($kembalian < 0) {
        echo '<script>alert("Nominal Uang tidak mencukupi");
        location.href="../?x=pesanan&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
    } else {
        $query_bayar = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar, nominal_uang, total_bayar) VALUES ('$kode', '$uang', '$total')");

        if ($query_bayar) {
            echo '<script>alert("Pembayaran Berhasil");
            location.href="../?x=konfirmasi_pembayaran&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
        } else {
            echo '<script>alert("Maaf Pembayaran Anda Gagal");
            location.href="../?x=pesanan&idpenjualan='.$kode.'&namapl='.$nama.'";</script>';
        }
        
    }
}


