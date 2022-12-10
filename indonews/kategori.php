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
    <link rel="stylesheet" href="assets/kategori.css">
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

            <nav class="navbar navbar-expand-lg navbar-dark kategori-list" style="background-color: #1a63ad; border-radius: 10px; margin-bottom: 20px;">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">

                            <?php 

                                global $kdb;

                                $menu = mysqli_query($kdb, "select * from tb_kategori");

                                while ($r = mysqli_fetch_assoc($menu)) {
                                    extract($r);
                                        
                                    echo'
                                        <a class="nav-link active" name="id_kategori" href="./?open=kategori&id_kategori='.$id_kategori.'">'.$kategori.'</a>
                                    ';
                                }

                            ?>

                        </div>
                    </div>
                </div>
            </nav>


            <div class="content">
                <div class="c-brt">

                    <?php

                        $id_kategori = (isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '');

                        global $kdb;

                        $sql = mysqli_query($kdb, "select * from tb_berita where id_kategori = '".$id_kategori."'");

                        while($b = mysqli_fetch_array($sql)) {

                            extract($b);

                            echo '
                                <div class="brt kategori">
                                    <a href="./?open=detail_berita&id_berita='.$id_berita.'">'.$judul.'</a>
                                    <p class="isi">'.(substr(strip_tags($isi), 0, 100)).' . . . .</p>
                                    <p class="tnggl_b">'.tanggal_indo($tanggal).'</p>
                                </div>
                            ';
                        }

                    ?>

                </div>


                <div class="c-fot">

                    <?php

                        $id_kategori = (isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '');

                        global $kdb;

                        $sql = mysqli_query($kdb, "select * from tb_foto where id_kategori = '".$id_kategori."'");

                        while($b = mysqli_fetch_array($sql)) {

                            extract($b);

                            echo '
                                <div class="fot kategori">
                                    <img src="foto/'.$foto.'" alt="">
                                    <a href="./?open=detail_berita&id_foto='.$id_foto.'">'.$judul.'</a>
                                    <p>'.tanggal_indo($tanggal).'</p>
                                </div>
                            ';
                        }

                    ?>

                </div>


                <div class="c-vid">

                    <?php

                        $id_kategori = (isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '');

                        global $kdb;

                        $sql = mysqli_query($kdb, "select * from tb_video where id_kategori = '".$id_kategori."' limit 5");

                        while($b = mysqli_fetch_array($sql)) {

                            extract($b);

                            echo '
                                <div class="vid kategori">
                                    <video src="video/'.$video.'" controls></video>
                                    <a href="./?open=detail_video&id_video='.$id_video.'">'.$judul.'</a>
                                    <p>'.tanggal_indo($tanggal).'</p>
                                </div>
                            ';
                        }

                    ?>

                </div>

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