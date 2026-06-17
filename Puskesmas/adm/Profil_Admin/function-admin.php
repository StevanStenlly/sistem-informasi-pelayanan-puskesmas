<?php
require '../../koneksi.php';

//Update Data admin
$ambilsemuaadmin = mysqli_query($conn, "SELECT * FROM admin");

$data = mysqli_fetch_array($ambilsemuaadmin);

if (isset($_POST['updateadmin'])) {
    $idad = $_POST['idad'];
    $foto_admin = $_FILES['foto_admin']['name'];
    $path_gambar = "img/" . $data['foto_admin'];

    $username_admin = $_POST['username_admin'];
    $id_admin = $_POST['id_admin'];
    $password_admin = $_POST['password_admin'];

    if (empty($foto_admin)) {

        mysqli_query($conn, "UPDATE admin SET username_admin='$username_admin', password_admin='$password_admin' WHERE id_admin='$idad'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'users-profile.php' </script>";
    } else {

        move_uploaded_file($_FILES['foto_admin']['tmp_name'], 'img/' . $foto_admin);

        mysqli_query($conn, "UPDATE admin SET foto_admin='$foto_admin', username_admin='$username_admin', password_admin='$password_admin' WHERE id_admin='$idad'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'users-profile.php'</script>";
    }
}

//Delete admin
if (isset($_POST['hapusadmin'])) {
    $idad = $_POST['idad'];

    $hapus = mysqli_query($conn, "DELETE FROM admin where id_admin='$idad'");
    if ($hapus) {
        header('location:users-profile.php');
    } else {
        echo 'Gagal';
        header('location:users-profile.php');
    }
}
