<?php
    session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
    }
	
	$produk = mysqli_query($conn, "SELECT * FROM  tb_image WHERE image_id = '".$_GET['id']."'");
	if(mysqli_num_rows($produk) == 0){
	    echo '<script>window.location="data-image.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
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
<script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
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

    .section {
        padding: 50px 0;
    }

    .container {
        width: 80%;
        margin: 0 auto;
    }

    .box {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
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

    .btn {
        background: linear-gradient(135deg, #6366F1, #4F46E5);
        color: #fff;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99,102,241,0.3);
    }

    select.input-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 12L2 6h12z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
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

    .preview-image {
        max-width: 200px;
        border-radius: 8px;
        margin: 15px 0;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>
</head>

<body>
    <!-- header -->
    <header>
        <div class="container">
        <h1><a href="dashboard.php">GALERI INFORMATIKA</a></h1>
        <ul>
           <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
           <li><a href="profil.php"><i class="fas fa-user"></i> Profil</a></li>
           <li><a href="data-image.php"><i class="fas fa-images"></i> Data Foto</a></li>
           <li><a href="Keluar.php"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
        </ul>
        </div>
    </header>
    
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3><i class="fas fa-edit"></i> Edit Data Foto</h3>
            <div class="box">
                <form action="" method="POST" enctype="multipart/form-data">
                    <select name="kategori" class="input-control" required>
                        <option value="">--Pilih Kategori--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                        <option value="<?php echo $r['category_name'] ?>" <?php echo ($r['category_name'] == $p->category_name)? 'selected':''; ?>><?php echo $r['category_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="namauser" class="input-control" placeholder="Nama User" value="<?php echo $p->admin_name ?>" readonly="readonly">
                    <input type="text" name="nama" class="input-control" placeholder="Nama Foto" value="<?php echo $p->image_name ?>" required>
                    
                    <img src="foto/<?php echo $p->image ?>" class="preview-image"/>
                    <input type="hidden" name="foto" value="<?php echo $p->image ?>" />
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->image_description ?></textarea><br />
                    <select class="input-control" name="status">
                        <option value="">--Pilih Status--</option>
                        <option value="1" <?php echo ($p->image_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0"<?php echo ($p->image_status == 0)? 'selected':''; ?>>Tidak Aktif</option> 
                    </select>
                    <input type="submit" name="submit" value="Simpan Perubahan" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
					
					// data inputan dari form
					$kategori  = $_POST['kategori'];
					$user      = $_POST['namauser'];
					$nama      = $_POST['nama'];
					$deskripsi = $_POST['deskripsi'];
					$status    = $_POST['status'];
					$foto      = $_POST['foto'];
					
					// data gambar yang baru 
					$filename = $_FILES['gambar']['name'];
					$tmp_name = $_FILES['gambar']['tmp_name'];
					   
					//jika admin ganti gambar
					if($filename != ''){
						
						$type1 = explode('.', $filename);
					    $type2 = $type1[1];

                        $newname = 'foto'.time().'.'.$type2;
					
					    // menampung data format file yang diizinkan
					    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'gif');
					
					  // validasi format file
					  if(!in_array($type2, $tipe_diizinkan)){
				        // jika format file tidak ada di dalam tipe diizinkan
				        echo '<script>alert("Format file tidak diizinkan")</script>';
						
					  }else{
						unlink('./foto/'.$foto); 
					    move_uploaded_file($tmp_name, './foto/'.$newname);
						$namagambar = $newname;  
					  }
					
					}else{
					   // jika admin tidak ganti gambar
					   $namagambar = $foto;
					   
					}
					
					//query update data produk
					$update = mysqli_query($conn, "UPDATE tb_image SET
					                       category_name       = '".$kategori."',
										   admin_name          = '".$user."',
										   image_name          = '".$nama."',
										   image_description   = '".$deskripsi."',
										   image               = '".$namagambar."',
										   image_status        = '".$status."'
										   WHERE image_id      = '".$p->image_id."' ");
					 if($update){
						echo '<script>alert("Ubah data berhasil")</script>';
					    echo '<script>window.location="data-image.php"</script>';
					 }else{
					    echo 'gagal'.mysqli_error($conn);
							   
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
        CKEDITOR.replace('deskripsi');
    </script>
</body>
</html>