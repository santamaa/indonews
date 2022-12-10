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
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    
    <!-- header -->
    <nav class="header">
        <div class="container">
            <a href="index.php">
                <img src="assets/logo.png" style="width: 150px;" alt="">
            </a>
            <form action="cari.php" method="post">
                <input type="search" name="" placeholder="Cari berita" aria-label="Search">
                <button type="submit" name="">Cari</button>
            </form>
            <div class="tntngkm">
                <button>Tentang Kami</button>
            </div>
            <i class="bi bi-list fs-2"></i>
        </div>
    </nav>


    <!-- berita highligth -->
    <div class="highlight">

        <?php

            global $kdb;

            $sql = mysqli_query($kdb, "select * from tb_berita b, tb_kategori k where b.id_kategori = k.id_kategori order by rand() desc limit 1");

            while ($b = mysqli_fetch_array($sql)) {
                $id_berita = $b['id_berita'];
                $judul = $b['judul'];
                $kategori = $b['kategori'];
                $id_kategori = $b['id_kategori'];
                $isi = $b['isi'];
                $gambar = $b['gambar'];
                $tanggal = $b['tanggal'];
                date_default_timezone_set('Asia/Jakarta'); 
                $jam = $b['jam'];
                $waktustart = $jam;
                $waktuend = date("h:i:s");
                $datetime1 = new DateTime($waktustart);
                $datetime2 = new DateTime($waktuend);
                $durasi = $datetime1->diff($datetime2);

        ?>

        <img src="gambar/<?php echo $gambar; ?>" alt="">
        <div class="dark"></div>
        <div class="text-wrapper">
            <p class="p1"><?php echo tanggal_indo($tanggal); ?></p>
            <h2><a href="./?open=detail_berita&id_berita=<?= $id_berita; ?>" style="text-decoration: none; color: #fff;"><?php echo $judul; ?></a></h2>
            <p class="p2"><?php echo substr(strip_tags($isi), 0, 120);?> . . . .</p>
            <p class="p3"><?php echo $durasi->format('%H jam %i menit %s detik'); ?> yang lalu</p>
        </div>

        <?php
            }

        ?>
    </div>


    <!-- menu kategori -->
    <nav class="navbar navbar-expand-lg navbar-dark kategori">
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


    <!-- berita populer -->
    <div class="brtpop">
        <div class="main">

        <?php

            global $kdb;

            $sql = mysqli_query($kdb, "select * from tb_berita order by jumlah_lihat desc limit 1");

            while ($b = mysqli_fetch_array($sql)) {
                $id_berita = $b['id_berita'];
                $judul = $b['judul'];
                $isi = $b['isi'];
                $gambar = $b['gambar'];
                $tanggal = $b['tanggal'];
                $waktustart = $tanggal;
                $waktuend = date("Y-m-d");
                $datetime1 = new DateTime($waktustart);
                $datetime2 = new DateTime($waktuend);
                $durasi = $datetime1->diff($datetime2);

        ?>

            <img src="gambar/<?php echo $gambar; ?>" alt="">
            <div class="dark"></div>
            <div class="text">
                <p class="p1"><?php echo tanggal_indo($tanggal); ?></p>
                <h2><a href="./?open=detail_berita&id_berita=<?= $id_berita; ?>" style="text-decoration: none; color: #fff;"><?php echo $judul; ?></a></h2>
                <p class="p2"><?php echo $durasi->format('hari'); ?> yang lalu</p>
            </div>

        <?php
            }
        ?>

        </div>
        <div class="side">

        <?php

            global $kdb;

            $sql = mysqli_query($kdb, "select * from tb_berita order by rand() desc limit 2");

            while ($b = mysqli_fetch_array($sql)) {
                extract($b);

                echo '
                    <div class="content">
                        <div class="text">
                            <h5><a href="./?open=detail_berita&id_berita='.$id_berita.'" style="text-decoration: none; color: #000;">'.$judul.'</a></h5>
                            <p>'.(substr(strip_tags($isi), 0, 120)).' . . . .</p>
                        </div>
                        <img src="gambar/'.$gambar.'" alt="">
                    </div>
                ';

            }
        ?>

        </div>
    </div>

    <!-- berita terkini -->
    <div class="brttrkn">
        <h3>Berita Terkini</h3>
        <div class="container">

        <?php

            global $kdb;

            $sql = mysqli_query($kdb, "select * from tb_berita order by id_berita desc limit 4");

            while ($b = mysqli_fetch_array($sql)) {
                $id_berita = $b['id_berita'];
                $judul = $b['judul'];
                $isi = $b['isi'];
                $gambar = $b['gambar'];

                echo '
                    <div class="content" style="width: 100%;">
                        <img src="gambar/'.$gambar.'" style="height: 140px;" alt="...">
                        <div class="text">
                            <h5><a href="./?open=detail_berita&id_berita='.$id_berita.'" style="text-decoration: none; color: #000;">'.$judul.'</a></h5>
                            <p>'.(substr(strip_tags($isi), 0, 100)).' . . . .</p>
                        </div>
                    </div>

                ';

            }

        ?>

        </div>
        <a class="brtln" href="./?open=daftar_berita" style="text-decoration: none;"><button>Berita Lainnya</button></a>
    </div>

    <!-- video populer -->
    <div class="video">
        <div class="dark"></div>
        <div class="container">
            <h2>Video Terpopuler</h2>
            <div class="pop">

            <?php

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_video order by jumlah_lihat desc limit 1");

                while ($b = mysqli_fetch_array($sql)) {
                    $id_video = $b['id_video'];
                    $judul = $b['judul'];
                    $video = $b['video'];
                    $tanggal = $b['tanggal'];

            ?>
                <video class="vid" controls autoplay>
                    <source src="video/<?php echo $video; ?>" type="video/mp4">
                </video>
                <div class="text">
                    <h4><a href="./?open=detail_video&id_video=<?=$id_video;?>" style="text-decoration: none; color: #fff;"><?php echo $judul; ?></a></h4>
                    <p><?php echo tanggal_indo($tanggal); ?></p>
                    <div class="btn-lain">
                        <a href="./?open=detail_video"><button>Video Lainnya</button></a>
                    </div>
                </div>

            <?php
                }
            ?>

            </div>
            <div class="vidlain">

            <?php

                global $kdb;

                $sql = mysqli_query($kdb, "select * from tb_video order by jumlah_lihat desc limit 1,5");

                while ($b = mysqli_fetch_array($sql)) {
                    $id_video = $b['id_video'];
                    $judul = $b['judul'];
                    $video = $b['video'];
                    $tanggal = $b['tanggal'];

                    echo '
                        <div class="content" style="width: 100%;">
                            <video class="vidl">
                                <source src="video/'.$video.'" type="video/mp4">
                            </video>
                            <div class="text">
                                <h6><a href="./?open=detail_video&id_video='.$id_video.'" style="text-decoration: none; color: #fff">'.$judul.'</a></h6>
                                <p>'.tanggal_indo($tanggal).'</p>
                            </div>
                        </div>
                    ';

                }

            ?>

            </div>
        </div>
    </div>

    <!-- foto -->
    <div class="foto">
        <h3>Foto Terpopuler</h3>
        <div class="container">

        <?php

            global $kdb;

            $sql = mysqli_query($kdb, "select * from tb_foto order by jumlah_lihat desc limit 6");

            while ($b = mysqli_fetch_array($sql)) {
                $id_foto = $b['id_foto'];
                $judul = $b['judul'];
                $foto = $b['foto'];
                $tanggal = $b['tanggal'];

                echo '
                    <div class="content">
                        <img src="foto/'.$foto.'" alt="" />
                        <h4><a href="./?open=detail_foto&id_foto='.$id_foto.'" style="text-decoration: none; color: #000;">'.$judul.'</a></h4>
                    </div>
                ';

            }

        ?>

        </div>
        <div class="btn">
            <a href="./?open=detail_foto" style="text-decoration: none;"><button>Lihat selengkapnya</button></a>
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
        <p class="cr">Copyright @ 2022 <a  href="admin/index.php" style="text-decoration: none; color: #000;">Kelompok Indonews.</a> | All right reserved</p>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>