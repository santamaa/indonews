<?php

    include("cek_login.php");

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Admin Indonews - Beranda</title>
    <link rel="icon" type="image/x-icon" href="../assets/indonews-favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <!-- navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" style="height: 80px;">
        <a class="navbar-brand ps-3 fw-bold" href="index.php">ADMIN INDONEWS</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <div class="d-none d-md-inline-block ms-auto me-0 me-md-3 my-2 my-md-0">
            <a href="logout.php" class="me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
            </a>
        </div>
    </nav>

    <div id="layoutSidenav">

        <!-- sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav mt-3">
                        <a class="nav-link mt-3 active" href="index.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                            Beranda
                        </a>
                        <a class="nav-link mt-3" href="berita.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-newspaper"></i></div>
                            Berita
                        </a>
                        <a class="nav-link mt-3" href="foto.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-card-image"></i></div>
                            Foto
                        </a>
                        <a class="nav-link mt-3" href="video.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-play-btn"></i></div>
                            Video
                        </a>
                        <a class="nav-link mt-3" href="kategori.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-tags"></i></div>
                            Kategori
                        </a>
                        <a class="nav-link mt-3" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></div>
                            Admin
                        </a>
                    </div>
                </div>
            </nav>
        </div>

        <!-- content -->
        <div id="layoutSidenav_content">
            <div class="container-fluid px-5 mt-2">
                <h1 class="mt-5">Beranda</h1>
                <div class="row mt-5 pt-3">
                    
                    <?php

                        $brt = mysqli_query($kdb, 'select count(id_berita) as berita from tb_berita'); 
                        $row = mysqli_fetch_assoc($brt); 
                        $jumlahbrt = $row['berita'];

                        $fot = mysqli_query($kdb, 'select count(id_foto) as foto from tb_foto'); 
                        $row = mysqli_fetch_assoc($fot); 
                        $jumlahfot = $row['foto'];

                        $vid = mysqli_query($kdb, 'select count(id_video) as video from tb_video'); 
                        $row = mysqli_fetch_assoc($vid); 
                        $jumlahvid = $row['video'];

                        $ktg = mysqli_query($kdb, 'select count(id_kategori) as kategori from tb_kategori'); 
                        $row = mysqli_fetch_assoc($ktg); 
                        $jumlahktg = $row['kategori'];
                        
                    ?>

                    <div class="col-xl-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Berita</h5>
                                <h1 class="mt-4"><?=$jumlahbrt;?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Foto</h5>
                                <h1 class="mt-4"><?=$jumlahfot;?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Video</h5>
                                <h1 class="mt-4"><?=$jumlahvid;?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card text-center">
                            <div class="card-body">
                                <h4 class="card-title">Kategori</h5>
                                <h1 class="mt-4"><?=$jumlahktg;?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    
    
</body>

</html>