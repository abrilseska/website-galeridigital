<?php
    include 'db.php';
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
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        background-color: #f5f5f5;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    header {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        padding: 15px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    header h1 {
        font-size: clamp(1.5rem, 3vw, 2rem);
    }

    header h1 a {
        color: #fff;
        text-decoration: none;
        font-weight: 600;
    }

    header ul {
        list-style: none;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    header ul li a {
        color: #fff;
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 5px;
        transition: 0.3s;
        font-size: clamp(0.9rem, 2vw, 1rem);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    header ul li a:hover {
        background: rgba(255,255,255,0.2);
    }

    .search {
        background: #fff;
        padding: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .search form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .search input[type="text"] {
        padding: 12px 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        width: 100%;
        max-width: 500px;
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
        color: #333;
        font-size: clamp(1.5rem, 3vw, 2rem);
        margin-bottom: 30px;
        text-align: center;
    }

    .box {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    }

    .col-5 {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        transition: 0.3s;
    }

    .col-5:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: clamp(1rem, 2vw, 2rem);
        padding: 1rem;
    }

    .media-card {
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
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
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 1.5rem;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .media-info {
        color: #fff;
    }

    .media-title {
        font-size: clamp(1rem, 2vw, 1.2rem);
        margin: 0 0 0.5rem;
        font-weight: 500;
    }

    .media-meta {
        font-size: clamp(0.8rem, 1.5vw, 0.9rem);
        margin: 0.3rem 0;
        opacity: 0.8;
    }

    footer {
        background: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
        font-size: clamp(0.8rem, 2vw, 1rem);
    }

    @media (max-width: 768px) {
        header .container {
            text-align: center;
        }

        header ul {
            justify-content: center;
            margin-top: 15px;
        }

        .search form {
            flex-direction: column;
            align-items: center;
        }

        .search input[type="submit"] {
            width: 100%;
            max-width: 500px;
        }

        .media-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        }
    }

    @media (max-width: 480px) {
        .container {
            width: 95%;
        }

        .section {
            padding: 30px 0;
        }

        .box {
            padding: 15px;
        }

        .media-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">GALERI INFORMATIKA</a></h1>
        <ul>
            <li><a href="galeri.php"><i class="fas fa-images"></i> Galeri</a></li>
            <li><a href="registrasi.php"><i class="fas fa-user-plus"></i> Registrasi</a></li>
            <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="galeri.php">
                <input type="text" name="search" placeholder="Cari Foto..." />
                <input type="submit" name="cari" value="Cari Foto" />
            </form>
        </div>
    </div>
    
    <!-- category -->
    <div class="section">
        <div class="container">
            <h3 class="category-title">Kategori</h3>
            <div class="box category-grid">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                            $emojis = array(
                                '📱', '🎨', '👨‍💻', '📊', '✨',
                                '⚡', '🖥️', '🖱️', '🤖', '💡', '🌐'
                            );
                            $emoji_index = ($k['category_id'] - 1) % count($emojis);
                            $category_emoji = $emojis[$emoji_index];
                ?>
                    <a href="galeri.php?kat=<?php echo $k['category_id'] ?>" class="category-card">
                        <div class="category-content">
                            <div class="category-front">
                                <div class="emoji"><?php echo $category_emoji; ?></div>
                                <p class="category-name"><?php echo $k['category_name'] ?></p>
                            </div>
                            <div class="category-back">
                                <p>Lihat Galeri</p>
                            </div>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p class="no-category">Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
        <style>
            .category-title {
                text-align: center;
                font-size: 2em;
                margin-bottom: 30px;
                color: #333;
            }
            
            .category-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 20px;
                padding: 20px;
            }
            
            .category-card {
                text-decoration: none;
                perspective: 1000px;
                height: 180px;
            }
            
            .category-content {
                position: relative;
                width: 100%;
                height: 100%;
                transform-style: preserve-3d;
                transition: transform 0.8s;
            }
            
            .category-card:hover .category-content {
                transform: rotateY(180deg);
            }
            
            .category-front, .category-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                border-radius: 15px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }
            
            .category-front {
                background: linear-gradient(145deg, #ffffff, #f0f0f0);
            }
            
            .category-back {
                background: linear-gradient(145deg, #4a90e2, #357abd);
                transform: rotateY(180deg);
                color: white;
            }
            
            .emoji {
                font-size: 48px;
                margin-bottom: 15px;
                transform: translateZ(20px);
            }
            
            .category-name {
                font-size: 16px;
                color: #333;
                margin: 0;
                font-weight: 500;
            }
            
            .no-category {
                text-align: center;
                grid-column: 1 / -1;
                color: #666;
            }
            
            @media (max-width: 768px) {
                .category-grid {
                    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                }
            }
        </style>
    </div>
   <!-- new product -->
   <div class="container">
       <h3 class="section-title">Karya Mahasiswa Terbaru</h3>
       <div class="media-grid">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
                      $file_ext = strtolower(pathinfo($p['image'], PATHINFO_EXTENSION));
                      $video_formats = array('mp4', 'mov', 'avi', 'wmv');
		  ?>
          <a href="detail-image.php?id=<?php echo $p['image_id'] ?>" class="media-card">
            <div class="media-wrapper">
              <?php if(in_array($file_ext, $video_formats)){ ?>
                  <video class="media-content" autoplay muted loop>
                      <source src="foto/<?php echo $p['image'] ?>" type="video/<?php echo $file_ext ?>">
                      Your browser does not support the video tag.
                  </video>
              <?php } else { ?>
                  <img class="media-content" src="foto/<?php echo $p['image'] ?>" alt="<?php echo $p['image_name'] ?>" />
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
          <?php }}else{ ?>
              <div class="no-content">
                <i class="fas fa-image no-content-icon"></i>
                <p>Media tidak ada</p>
              </div>
          <?php } ?>
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