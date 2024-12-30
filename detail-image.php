<?php
    session_start();
    error_reporting(0);
    include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
	
	$produk = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WEB Galeri INFORMATIKA</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    header {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        padding: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    header h1 a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    header ul li a {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        transition: 0.3s;
    }

    header ul li a:hover {
        background: rgba(255,255,255,0.2);
    }

    .search {
        background: #fff;
        padding: 15px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .search input[type=text] {
        width: 60%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .search input[type=submit] {
        padding: 10px 20px;
        background: #4F46E5;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .search input[type=submit]:hover {
        background: #6366F1;
    }

    .section {
        padding: 40px 0;
    }

    .section h3 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .box {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .col-2 {
        width: 48%;
        float: left;
        padding: 10px;
        box-sizing: border-box;
    }

    .col-2 img, .col-2 video {
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        max-width: 100%;
        height: auto;
    }

    .col-2 h3 {
        font-size: 20px;
        margin: 15px 0;
        color: #333;
    }

    .col-2 h4 {
        font-size: 16px;
        color: #666;
        font-weight: 500;
        margin: 10px 0;
    }

    .col-2 p {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
    }

    footer {
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 20px 0;
        text-align: center;
    }

    footer small {
        font-size: 14px;
    }

    @media screen and (max-width: 768px) {
        .col-2 {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">WEB GALERI INFORMATIKA</a></h1>
        <ul>
            <?php if(!isset($_SESSION['status_login'])): ?>
                <!-- Menu untuk pengunjung yang belum login -->
                <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="registrasi.php"><i class="fas fa-user-plus"></i> Registrasi</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <?php else: ?>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <!-- Menu untuk admin -->
                    <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard Admin</a></li>
                    <li><a href="data-image.php"><i class="fas fa-images"></i> Data Galeri</a></li>
                    <li><a href="kelola-admin.php"><i class="fas fa-users-cog"></i> Kelola Admin</a></li>
                <?php else: ?>
                    <!-- Menu untuk pengunjung yang sudah login -->
                    <li><a href="dashboard_pengunjung.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="galeri.php"><i class="fas fa-photo-video"></i> Galeri</a></li>
                    <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                <?php endif; ?>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php endif; ?>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto/Video..." value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari" />
            </form>
        </div>
    </div>
    
    <!-- media detail -->
    <div class="section">
        <div class="container">
            <h3><i class="fas fa-photo-video"></i> Detail Media</h3>
            <div class="box">
                <div class="col-2">
                    <?php
                    $file_extension = strtolower(pathinfo($p->image, PATHINFO_EXTENSION));
                    if(in_array($file_extension, array('mp4', 'webm', 'ogg'))) { ?>
                        <video width="100%" controls>
                            <source src="foto/<?php echo $p->image ?>" type="video/<?php echo $file_extension ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php } else { ?>
                        <img src="foto/<?php echo $p->image ?>" width="100%" />
                    <?php } ?>
                </div>
                <div class="col-2">
                   <h3><?php echo $p->image_name ?><br /><span style="font-size: 16px; color: #4F46E5;"><i class="fas fa-tag"></i> <?php echo $p->category_name  ?></span></h3>
                   <h4><i class="fas fa-user"></i> <?php echo $p->admin_name ?><br />
                   <i class="far fa-calendar-alt"></i> <?php echo $p->date_created  ?></h4>
                   <p><strong><i class="fas fa-align-left"></i> Deskripsi:</strong><br />
                        <?php echo $p->image_description ?>
                   </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri INFORMATIKA.</small>
        </div>
    </footer>
</body>
</html>