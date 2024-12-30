<?php
    session_start();
    include 'db.php'; // Add database connection
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
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
           <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
           <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
           <li><a href="data-image.php"><i class="fas fa-images"></i> Data Foto</a></li>
           <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dashboard</h3>
            <div class="box">
                <h4>Selamat Datang <span style="color: #4F46E5"><?php echo $_SESSION['a_global']->admin_name ?></span> di Website Galeri Foto</h4>
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
                    <a href="galeri.php?kat=<?php echo $k['category_id'] ?>" style="text-decoration: none; flex: 0 0 150px; perspective: 1000px;">
                        <div class="col-5" style="margin: 5px; padding: 15px; background: #f8f9fa; border-radius: 10px; text-align: center; transition: all 0.5s ease; transform-style: preserve-3d; transform: translateZ(0); cursor: pointer;" onmouseover="this.style.transform='rotateY(10deg) translateZ(20px)'" onmouseout="this.style.transform='rotateY(0) translateZ(0)'">
                            <div style="font-size: 32px; margin-bottom: 10px; transform: translateZ(30px); transition: transform 0.3s ease;"><?php echo $category_emoji; ?></div>
                            <p style="font-size: 14px; color: #333; margin: 0; transform: translateZ(20px); transition: transform 0.3s ease;"><?php echo $k['category_name'] ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                     <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- new product -->
    <div class="container">
       <h3 class="section-title" style="font-size: 3em; text-align: center; color: #4F46E5; margin: 2rem 0; text-transform: uppercase; letter-spacing: 3px; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
           <span style="display: inline-block; transform: translateZ(20px); color: #fff;">Karya Mahasiswa Terbaru</span>
       </h3>
       <div class="media-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2.5rem; padding: 2rem; perspective: 1000px;">
          <?php
              $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE image_status = 1 ORDER BY image_id DESC LIMIT 8");
			  if(mysqli_num_rows($foto) > 0){
				  while($p = mysqli_fetch_array($foto)){
                      $file_ext = strtolower(pathinfo($p['image'], PATHINFO_EXTENSION));
                      $video_formats = array('mp4', 'mov', 'avi', 'wmv');
		  ?>
          <a href="detail-image.php?id=<?php echo $p['image_id'] ?>" class="media-card" style="text-decoration: none; transform-style: preserve-3d; transition: all 0.5s ease;">
            <div class="media-wrapper" style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.2); transform: translateZ(0); transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05) rotateY(10deg)'" onmouseout="this.style.transform='scale(1) rotateY(0)'">
              <?php if(in_array($file_ext, $video_formats)){ ?>
                  <video class="media-content" autoplay muted loop style="width: 100%; height: 300px; object-fit: cover;">
                      <source src="foto/<?php echo $p['image'] ?>" type="video/<?php echo $file_ext ?>">
                      Your browser does not support the video tag.
                  </video>
              <?php } else { ?>
                  <img class="media-content" src="foto/<?php echo $p['image'] ?>" alt="<?php echo $p['image_name'] ?>" style="width: 100%; height: 300px; object-fit: cover;" />
              <?php } ?>
              <div class="media-overlay" style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1.5rem; transform: translateY(100%); transition: transform 0.3s ease;">
                <div class="media-info" style="transform: translateZ(30px);">
                  <h4 class="media-title" style="color: #fff; font-size: 1.2em; margin-bottom: 0.5rem; font-weight: 600;"><?php echo substr($p['image_name'], 0, 30) ?></h4>
                  <p class="media-meta" style="color: #ddd; font-size: 0.9em; margin: 0.3rem 0;"><i class="fas fa-user"></i> <?php echo $p['admin_name'] ?></p>
                  <p class="media-meta" style="color: #ddd; font-size: 0.9em; margin: 0.3rem 0;"><i class="far fa-calendar-alt"></i> <?php echo $p['date_created'] ?></p>
                </div>
              </div>
            </div>
          </a>
          <?php }}else{ ?>
              <div class="no-content" style="text-align: center; grid-column: 1/-1; padding: 3rem; background: rgba(255,255,255,0.9); border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                <i class="fas fa-image no-content-icon" style="font-size: 4em; color: #4F46E5; margin-bottom: 1rem;"></i>
                <p style="color: #666; font-size: 1.2em;">Media tidak ada</p>
              </div>
          <?php } ?>
       </div>
    </div>
    
    <style>
        .media-wrapper:hover .media-overlay {
            transform: translateY(0);
        }
        
        .media-wrapper:hover .media-content {
            transform: scale(1.1);
        }
        
        .media-content {
            transition: transform 0.5s ease;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        .section-title span {
            animation: float 3s ease-in-out infinite;
        }
    </style>
