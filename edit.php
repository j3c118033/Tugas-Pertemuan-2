<?php include('koneksi.php'); 

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $select = mysqli_query($kon, "SELECT * FROM mahasiswa WHERE id='$id'") or die(mysqli_error($koneksi));

        if (mysqli_num_rows($select) == 0) {
            echo '<div class="alert-warning">ID tidak ada dalam database.<div>';
            exit();
        } else{
            $data = mysqli_fetch_assoc($select);
        }
        $dataolah=explode(', ', $data['olahraga']);
    }
?>

<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<title>Edit Data</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-1" id="mainNav" style="background-color: #F2F3F4;">
		<div class="container">	
		    <a class="navbar-brand" href="#">DatMas</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" 
			data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" 
			aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		
        	<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto my-2 my-lg-0">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Beranda</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="insert.php">Tambah Data</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container" style="margin-top:90px">
		<h2 align="center" style="margin-botton:30px">Edit Mahasiswa</h2>

		<?php
        
        if (isset($_POST['submit'])){
            $nim                        = $_POST['nim'];
            $nama                       = $_POST['nama'];
            $jenis_kelamin              = $_POST['jenis_kelamin'];
            $agama                      = $_POST['agama'];
            $olahraga                   = implode(", ", $_POST['olahraga']);
            $ekstensi_diperbolehkan     = array('png', 'jpg');
            $file_nama                  = $_FILES['nama_file']['name'];
            $x                          = explode('.', $file_nama);
            $ekstensi                   = strtolower(end($x));
            $ukuran                     = $_FILES['nama_file']['size'];
            $file_tmp                   = $_FILES['nama_file']['tmp_name'];

           

            if($file_nama != ""){
                if (in_array($ekstensi, $ekstensi_diperbolehkan) == true) {
                    if ($ukuran < 1044070) {
                        move_uploaded_file($file_tmp, 'file/' . $file_nama);
                        $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga', nama_file='$file_nama' WHERE id='$id'") or die(mysqli_error($koneksi));
                        if ($sql) {
                            echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
                        } else {
                            echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning">UKURAN FILE TERLALU BESAR</div>';
                    }
                } else {
                    echo '<div class="alert alert-warning">EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN</div>';
                }
            }else{
                $sql = mysqli_query($kon, "UPDATE mahasiswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', agama='$agama', olahraga='$olahraga' WHERE id='$id'") or die(mysqli_error($koneksi));
                if ($sql) {
                    echo '<script>alert("Berhasil mengubah data."); document.location="index.php";</script>';
                } else {
                    echo '<div class="alert alert-warning">Gagal melakukan proses ubah data.</div>';
                }
            }
        }
        ?>


		<form action="edit.php?id=<?php echo $id; ?>" method="post">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIM</label>
				<div class="col-sm-10">
					<input type="text" name="nim" class="form-control" size="4" value="<?php echo $data['nim']; ?>" readonly required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Mahasiswa</label>
				<div class="col-sm-10">
					<input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" required>
				</div>
			</div>
            
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-10">
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Laki-laki" <?php if ($data['jenis_kelamin'] == 'Laki-laki') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Laki-laki</label>
					</div>
					<div class="form-check">
						<input type="radio" class="form-check-input" name="jenis_kelamin" value="Perempuan" <?php if ($data['jenis_kelamin'] == 'Perempuan') {
																												echo 'checked';
																											} ?> required>
						<label class="form-check-label">Perempuan</label>
					</div>
				</div>
			</div>

            <div class="form-group row">
                <label class="col-sm-2" for="exampleFormControlSelect1">Agama</label>
                <select class="col-sm-9 form-control" id="exampleFormControlSelect1" name="agama" value="<?php echo $data['agama']; ?>" style="margin-left:15px">
                    <option>Pilih</option>
                    <option>Islam</option>
                    <option>Kristen Katolik</option>
                    <option>Kristen Protestan</option>
                    <option>Hindu</option>
                    <option>Budha</option>
                    <option>Konghucu</option>
                </select>
            </div>
	
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Olahraga</label>
                <div class="col-sm-10">
                <?php $olahraga = $data["olahraga"];?>
                <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Sepak Bola"
                        <?php if (in_array("Sepak Bola", $data)) echo "checked";?>>
                        <label class="form-check-label">
                            Sepak Bola
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Basket"
                        <?php if (in_array("Basket", $data)) echo "checked";?>>
                        <label class="form-check-label">
                            Basket
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Futsal"
                        <?php if (in_array("Futsal", $data)) echo "checked";?>>
                        <label class="form-check-label">
                            Futsal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Renang"
                        <?php if (in_array("Renang", $data)) echo "checked";?>>
                        <label class="form-check-label">
                            Renang
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="olahraga[]" value="Badminton"
                        <?php if (in_array("Badminton", $data)) echo "checked";?>>
                        <label class="form-check-label">
                            Badminton
                        </label>
                    </div>
                </div>
            </div>
			
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">File Upload</label>
				<div class="col-sm-10">
                    <input type="file" name="nama_file">
				</div>
			</div>
			
            <div class="form-group row">
				<label class="col-sm-2 col-form-label">&nbsp;</label>
				<div class="col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="Simpan Data">
					<a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
				</div>
			</div>
		</form>

	</div>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</body>

</html>