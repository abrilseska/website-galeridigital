<?php
    session_start();
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
    include 'db.php'; // Add database connection
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

    .section {
        padding: 50px 0;
    }

    .container {
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    .box {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        text-align: center;
    }

    h3 {
        color: #fff;
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
    }

    h4 {
        color: #333;
        font-size: 20px;
        margin: 0;
    }

    footer {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        padding: 20px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
        text-align: center;
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
        <h1><a href="dashboard.php"><i class="fas fa-camera"></i> GALERI INFORMATIKA</a></h1>
        <ul>
           <li><a href="dashboard_pengunjung.php"><i class="fas fa-home"></i> Dashboard</a></li>
           <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
           <li><a href="galeri.php"><i class="fas fa-images"></i> Galeri Mahasiswa</a></li>
           <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
        </div>
    </header>

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="box">
                <h4>Selamat Datang di Website Galeri Informatika</h4>
     </div>
    <!-- category -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box" style="display: flex; flex-wrap: wrap; justify-content: flex-start; gap: 10px;">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if(mysqli_num_rows($kategori) > 0){
						while($k = mysqli_fetch_array($kategori)){
                            // Get emoji based on category_id to keep it consistent
                            $emojis = array(
                                '🖥️', '🖱️', '📱', '🌐', '🤖',
                                '⚡', '👨‍💻', '🎨', '✨', '💡', '📊'
                            );
                            // Use modulo to get consistent emoji based on category_id
                            $emoji_index = ($k['category_id'] - 1) % count($emojis);
                            $category_emoji = $emojis[$emoji_index];
				?>
                    <a href="galeri.php?kat=<?php echo $k['category_id'] ?>" class="category-card">
                        <div class="category-content">
                            <div class="category-emoji"><?php echo $category_emoji; ?></div>
                            <p class="category-name"><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                     <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
        <style>
            .category-card {
                text-decoration: none;
                flex: 0 0 150px;
                perspective: 1000px;
            }
            
            .category-content {
                margin: 5px;
                padding: 15px;
                background: rgba(248, 249, 250, 0.9);
                border-radius: 10px;
                text-align: center;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                transform-style: preserve-3d;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            
            .category-card:hover .category-content {
                transform: translateY(-10px) rotateX(10deg) rotateY(10deg);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
                background: rgba(255, 255, 255, 1);
            }
            
            .category-emoji {
                font-size: 32px;
                margin-bottom: 10px;
                transition: transform 0.3s ease;
            }
            
            .category-card:hover .category-emoji {
                transform: scale(1.2) rotate(5deg);
                animation: bounce 0.5s ease infinite alternate;
            }
            
            .category-name {
                font-size: 14px;
                color: #333;
                margin: 0;
                transition: color 0.3s ease;
            }
            
            .category-card:hover .category-name {
                color: #4F46E5;
            }
            
            @keyframes bounce {
                from {
                    transform: scale(1.2) translateY(0);
                }
                to {
                    transform: scale(1.2) translateY(-5px);
                }
            }
        </style>
    </div> 
    <!-- content -->
    <div class="container">
       <h3 class="section-title" style="color: #fff;">Karya Mahasiswa Terbaru</h3>
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
    <style>
      .section-title {
        text-align: center;
        font-size: 2.5em;
        color: #4F46E5;
        margin-bottom: 2rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
      }

      .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
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

      .media-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
      }

      .media-wrapper {
        position: relative;
        padding-top: 75%;
        background: #f0f0f0;
      }

      .media-content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
      }
    </style>