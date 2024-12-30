<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }

    // Get user data based on role
    if($_SESSION['role'] == 'admin') {
        $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id ='".$_SESSION['id']."'");
        $d = mysqli_fetch_object($query);
    } else {
        $query = mysqli_query($conn, "SELECT * FROM tb_pengunjung WHERE pengunjung_id ='".$_SESSION['id']."'");
        $d = mysqli_fetch_object($query);
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
        max-width: 1000px;
        margin: auto;
    }

    .box {
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        margin-bottom: 30px;
    }

    h3 {
        color: #fff;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .input-control {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .input-control:focus {
        border-color: #4F46E5;
        outline: none;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2);
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #4F46E5;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn:hover {
        background: #6366F1;
    }

    footer {
        background: rgba(0,0,0,0.5);
        color: #fff;
        padding: 20px 0;
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
        <h1><a href="dashboard.php">GALERI INFORMATIKA</a></h1>
        <ul>
            <?php if($_SESSION['role'] == 'admin'){ ?>
                <li><a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="data-image.php"><i class="fas fa-images"></i> Data Foto</a></li>
            <?php } else { ?>
                <li><a href="dashboard_pengunjung.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
                <li><a href="galeri.php"><i class="fas fa-images"></i> Galeri Mahasiswa</a></li>
            <?php } ?>
            <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $_SESSION['role'] == 'admin' ? $d->admin_name : $d->pengunjung_name ?>" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" value="<?php echo $_SESSION['role'] == 'admin' ? $d->username : $d->username ?>" required>
                   <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $_SESSION['role'] == 'admin' ? $d->admin_telp : $d->pengunjung_telp ?>" required>
                   <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $_SESSION['role'] == 'admin' ? $d->admin_email : $d->pengunjung_email ?>" required>
                   <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $_SESSION['role'] == 'admin' ? $d->admin_address : $d->pengunjung_address ?>" required>
                   <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   $nama   = $_POST['nama'];
					   $user   = $_POST['user'];
					   $hp     = $_POST['hp'];
					   $email  = $_POST['email'];
					   $alamat = $_POST['alamat'];

                       if($_SESSION['role'] == 'admin') {
                           $update = mysqli_query($conn, "UPDATE tb_admin SET 
                                      admin_name = '".$nama."',
                                      username = '".$user."',
                                      admin_telp = '".$hp."',
                                      admin_email = '".$email."',
                                      admin_address = '".$alamat."'
                                      WHERE admin_id = '".$d->admin_id."'");
                       } else {
                           $update = mysqli_query($conn, "UPDATE tb_pengunjung SET 
                                      pengunjung_name = '".$nama."',
                                      username = '".$user."',
                                      pengunjung_telp = '".$hp."',
                                      pengunjung_email = '".$email."',
                                      pengunjung_address = '".$alamat."'
                                      WHERE pengunjung_id = '".$d->pengunjung_id."'");
                       }
					   
					   if($update){
						   echo '<script>alert("Ubah data berhasil")</script>';
						   echo '<script>window.location="profil.php"</script>';
					   }else{
						   echo 'gagal '.mysqli_error($conn);
					   }
					   
					}  
			   ?>
            </div>
            
            <h3>Ubah Password</h3>
            <div class="box">
               <form action="" method="POST">
                   <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                   <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                   <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
               </form>
               <?php
                   if(isset($_POST['ubah_password'])){
					   
					   $pass1   = $_POST['pass1'];
					   $pass2   = $_POST['pass2'];
					   
					   if($pass2 != $pass1){
						   echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
					   }else{
                           if($_SESSION['role'] == 'admin') {
                               $u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
                                          password = '".$pass1."'
                                          WHERE admin_id = '".$d->admin_id."'");
                           } else {
                               $u_pass = mysqli_query($conn, "UPDATE tb_pengunjung SET 
                                          password = '".$pass1."'
                                          WHERE pengunjung_id = '".$d->pengunjung_id."'");
                           }
						   
						   if($u_pass){
							   echo '<script>alert("Ubah data berhasil")</script>';
						       echo '<script>window.location="profil.php"</script>';
						   }else{
							   echo 'gagal '.mysqli_error($conn);
						   }
					   }
					  
					}  
			   ?>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - Galeri Informatika.</small>
        </div>
    </footer>
</body>
</html>