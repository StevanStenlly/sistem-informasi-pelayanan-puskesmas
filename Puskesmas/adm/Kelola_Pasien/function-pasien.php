<?php

//Menambah data pasien
if (isset($_POST['addnewpasien'])) {
    $foto_pasien = $_FILES['foto_pasien']['name'];

    $file_extension = array('png', 'jpg', 'jpeg', 'gif');
    $extension = pathinfo($foto_pasien, PATHINFO_EXTENSION);
    $size_gambar = $_FILES['foto_pasien']['size'];


    $nama_pasien = $_POST['nama_pasien'];
    $jk_pasien = $_POST['jk_pasien'];
    $agama_pasien = $_POST['agama_pasien'];
    $nik_pasien = $_POST['nik_pasien'];
    $status_pernikahan_pasien = $_POST['status_pernikahan_pasien'];
    $alamat_pasien = $_POST['alamat_pasien'];
    $no_hp_pasien = $_POST['no_hp_pasien'];
    $password_pasien = $_POST['password_pasien'];
    $riwayat_alergi_pasien = $_POST['riwayat_alergi_pasien'];
    $pekerjaan_pasien = $_POST['pekerjaan_pasien'];
    $tempat_lahir_pasien = $_POST['tempat_lahir_pasien'];
    $tgl_lahir_pasien = $_POST['tgl_lahir_pasien'];
    $bpjs = $_POST['bpjs'];

    $query = mysqli_query($conn, "SELECT nik_pasien FROM pasien WHERE nik_pasien = '$nik_pasien'");

    if ($query->num_rows > 0) {
        echo "<script>alert('NIK sudah terdaftar');</script>";
    } else {
        if (!in_array($extension, $file_extension)) {
            echo "<script>alert('File Tidak Didukung!'); location = 'tabel-pasien.php'</script>";
        } else {


            move_uploaded_file($_FILES['foto_pasien']['tmp_name'], 'img/' . $foto_pasien);

            mysqli_query($conn, "INSERT into pasien (nik_pasien, foto_pasien, nama_pasien, jk_pasien, agama_pasien, status_pernikahan_pasien, 
            alamat_pasien, no_hp_pasien, password_pasien, riwayat_alergi_pasien, pekerjaan_pasien, tgl_lahir_pasien, tempat_lahir_pasien, bpjs) 
            VALUES ('$nik_pasien', '$foto_pasien', '$nama_pasien', '$jk_pasien', '$agama_pasien', '$status_pernikahan_pasien', '$alamat_pasien', 
            '$no_hp_pasien', '$password_pasien', '$riwayat_alergi_pasien', '$pekerjaan_pasien', '$tgl_lahir_pasien', '$tempat_lahir_pasien', '$bpjs')");

            echo "<script>alert('Data Berhasil di Tambahkan'); location = 'tabel-pasien.php'</script>";
        }
    }
}

//Update Data pasien
$ambilsemuapasien = mysqli_query($conn, "SELECT * FROM pasien");

$data = mysqli_fetch_array($ambilsemuapasien);

if (isset($_POST['updatepasien'])) {
    $idps = $_POST['idps'];
    $foto_pasien = $_FILES['foto_pasien']['name'];
    $path_gambar = "img/" . $data['foto_pasien'];

    $nama_pasien = $_POST['nama_pasien'];
    $jk_pasien = $_POST['jk_pasien'];
    $agama_pasien = $_POST['agama_pasien'];
    $nik_pasien = $_POST['nik_pasien'];
    $status_pernikahan_pasien = $_POST['status_pernikahan_pasien'];
    $alamat_pasien = $_POST['alamat_pasien'];
    $no_hp_pasien = $_POST['no_hp_pasien'];
    $password_pasien = $_POST['password_pasien'];
    $riwayat_alergi_pasien = $_POST['riwayat_alergi_pasien'];
    $pekerjaan_pasien = $_POST['pekerjaan_pasien'];
    $tempat_lahir_pasien = $_POST['tempat_lahir_pasien'];
    $tgl_lahir_pasien = $_POST['tgl_lahir_pasien'];
    $bpjs = $_POST['bpjs'];

    if (empty($foto_pasien)) {

        mysqli_query($conn, "UPDATE pasien SET nama_pasien='$nama_pasien', jk_pasien='$jk_pasien', agama_pasien='$agama_pasien', nik_pasien='$nik_pasien',
        status_pernikahan_pasien='$status_pernikahan_pasien', alamat_pasien='$alamat_pasien', no_hp_pasien='$no_hp_pasien', password_pasien='$password_pasien', 
        tempat_lahir_pasien='$tempat_lahir_pasien', tgl_lahir_pasien='$tgl_lahir_pasien', bpjs='$bpjs', riwayat_alergi_pasien='$riwayat_alergi_pasien', pekerjaan_pasien='$pekerjaan_pasien' 
        WHERE nik_pasien='$idps'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'detail-pasien.php?nik_pasien=$nik_pasien'; </script>";
    } else {

        move_uploaded_file($_FILES['foto_pasien']['tmp_name'], 'img/' . $foto_pasien);

        mysqli_query($conn, "UPDATE pasien SET foto_pasien='$foto_pasien', nama_pasien='$nama_pasien', jk_pasien='$jk_pasien', agama_pasien='$agama_pasien', 
        nik_pasien='$nik_pasien', status_pernikahan_pasien='$status_pernikahan_pasien', alamat_pasien='$alamat_pasien', no_hp_pasien='$no_hp_pasien', password_pasien='$password_pasien', 
        tempat_lahir_pasien='$tempat_lahir_pasien', tgl_lahir_pasien='$tgl_lahir_pasien', bpjs='$bpjs', riwayat_alergi_pasien='$riwayat_alergi_pasien', pekerjaan_pasien='$pekerjaan_pasien' WHERE nik_pasien='$idps'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'detail-pasien.php?nik_pasien=$nik_pasien'</script>";
    }
}

//Delete pasien
if (isset($_POST['hapuspasien'])) {
    $idps = $_POST['idps'];

    $hapus = mysqli_query($conn, "DELETE FROM pasien where nik_pasien='$idps'");
    if ($hapus) {
        header('location:tabel-pasien.php');
    } else {
        echo 'Gagal';
        header('location:tabel-pasien.php');
    }
}
