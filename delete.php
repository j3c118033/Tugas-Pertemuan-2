<form>
<?php
    include "koneksi.php";
    $r = mysqli_query($kon,"SELECT * FROM mahasiswa WHERE id=".$_GET["id"]);
    $brs = mysqli_fetch_assoc($r);
    echo "Apakah Anda yakin akan menghapus nama ".$brs['nama']." dari tabel?";
?>

    <input type="hidden" name="idDelete" value="<?php echo $_GET["id"]; ?>">
    <input type="submit" name="jawaban" value="ya">
    <input type="submit" name="jawaban" value="tidak">
</form>

<?php
    if(isset($_GET['jawaban'])){
        if($_GET['jawaban']=="tidak")
            header("location:index.php");
        else{
            $r = mysqli_query($kon,"DELETE FROM `mahasiswa` WHERE `id` = ".$_GET['idDelete']);
            header("location:index.php");
            
        }
            
    }
?>