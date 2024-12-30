<?php
    session_start();
	include 'db.php';
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
        background: #f5f5f5;
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

    .section {
        padding: 50px 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
    }

    .box {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
    }

    h3 {
        color: #333;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .input-control {
        width: 100%;
        padding: 12px 15px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: 0.3s;
    }

    .input-control:focus {
        border-color: #6366F1;
        outline: none;
    }

    textarea.input-control {
        min-height: 150px;
        resize: vertical;
    }

    .btn {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        color: #fff;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
        margin-top: 15px;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
    }

    footer {
        background: #333;
        color: #fff;
        padding: 20px 0;
        text-align: center;
        margin-top: 50px;
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
            <h3><i class="fas fa-plus"></i> Tambah Data Karya Mahasiswa</h3>
            <div class="box">
             
               <form action="" method="POST" enctype="multipart/form-data">
                
                   <?php   $result = mysqli_query($conn,"select * from tb_category");   $jsArray = "var prdName = new Array();\n";   
echo '<select class="input-control" name="kategori" onchange="document.getElementById(\'prd_name\').value = prdName[this.value]" required>  <option>-Pilih Kategori Foto/Video-</option>';while ($row = mysqli_fetch_array($result)) {  echo ' <option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';  
$jsArray .= "prdName['" . $row['category_id'] . "'] = '" . addslashes($row['category_name']) . "';\n";}echo '</select>';?>
                   </select>
                   <input type="hidden" name="nama_kategori" id="prd_name">
                   <input type="hidden" name="adminid" value="<?php echo $_SESSION['a_global']->admin_id ?>">
                   <input type="text" name="namaadmin" class="input-control" value="<?php echo $_SESSION['a_global']->admin_name ?>">
                   <input type="text" name="nama" class="input-control" placeholder="Nama File" required>
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea><br />
                   <input type="file" name="gambar" class="input-control" required>
                   <select class="input-control" name="status">
                       <option value="">--Pilih Status--</option>
                       <option value="1">Aktif</option>
                       <option value="0">Tidak Aktif</option> 
                   </select>
                   <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){
					   
					   // print_r($_FILES[gambar']);
					   // menampung inputan dari form
					   $kategori  = $_POST['kategori'];
					   $nama_ka   = $_POST['nama_kategori'];
					   $ida  	   = $_POST['adminid'];
					   $user	  = $_POST['namaadmin'];
					   $nama      = $_POST['nama'];
					   $deskripsi = $_POST['deskripsi'];
					   $status    = $_POST['status'];
					   
					   // menampung data file yang diupload
					   $filename = $_FILES['gambar']['name'];
					   $tmp_name = $_FILES['gambar']['tmp_name'];
					   
					   $type1 = explode('.', $filename);
					   $type2 = strtolower(end($type1));

                       $newname = 'media'.time().'.'.$type2; 
						
					   // menampung data format file yang diizinkan
					   $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif', 'mp4', 'mov', 'avi', 'wmv');
					   
					   // validasi format file
					   if(!in_array($type2, $tipe_diizinkan)){
						  // jika format file tidak ada di dalam tipe diizinkan
						  echo '<script>alert("Format file tidak diizinkan")</script>';
						
					   }else{
						   // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
						   // proses upload file sekaligus insert ke database
						   move_uploaded_file($tmp_name, './foto/'.$newname);
						   
						   $insert = mysqli_query($conn, "INSERT INTO tb_image VALUES (
						               null,
									   '".$kategori."',
									   '".$nama_ka."',
									   '".$ida."',
									   '".$user."',
									   '".$nama."',
									   '".$deskripsi."',
									   '".$newname."',
									   '".$status."',
									   null
						                   ) ");
										   
				           if($insert){
							   echo '<script>alert("Tambah File berhasil")</script>';
							   echo '<script>window.location="data-image.php"</script>';
						   }else{
							   echo 'gagal'.mysqli_error($conn);
							   
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
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'deskripsi' );
    </script>
    <script type="text/javascript"><?php echo $jsArray; ?></script>
</body>
</html>