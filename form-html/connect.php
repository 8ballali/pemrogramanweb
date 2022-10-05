<?php

    $server_name = "localhost";
    $username = "root";
    $dbname = "mahasiswa";

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $nim = $_POST['nim'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    //Database Connection
    $connect = new mysqli($server_name,$username,'',$dbname);
    if ($connect->error) {
        die('Error connecting to database : ' . $connect->error);
    }else{
        $masukkan = $connect->prepare("Insert into registrations(first_name,last_name,nim,email,gender,password)values(?,?,?,?,?,?)");
        $masukkan->bind_param('ssssss',$first_name,$last_name,$nim,$email,$gender,$hashed_password);
        $masukkan->execute();
        echo "Registration Succesfully";
        $masukkan->close();
        $connect->close();
    }
?>