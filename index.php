<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Daftar Data Mahasiswa</title>
  </head>
  <body style="margin:20px">

    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-1" id="mainNav" style="background-color: #F2F3F4;">
		<div class="container">	
		    <a class="navbar-brand" href="#">DatMas</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" 
			data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" 
			aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
		
        	<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto my-2 my-lg-0">
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="tampil_data.php">Beranda</a></li>
					<li class="nav-item"><a class="nav-link js-scroll-trigger" href="insert.php">Tambah Data</a></li>
				</ul>
			</div>
		</div>
	</nav>
    <br>
    <br>
    <h2 align="center">Daftar Data Mahasiswa dalam Database</h2>
    <br>
    <button type="button" class="btn btn-info"><a href="insert.php" style="color:white">Tambah Data</a></button>
    <br> <br>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">NIM</th>
            <th scope="col">Nama</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Agama</th>
            <th scope="col">Olahraga Favorite</th>
            <th scope="col">Foto</th>
            <th scope="col">Keterangan</th>
            </tr>
        </thead>
        <tbody>
                <?php
                include "koneksi.php";
                //query ke database SELECT tabel mahasiswa
                $sql = mysqli_query($kon, "SELECT * FROM mahasiswa ORDER BY id ASC") or die(mysqli_error($kon));
                //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                if (mysqli_num_rows($sql) > 0) {
                    //membuat variabel $no untuk menyimpan nomor urut
                    $no = 1;
                    //melakukan perulangan while dengan dari dari query $sql
                    while ($data = mysqli_fetch_assoc($sql)) {
                        //menampilkan data perulangan
                        echo '
						<tr>
							<td>' . $no . '</td>
							<td>' . $data['nim'] . '</td>
							<td>' . $data['nama'] . '</td>
							<td>' . $data['jenis_kelamin'] . '</td>
                            <td>' . $data['agama'] . '</td>
                            <td>' . $data['olahraga'] . '</td>
                            <td><center><img src=' . "file/" . $data['nama_file'] . ' width="70px"></td>
							<td>
								<a href="edit.php?id=' . $data['id'] . '" class="badge badge-primary">Edit</a>
								<a href="delete.php?id=' . $data['id'] . '" class="badge badge-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
							</td>
						</tr>
						';
                        $no++;
                    }
                } 
                ?>
            <tbody>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
