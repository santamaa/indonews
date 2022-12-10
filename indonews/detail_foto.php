<?php

    include("function.php");

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Indonews</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/foto.css">
</head>

<body>
    
    <!-- header -->
    <nav class="header">
        <div class="container">
            <a href="index.php">
                <img src="assets/logo.png" style="width: 150px;" alt="">
            </a>
            <form>
                <input type="search" placeholder="Cari berita" aria-label="Search">
                <button type="submit">Cari</button>
            </form>
            <div class="tntngkm">
                <button>Tentang Kami</button>
            </div>
            <i class="bi bi-list fs-2"></i>
        </div>
    </nav>

    


    <div class="wrapper">
        <div class="container">

            <?php

                $id_foto = (isset($_GET['id_foto']) ? $_GET['id_foto'] : '');

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_foto where id_foto = '".$id_foto."'");
                while ($b = mysqli_fetch_array($sql)) {
                    extract($b);

                    $Updatelihat = mysqli_query($kdb, "update tb_foto set jumlah_lihat = jumlah_lihat + 1 where id_foto = '".$id_foto."' ");

                    echo '
                        <div class="content detail_foto">
                            <img src="foto/'.$foto.'"" alt="">
                            <h2>'.$judul.'</h2>
                            <p>'.tanggal_indo($tanggal).'</p>
                        </div>
                    ';
                }

            ?>

        </div>
        <div class="lain">

            <?php

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_foto");
                while ($b = mysqli_fetch_array($sql)) {
                    extract($b);

                    echo'
                        <div class="isi">
                            <img src="foto/'.$foto.'"" alt="">
                            <a href="./?open=detail_foto&id_foto='.$id_foto.'">'.$judul.'</a>
                        </div>
                    ';

                }

            ?>

        </div>


    </div>









        <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="comp">
                <img src="assets/logo.png" alt="">
                <p>Nikmati berita yang kami sajikan untuk anda semua, cermati dan bijaklah dalam menyampaikan kembali berita.</p>
            </div>
            <div class="ktg">
                <h5>Kategori</h5>
                <ul>

                <?php 

                    global $kdb;

                    $menu = mysqli_query($kdb, "select * from tb_kategori");

                    while ($r = mysqli_fetch_assoc($menu)) {
                        extract($r);
                            
                        echo'
                            <li><a style="text-decoration: none; color: #000;" name="id_kategori" href="./kategori.php?id_kategori='.$id_kategori.'">'.$kategori.'</a></li>
                        ';
                    }

                ?>

                </ul>
            </div>
            <div class="lyn">
                <h5>Layanan</h5>
                <ul>
                    <li><a>Pasang Mata</a></li>
                    <li><a>Adsmart</a></li>
                    <li><a>Forum</a></li>
                    <li><a>Trans Show World</a></li>
                    <li><a>Trans Studio</a></li>
                </ul>
            </div>
            <div class="inf">
                <h5>Informasi</h5>
                <ul>
                    <li><a>Redaksi</a></li>
                    <li><a>Pedoman Media Siber</a></li>
                    <li><a>Karir</a></li>
                    <li><a>Kotak Pos</a></li>
                    <li><a>Media Partner</a></li>
                    <li><a>Info Iklan</a></li>
                    <li><a>Privacy Policy</a></li>
                    <li><a>Disclaimer</a></li>
                </ul>
            </div>
            <div class="jar">
                <h5>Jaringan Media</h5>
                <ul>
                    <li><a>CNN Indonesia</a></li>
                    <li><a>CNBC Indonesia</a></li>
                    <li><a>Haibunda</a></li>
                    <li><a>Insertlive</a></li>
                    <li><a>Beautynesia</a></li>
                    <li><a>Female Daily</a></li>
                    <li><a>CXO Media</a></li>
                </ul>
            </div>
        </div>
        <p class="cr">Copyright @ 2022 Kelompok Indonews. | All right reserved</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>