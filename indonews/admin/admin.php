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

    <title>Admin Indonews - Admin</title>
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
                        <a class="nav-link mt-3" href="index.php">
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
                        <a class="nav-link mt-3 active" href="admin.php">
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
                <h1 class="mt-5 mb-4">Data Admin</h1>
                <div class="card mt-5 mb-4">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th class="align-middle ps-4">Nama</th>
                                    <th class="align-middle ps-4">Username</th>
                                    <th class="align-middle ps-4">Password</th>
                                    <th class="align-middle text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                    $get = mysqli_query($kdb, "select * from tb_admin");
                                    while($adm = mysqli_fetch_array($get)) {
                                        $id_admin = $adm['id_admin'];
                                        $nama = $adm['nama'];
                                        $username = $adm['username'];
                                        $password = $adm['password'];
                                        
                                ?>

                                    <tr>
                                        <td class="align-middle ps-4"><?=$nama;?></td>
                                        <td class="align-middle ps-4"><?=$username;?></td>
                                        <td class="align-middle ps-4"><?=$password;?></td>
                                        <td class="d-flex justify-content-center" style="column-gap: 25px;">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?=$id_admin?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>

                                    <div class="modal" id="edit<?=$id_admin?>">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                            <div class="modal-content p-4">
                                                <div class="modal-header d-flex justify-content-center align-items-center pb-4">
                                                    <h4 class="modal-title">Ubah Data Admin</h4>
                                                </div>
                                                <form method="post" autocomplete="off">
                                                    <div class="modal-body mt-3 mb-1 pe-5 ps-5">
                                                        <input type="hidden" name="id_admin" value="<?=$id_admin;?>">
                                                        <div class="row mb-3">
                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="nama" value="<?=$nama;?>" require>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label class="col-sm-3 col-form-label">Username</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="username" value="<?=$username;?>" require>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control" name="password" value="<?=$password;?>" require>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-center align-items-center pt-4">
                                                        <button type="submit" class="btn btn-success" style="width: 100px;" name="edit_adm">Simpan</button>
                                                        <button type="button" class="btn btn-danger" style="width: 100px;" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                    };

                                ?>

                            </tbody>
                        </table>
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