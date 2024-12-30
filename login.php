<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | Web Galeri Foto</title>
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
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .box-login {
        background: rgba(255, 255, 255, 0.95);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        width: 350px;
    }

    .box-login h2 {
        text-align: center;
        color: #333;
        margin-bottom: 30px;
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

    p {
        text-align: center;
        margin: 15px 0;
        color: #666;
    }

    a {
        text-decoration: none;
        color: #4F46E5 !important;
        font-weight: 500;
        transition: 0.3s;
    }

    a:hover {
        color: #6366F1 !important;
    }

    .password-container {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }
</style>
</head>

<body>
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="input-group">
                <input type="text" name="user" placeholder="Username atau NPM" class="input-control">
            </div>
            <div class="input-group password-container">
                <input type="password" name="pass" id="password" placeholder="Password" class="input-control">
                <i class="fas fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
            if(isset($_POST['submit'])){
                session_start();
                include 'db.php';

                $user = mysqli_real_escape_string($conn, $_POST['user']);
                $pass = mysqli_real_escape_string($conn, $_POST['pass']);

                // Cek login admin
                $cek_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".$pass."'");
                
                if($cek_admin) {
                    // Jika login dengan username gagal, coba dengan NPM
                    if(mysqli_num_rows($cek_admin) == 0) {
                        $allowed_npm = array('2125250001', '2125250002', '2125250003', '2125250004', '2125250005');
                        
                        if(in_array($user, $allowed_npm)) {
                            $cek_admin = mysqli_query($conn, "SELECT * FROM tb_admin WHERE npm = '".$user."' AND password = '".$pass."'");
                        }
                    }

                    if($cek_admin && mysqli_num_rows($cek_admin) > 0){
                        $d = mysqli_fetch_object($cek_admin);
                        $_SESSION['status_login'] = true;
                        $_SESSION['a_global'] = $d;
                        $_SESSION['id'] = $d->admin_id;
                        $_SESSION['role'] = 'admin';
                        echo '<script>window.location="dashboard.php"</script>';
                    } else {
                        // Jika bukan admin, cek login pengunjung
                        $cek_pengunjung = mysqli_query($conn, "SELECT * FROM tb_pengunjung WHERE username = '".$user."' AND password = '".$pass."'");
                        
                        if($cek_pengunjung && mysqli_num_rows($cek_pengunjung) > 0) {
                            $d = mysqli_fetch_object($cek_pengunjung);
                            $_SESSION['status_login'] = true;
                            $_SESSION['p_global'] = $d;
                            $_SESSION['id'] = $d->pengunjung_id;
                            $_SESSION['role'] = 'pengunjung';
                            echo '<script>window.location="dashboard_pengunjung.php"</script>';
                        } else {
                            echo '<script>alert("Username/NPM atau password anda salah")</script>';
                        }
                    }
                } else {
                    echo '<script>alert("Error dalam query database")</script>';
                }
            }
        ?>
        <p>Belum punya akun? <a href="registrasi.php">Daftar disini</a></p>
        <p><a href="index.php"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a></p>
    </div>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleIcon = document.querySelector(".toggle-password");
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>