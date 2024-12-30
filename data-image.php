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
        max-width: 1200px;
        margin: auto;
        padding: 0 20px;
    }

    .box {
        background: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .box h3 {
        color: #333;
        margin-bottom: 20px;
    }

    .box p a {
        display: inline-block;
        padding: 10px 20px;
        background: #4F46E5;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 20px;
        transition: 0.3s;
    }

    .box p a:hover {
        background: #6366F1;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }

    .table th, .table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .table th {
        background: #4F46E5;
        color: #fff;
        font-weight: 500;
    }

    .table tr:hover {
        background: #f9f9f9;
    }

    .table td a {
        color: #4F46E5;
        text-decoration: none;
        margin: 0 5px;
    }

    .table td a:hover {
        text-decoration: underline;
    }

    .table img {
        border-radius: 5px;
        transition: transform 0.3s;
    }

    .table img:hover {
        transform: scale(1.1);
    }

    footer {
        background: rgba(0, 0, 0, 0.8);
        color: #fff;
        padding: 20px 0;
        text-align: center;
        position: relative;
        bottom: 0;
        width: 100%;
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
            <h3>Data Galeri Karya Mahasiswa</h3>
            <div class="box">
                <p><a href="tambah-image.php"><i class="fas fa-plus"></i> Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                           <th width="60px">No</th>
                           <th>Kategori</th>
                           <th>Nama User</th>
                           <th>Nama Karya</th>
                           <th>Deskripsi</th>
                           <th>Gambar</th>
                           <th>Status</th>
                           <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						    $no = 1;
							$user = $_SESSION['a_global']->admin_id;
                            $foto = mysqli_query($conn, "SELECT * FROM tb_image WHERE admin_id = '$user' ");
							if(mysqli_num_rows($foto) >0 ){
							while($row = mysqli_fetch_array($foto)){
						?>
                        <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $row['category_name'] ?></td>
                           <td><?php echo $row['admin_name'] ?></td>
                           <td><?php echo $row['image_name'] ?></td>
                           <td><?php echo $row['image_description']?></td>
                           <td><a href="foto/<?php echo $row['image']?>" target="_blank"><img src="foto/<?php echo $row['image']?>" width="50px"></a></td>
                           <td><?php echo ($row['image_status'] == 0)? '<span style="color: #dc2626">Tidak Aktif</span>':'<span style="color: #16a34a">Aktif</span>'; ?></td>
                           <td>
                              <a href="edit-image.php?id=<?php echo $row['image_id'] ?>"><i class="fas fa-edit"></i> Edit</a> || 
                              <a href="proses-hapus.php?idp=<?php echo $row['image_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')" style="color: #dc2626"><i class="fas fa-trash"></i> Hapus</a>
                           </td>
                        </tr>
                        <?php }}else{ ?>
                             <tr>
                                <td colspan="8" style="text-align: center">Tidak ada data</td>
                             </tr>
                        <?php } ?>
                    </tbody>
                </table>
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