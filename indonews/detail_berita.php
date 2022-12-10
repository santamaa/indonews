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
    <link rel="stylesheet" href="assets/berita.css">
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

                $id_berita = (isset($_GET['id_berita']) ? $_GET['id_berita'] : '');

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_berita where id_berita = '".$id_berita."' ");
                while ($b = mysqli_fetch_array($sql)) {
                extract($b);

                $Updatelihat = mysqli_query($kdb, "update tb_berita set jumlah_lihat = jumlah_lihat + 1 where id_berita = '".$id_berita."' ");

                    echo '
                        <div class="content detail_berita">
                            <h5>'.$judul.'</h5>
                            <div class="img">
                                <img src="gambar/'.$gambar.'" alt="...">
                            </div>
                            <p>'.$isi.'</p>
                        </div>

                    ';

                }

            ?>

            <div class="trkn">
                <h3>Berita Terkini</h3>
                <div class="trkn-container">

                <?php

                    global $kdb;

                    $sql = mysqli_query($kdb, "select * from tb_berita order by id_berita limit 4");

                    while ($b = mysqli_fetch_array($sql)) {
                        $id_berita = $b['id_berita'];
                        $judul = $b['judul'];
                        $isi = $b['isi'];
                        $gambar = $b['gambar'];

                        echo '
                            <div class="content">
                                <img src="gambar/'.$gambar.'" alt="...">
                                <div class="text">
                                    <h5><a href="./?open=detail_berita&id_berita='.$id_berita.'" style="text-decoration: none; color: #fff;">'.$judul.'</a></h5>
                                    <p>'.(substr(strip_tags($isi), 0, 120)).' . . . .</p>
                                </div>
                            </div>

                        ';

                    }

                ?>

                </div>
            </div>

        </div>

        <hr>

        <div class="lain">
            <h3>Berita Lainnya</h3>
            <div class="lain-container">

            <?php

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_berita order by id_berita limit 8");

                while ($b = mysqli_fetch_array($sql)) {
                    $id_berita = $b['id_berita'];
                    $judul = $b['judul'];
                    $isi = $b['isi'];
                    $gambar = $b['gambar'];

                    echo '
                        <div class="content">
                            <img src="gambar/'.$gambar.'" alt="...">
                            <div class="text">
                                <h5><a href="./?open=detail_berita&id_berita='.$id_berita.'" style="text-decoration: none; color: #000;">'.$judul.'</a></h5>
                                <p>'.(substr(strip_tags($isi), 0, 120)).' . . . .</p>
                            </div>
                        </div>

                    ';

                }

            ?>

            </div>
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