<?php

    session_start();


    //koneksi database
    $kdb = mysqli_connect("localhost", "root", "") or die(mysqli_error($kdb));
    mysqli_select_db($kdb, "db_indonews") or die(mysqli_error($kdb));


    //login
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $get = mysqli_query($kdb, "select * from tb_admin where username='$username' and password='$password'");

        $row = mysqli_num_rows($get);

        if($row > 0) {
            $_SESSION['login'] = 'True';
            header('location:index.php');
        } else {
            echo '
                <script>
                    alert("Login Gagal");
                    window.location.href="login.php";
                </script>
            ';
        }
    }


    //edit admin
    if(isset($_POST['edit_adm'])) {
        $id_admin = $_POST['id_admin'];
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $update = mysqli_query($kdb, "update tb_admin set nama = '$nama', username = '$username', password = '$password' where id_admin = '$id_admin'");

        if($update) {
            header('location:admin.php');
        } else {
            echo '
                <script>
                    alert("Ubah Data Gagal");
                    window.location.href="admin.php";
                </script>
            ';
        }
    }


    //tambah kategori
    if(isset($_POST['tambah_ktg'])) {
        $kategori = $_POST['kategori'];

        $insert = mysqli_query($kdb, "insert into tb_kategori (kategori) values ('$kategori')");

        if($insert) {
            header('location:kategori.php');
        } else {
            echo '
                <script>
                    alert("Penambahan Data Gagal");
                    window.location.href="kategori.php";
                </script>
            ';
        }
    }


    //edit kategori
    if(isset($_POST['edit_ktg'])) {
        $kategori = $_POST['kategori'];
        $id_kategori = $_POST['id_kategori'];

        $update = mysqli_query($kdb, "update tb_kategori set kategori = '$kategori' where id_kategori = '$id_kategori'");

        if($update) {
            header('location:kategori.php');
        } else {
            echo '
            <script>
                alert("Ubah Data Gagal");
                window.location.href="kategori.php";
            </script>
            ';
        }
    }


    //hapus kategori
    if(isset($_POST['hapus_ktg'])) {
        $kategori = $_POST['kategori'];
        $id_kategori = $_POST['id_kategori'];

        $delete = mysqli_query($kdb, "delete from tb_kategori where id_kategori = '$id_kategori'");

        if($delete) {
            header('location:kategori.php');
        } else {
            echo '
            <script>
                alert("Hapus Data Gagal");
                window.location.href="kategori.php";
            </script>
            ';
        }
    }


    //tambah berita
    if (isset($_POST['tambah_brt']) && isset($_FILES['gambar'])) {
        $judul = $_POST['judul'];
        $id_kategori = $_POST['id_kategori'];
        $isi = $_POST['isi'];
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("Y-m-d");
        $jam= date('H:i:s');

        if($_FILES["gambar"]["error"] == 4) {
            echo
                "<script> alert('Gambar tidak tersedia'); </script>"
            ;
        } else {
            $fileName = $_FILES["gambar"]["name"];
            $fileSize = $_FILES["gambar"]["size"];
            $tmpName = $_FILES["gambar"]["tmp_name"];
        
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if ( !in_array($imageExtension, $validImageExtension) ) {
                echo
                "
                <script>
                    alert('Format gambar salah');
                    document.location.href = 'berita.php';
                </script>
                ";
            } else if($fileSize > 5000000) {
                echo
                "
                <script>
                    alert('Ukuran gambar terlalu besar');
                    document.location.href = 'berita.php';
                </script>
                ";
            } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;
            
                move_uploaded_file($tmpName, '../gambar/' . $newImageName);

                $query = "insert into tb_berita values ('', '$judul', '$id_kategori', '$isi', '$newImageName', '$tanggal', '$jam', '')";

                mysqli_query($kdb, $query);
                echo "
                    <script>
                        document.location.href = 'berita.php';
                    </script>
                ";
            }
        }
    }


    //edit berita
    if(isset($_POST['edit_brt'])) {
        $id_berita = $_POST['id_berita'];
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];

        $update = mysqli_query($kdb, "update tb_berita set id_berita = '$id_berita', judul = '$judul', isi = '$isi' where id_berita = '$id_berita'");

        if($update) {
            header('location:berita.php');
        } else {
            echo '
            <script>
                alert("Ubah Data Gagal");
                window.location.href="berita.php";
            </script>
            ';
        }
    }


    //hapus berita
    if(isset($_POST['hapus_brt'])) {
        $id_berita = $_POST['id_berita'];

        $delete = mysqli_query($kdb, "delete from tb_berita where id_berita = '$id_berita'");

        if($delete) {
            header('location:berita.php');
        } else {
            echo '
            <script>
                alert("Hapus Data Gagal");
                window.location.href="berita.php";
            </script>
            ';
        }
    }


    //tambah video
    if (isset($_POST['tambah_vid']) && isset($_FILES['video'])) {
        $judul = $_POST['judul'];
        $id_kategori = $_POST['id_kategori'];
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("Y-m-d");

        if($_FILES["video"]["error"] == 4) {
            echo
                "<script> alert('Video tidak tersedia'); </script>"
            ;
        } else {
            $file_name = $_FILES['video']['name'];
            $file_temp = $_FILES['video']['tmp_name'];
            $file_size = $_FILES['video']['size'];

            if($file_size < 50000000){
                $file = explode('.', $file_name);
                $end = end($file);
                $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
                if(in_array($end, $allowed_ext)){
                    $name = date("Ymd").time();
                    $location = '../video/'.$name.".".$end;
                    if(move_uploaded_file($file_temp, $location)){
                        mysqli_query($kdb, "insert into tb_video values ('', '$judul', '$id_kategori', '$location', '$tanggal', '')") or die(mysqli_error());
                        echo "<script>window.location = 'video.php'</script>";
                    }
                }else{
                    echo "<script>alert('Format video salah')</script>";
                    echo "<script>window.location = 'video.php'</script>";
                }
        }else{
            echo "<script>alert('Ukuran video terlalu besar')</script>";
            echo "<script>window.location = 'video.php'</script>";
        }
        }
    }


    //edit video
    if(isset($_POST['edit_vid'])) {
        $id_video = $_POST['id_video'];
        $judul = $_POST['judul'];

        $update = mysqli_query($kdb, "update tb_video set id_video = '$id_video', judul = '$judul' where id_video = '$id_video'");

        if($update) {
            header('location:video.php');
        } else {
            echo '
            <script>
                alert("Ubah Data Gagal");
                window.location.href="video.php";
            </script>
            ';
        }
    }


    //hapus video
    if(isset($_POST['hapus_vid'])) {
        $id_video = $_POST['id_video'];

        $delete = mysqli_query($kdb, "delete from tb_video where id_video = '$id_video'");

        if($delete) {
            header('location:video.php');
        } else {
            echo '
            <script>
                alert("Hapus Data Gagal");
                window.location.href="video.php";
            </script>
            ';
        }
    }


    //tambah foto
    if (isset($_POST['tambah_fot']) && isset($_FILES['foto'])) {
        $judul = $_POST['judul'];
        $id_kategori = $_POST['id_kategori'];
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date("Y-m-d");

        if($_FILES["foto"]["error"] == 4) {
            echo
                "<script> alert('Gambar tidak tersedia'); </script>"
            ;
        } else {
            $fileName = $_FILES["foto"]["name"];
            $fileSize = $_FILES["foto"]["size"];
            $tmpName = $_FILES["foto"]["tmp_name"];
        
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));

            if ( !in_array($imageExtension, $validImageExtension) ) {
                echo
                "
                <script>
                    alert('Format gambar salah');
                    document.location.href = 'foto.php';
                </script>
                ";
            } else if($fileSize > 5000000) {
                echo
                "
                <script>
                    alert('Ukuran gambar terlalu besar');
                    document.location.href = 'foto.php';
                </script>
                ";
            } else {
                $newPhotoName = uniqid();
                $newPhotoName .= '.' . $imageExtension;
            
                move_uploaded_file($tmpName, '../foto/' . $newPhotoName);

                $query = "insert into tb_foto values('', '$judul', '$id_kategori', '$newPhotoName', '$tanggal', '')";

                mysqli_query($kdb, $query);
                echo "
                    <script>
                        document.location.href = 'foto.php';
                    </script>
                ";
            }
        }
    }


    //edit foto
    if(isset($_POST['edit_fot'])) {
        $id_foto = $_POST['id_foto'];
        $judul = $_POST['judul'];

        $update = mysqli_query($kdb, "update tb_foto set id_foto = '$id_foto', judul = '$judul' where id_foto = '$id_foto'");

        if($update) {
            header('location:foto.php');
        } else {
            echo '
            <script>
                alert("Ubah Data Gagal");
                window.location.href="foto.php";
            </script>
            ';
        }
    }


    //hapus video
    if(isset($_POST['hapus_fot'])) {
        $id_foto = $_POST['id_foto'];

        $delete = mysqli_query($kdb, "delete from tb_foto where id_foto = '$id_foto'");

        if($delete) {
            header('location:foto.php');
        } else {
            echo '
            <script>
                alert("Hapus Data Gagal");
                window.location.href="foto.php";
            </script>
            ';
        }
    }

?>