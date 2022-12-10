<?php

	$open = (isset($_GET["open"]) ? $_GET["open"] : '') ;
	
	switch ($open) {

        case "daftar_berita":
		include("daftar_berita.php");
		break;

        case "detail_berita":
		include("detail_berita.php");
		break;

        case "detail_video":
		include("detail_video.php");
		break;

        case "detail_foto":
		include("detail_foto.php");
		break;

        case "kategori":
		include("kategori.php");
		break;

        case "cari":
		include("cari.php");
		break;
		
		default:
		include("landing.php");
		break;
	}

?>