<?php
    error_reporting(0);
    include 'db.php';
    session_start();
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Galeri Informatika</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    
    body {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        margin: 0;
        padding: 0;
    }

    header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 20px 0;
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
        background: rgba(255, 255, 255, 0.95);
        padding: 30px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .search input[type="text"] {
        padding: 12px 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 60%;
        margin-right: 10px;
        transition: 0.3s;
    }

    .search input[type="text"]:focus {
        border-color: #4F46E5;
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
    }

    .search input[type="submit"] {
        padding: 12px 25px;
        background: #4F46E5;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .search input[type="submit"]:hover {
        background: #6366F1;
    }

    .section {
        padding: 40px 0;
    }

    .section h3 {
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .box {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .col-4 {
        background: rgba(255, 255, 255, 0.95);
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: 0.3s;
        width: 250px;
    }

    .col-4:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.2);
    }

    .col-4 img, .col-4 video {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .nama {
        color: #333;
        font-weight: 500;
        margin: 10px 0 5px;
    }

    .admin {
        color: #666;
        font-size: 14px;
        margin: 5px 0;
    }

    footer {
        background: rgba(0, 0, 0, 0.2);
        color: #fff;
        padding: 20px 0;
        text-align: center;
        backdrop-filter: blur(10px);
    }

    footer small {
        font-size: 14px;
    }
</style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php"><i class="fas fa-camera"></i> GALERI INFORMATIKA</a></h1>
        <ul>
            <?php if(isset($_SESSION['status_login'])){ ?>
                <?php if($_SESSION['role'] == 'admin'){ ?>
                    <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="data-image.php"><i class="fas fa-images"></i> Data Foto</a></li>
                    <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                <?php } else { ?>
                    <li><a href="dashboard_pengunjung.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                    <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
                <?php } ?>
            <?php } else { ?>
                <li><a href="index.php"><i class="fas fa-home"></i> Beranda</a></li>
                <li><a href="registrasi.php"><i class="fas fa-user-plus"></i> Registrasi</a></li>
                <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
            <?php } ?>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto..." value="<?php echo $_GET['search'] ?>" />
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>" />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>

    <!-- new product -->
    <div class="section">
    <div class="container">
       <h3>Galeri Karya Mahasiswa</h3>
       <div class="box">
          <?php
              if($_GET['search'] != '' || $_GET['kat'] != ''){
                 $where = "AND image_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
              }
              $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 $where ORDER BY image_id DESC");
              if(mysqli_num_rows($foto) > 0){
                  while($p = mysqli_fetch_array($foto)){
                      $file_ext = strtolower(pathinfo($p['image'], PATHINFO_EXTENSION));
                      $video_formats = array('mp4', 'mov', 'avi', 'wmv');
          ?>
          <div class="media-grid">
              <a href="detail-image.php?id=<?php echo $p['image_id'] ?>" class="media-card">
                  <div class="media-wrapper">
                      <?php if(in_array($file_ext, $video_formats)){ ?>
                          <video class="media-content" autoplay muted loop>
                              <source src="foto/<?php echo $p['image'] ?>" type="video/<?php echo $file_ext ?>">
                              Your browser does not support the video tag.
                          </video>
                      <?php } else { ?>
                          <img class="media-content" src="foto/<?php echo $p['image'] ?>" alt="<?php echo $p['image_name'] ?>">
                      <?php } ?>
                      <div class="media-overlay">
                          <div class="media-info">
                              <h4 class="media-title"><?php echo substr($p['image_name'], 0, 30) ?></h4>
                              <p class="media-meta"><i class="fas fa-user"></i> <?php echo $p['admin_name'] ?></p>
                              <p class="media-meta"><i class="far fa-calendar-alt"></i> <?php echo $p['date_created'] ?></p>
                          </div>
                      </div>
                  </div>
              </a>
          </div>
          <?php }}else{ ?>
              <div class="no-content">
                  <i class="fas fa-image no-content-icon"></i>
                  <p>Tidak ada foto yang ditemukan</p>
              </div>
          <?php } ?>
          <style>
              .media-grid {
                  display: grid;
                  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                  gap: 20px;
                  padding: 20px;
              }
              
              .media-card {
                  text-decoration: none;
                  color: inherit;
                  background: #fff;
                  border-radius: 10px;
                  overflow: hidden;
                  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                  transition: transform 0.3s ease;
              }
              
              .media-card:hover {
                  transform: translateY(-5px);
              }
              
              .media-wrapper {
                  position: relative;
                  padding-top: 75%;
              }
              
              .media-content {
                  position: absolute;
                  top: 0;
                  left: 0;
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
              }
              
              .media-overlay {
                  position: absolute;
                  bottom: 0;
                  left: 0;
                  right: 0;
                  background: linear-gradient(transparent, rgba(0,0,0,0.8));
                  padding: 20px;
                  color: #fff;
              }
              
              .media-title {
                  margin: 0 0 10px;
                  font-size: 16px;
                  font-weight: 500;
              }
              
              .media-meta {
                  font-size: 14px;
                  margin: 5px 0;
                  opacity: 0.8;
              }
              
              .no-content {
                  text-align: center;
                  padding: 40px;
                  color: #666;
              }
              
              .no-content-icon {
                  font-size: 48px;
                  margin-bottom: 15px;
                  opacity: 0.5;
              }
          </style>
       </div>
    </div>
    </div>
    
    <!-- footer -->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Web Galeri Informatika.</small>
        </div>
    </footer>
</body>
</html>