<?php


//koneksi database
$kdb = mysqli_connect("localhost", "root", "") or die(mysqli_error($kdb));
mysqli_select_db($kdb, "db_indonews") or die(mysqli_error($kdb));


function tanggal_indo($tanggal) {
    $bulan = array (2 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}


?>