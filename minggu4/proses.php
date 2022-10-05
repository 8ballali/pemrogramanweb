<?php
    
    $server_name = "localhost";
    $username = "root";
    $dbname = "maba";

    $nim = $_POST['fnim'];
    $nama = $_POST['fnama'];
    $tanggal_lahir = $_POST['ftgllhr'];
    $prodi = $_POST['fprodi'];
    $bidang_minat = $_POST['fminat'];
    $bidang_minat_str = implode(" , ",$bidang_minat);
    $secret_code = $_POST['secret_code'];
    $hashed_code = password_hash($secret_code, PASSWORD_DEFAULT);

    $directory = "proposal/";
    $file_name = $_FILES['proposal']['name'];
    move_uploaded_file($_FILES['proposal']['tmp_name'], $directory.$file_name);

    $connect = new mysqli($server_name,$username,'',$dbname);
    if ($connect->error) {
        die('Error connecting to database : ' . $connect->error);
    }else{
        $masukkan_data = $connect->prepare("Insert into mahasiswa(nim,nama,tanggal_lahir,program_studi,bidang_minat,secret_code,proposal)values(?,?,?,?,?,?,?)");
        $masukkan_data->bind_param('sssssss',$nim,$nama,$tanggal_lahir,$prodi,$bidang_minat_str,$hashed_code,$file_name);
        $masukkan_data->execute();
        echo "Insert Data Succesfully";
        $masukkan_data->close();
        $connect->close();
    }

?>
