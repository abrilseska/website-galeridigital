<?php
	include 'db.php';
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
        padding: 0 20px;
    }

    .box {
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    h3 {
        color: #fff;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
        font-weight: 600;
    }

    .input-control {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
        transition: 0.3s;
        font-size: 14px;
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
        font-size: 16px;
        transition: 0.3s;
    }

    .btn:hover {
        background: #6366F1;
        transform: translateY(-2px);
    }

    footer {
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 20px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    footer small {
        font-size: 14px;
    }

    .password-container {
        position: relative;
        width: 100%;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }

    .tab-container {
        display: flex;
        justify-content: center;
        margin-bottom: 20px;
    }

    .tab {
        padding: 10px 20px;
        margin: 0 10px;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .tab.active {
        background: white;
        color: #4F46E5;
    }

    #admin-form, #pengunjung-form {
        display: none;
    }

    #admin-form.active, #pengunjung-form.active {
        display: block;
    }
</style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="index.php">GALERI INFORMATIKA</a></h1>
        <ul>
           <li><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
           <li><a href="registrasi.php"><i class="fas fa-user-plus"></i> Registrasi</a></li>
           <li><a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container" style="max-width: 500px; margin: 0 auto;">
            <h3>Registrasi Akun</h3>
            <div class="tab-container">
                <div class="tab active" onclick="showForm('admin')">Mahasiswa</div>
                <div class="tab" onclick="showForm('pengunjung')">Pengunjung</div>
            </div>
            <div class="box" style="padding: 20px;">
               <form action="" method="POST" id="admin-form" class="active">
                   <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
                   <input type="text" name="npm" placeholder="NPM" class="input-control" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" required>
                   <div class="password-container">
                       <input type="password" name="pass" id="password" placeholder="Password" class="input-control" required>
                       <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
                   </div>
                   <input type="tel" name="tlp" placeholder="Nomor Telpon" class="input-control" required>
                   <input type="email" name="email" placeholder="E-mail" class="input-control" required>
                   <input type="text" name="almt" placeholder="Alamat" class="input-control" required>
                   <input type="submit" name="submit_admin" value="Daftar Sebagai Admin" class="btn">
               </form>

               <form action="" method="POST" id="pengunjung-form">
                   <input type="text" name="nama" placeholder="Nama User" class="input-control" required>
                   <input type="text" name="user" placeholder="Username" class="input-control" required>
                   <div class="password-container">
                       <input type="password" name="pass" id="password2" placeholder="Password" class="input-control" required>
                       <i class="fas fa-eye toggle-password" onclick="togglePassword2()"></i>
                   </div>
                   <input type="tel" name="tlp" placeholder="Nomor Telpon" class="input-control" required>
                   <input type="email" name="email" placeholder="E-mail" class="input-control" required>
                   <input type="text" name="almt" placeholder="Alamat" class="input-control" required>
                   <input type="submit" name="submit_pengunjung" value="Daftar Sebagai Pengunjung" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit_admin'])){
					   
					   $nama = ucwords($_POST['nama']);
                       $npm = $_POST['npm'];
					   $username = $_POST['user'];
					   $password = $_POST['pass'];
					   $telpon = $_POST['tlp'];
					   $mail = $_POST['email'];
					   $alamat = ucwords($_POST['almt']);
					   
                       // Cek apakah NPM sesuai dengan format yang diizinkan
                       $allowed_npm = array('07352211144', '0735221119', '073522111149', '07352211125', '2125250004', '2125250005');
                       
                       if(in_array($npm, $allowed_npm)) {
                           $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES (
                                            null,
                                            '".$nama."',
                                            '".$username."',
                                            '".$password."',
                                            '".$telpon."',
                                            '".$mail."',
                                            '".$alamat."')");
                                            
                            if($insert){
                                echo '<script>alert("Registrasi mahasiswa berhasil")</script>';
                                echo '<script>window.location="login.php"</script>';
                            }else{
                                echo 'gagal '.mysqli_error($conn);
                            }
                       } else {
                           echo '<script>alert("NPM tidak valid! Registrasi gagal.")</script>';
                       }
					}

                    if(isset($_POST['submit_pengunjung'])){
                        
                        // Validasi input
                        if(empty($_POST['nama']) || empty($_POST['user']) || empty($_POST['pass']) || 
                           empty($_POST['tlp']) || empty($_POST['email']) || empty($_POST['almt'])) {
                            echo '<script>alert("Semua field harus diisi!")</script>';
                            return;
                        }

                        $nama = mysqli_real_escape_string($conn, ucwords($_POST['nama']));
                        $username = mysqli_real_escape_string($conn, $_POST['user']); 
                        $password = mysqli_real_escape_string($conn, $_POST['pass']);
                        $telpon = mysqli_real_escape_string($conn, $_POST['tlp']);
                        $mail = mysqli_real_escape_string($conn, $_POST['email']);
                        $alamat = mysqli_real_escape_string($conn, ucwords($_POST['almt']));

                        // Cek username sudah ada atau belum
                        $check = mysqli_query($conn, "SELECT * FROM tb_pengunjung WHERE username = '".$username."'");
                        if(mysqli_num_rows($check) > 0){
                            echo '<script>alert("Username sudah digunakan!")</script>';
                            return;
                        }
                        
                        $insert = mysqli_query($conn, "INSERT INTO tb_pengunjung VALUES (
                                        null,
                                        '".$nama."',
                                        '".$username."',
                                        '".$password."',
                                        '".$telpon."',
                                        '".$mail."',
                                        '".$alamat."')");
                                        
                        if($insert){
                            echo '<script>alert("Registrasi pengunjung berhasil")</script>';
                            echo '<script>window.location="login.php"</script>';
                        }else{
                            echo '<script>alert("Registrasi gagal: '.mysqli_error($conn).'")</script>';
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

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function togglePassword2() {
            const passwordInput = document.getElementById('password2');
            const toggleIcon = document.querySelector('#pengunjung-form .toggle-password');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        function showForm(type) {
            const adminForm = document.getElementById('admin-form');
            const pengunjungForm = document.getElementById('pengunjung-form');
            const tabs = document.querySelectorAll('.tab');

            if(type === 'admin') {
                adminForm.classList.add('active');
                pengunjungForm.classList.remove('active');
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else {
                adminForm.classList.remove('active');
                pengunjungForm.classList.add('active');
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }
    </script>
</body>
</html>