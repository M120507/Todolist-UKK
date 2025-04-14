<?php

session_start();

//Bikin koneksi
$c = mysqli_connect('localhost','root','','todolist');

if (!$c) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

//login
if(isset($_POST['login'])){
    //initiati variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($c,"SELECT * FROM user WHERE username='$username' and password='$password' ");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        //jika datanya ditemukan
        //berhasil login

        $_SESSION['login'] = 'True';
        header('location:index.php');
    } else {
        //data tidak ditemukan
        //gagal login
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="login.php"
        </script>
        ';
    }
}


if(isset($_POST['tambahtask'])){
    $namatask = $_POST['task'];
    $prioritas = $_POST['prioritas'];
    $tanggal = $_POST['tanggal'];

    $status = "belum";

    $insert = mysqli_query($c,"insert into tasks (task,prioritas,tanggal,status) values ('$namatask','$prioritas','$tanggal','$status')");

    if($insert){
        header('location:index.php');
    } else {
        echo '
        <script>alert("Gagal menambah task baru");
        window.location.href="index.php";
        </script>
        ';
    }

}

//edit pelanggan
if(isset($_POST['edittask'])){
    $namatask = $_POST['task'];
    $prioritas = $_POST['prioritas'];
    $tanggal = $_POST['tanggal'];
    $id = $_POST['id'];
    $query = mysqli_query($c,"update tasks set task='$namatask', prioritas='$prioritas', tanggal='$tanggal' where id='$id' ");

    if($query){
        header('location:index.php');
    }else{
        echo '
        <script>alert("Gagal");
        window.location.href="index.php"
        </script>
        ';
    }
}


if(isset($_POST['selesai'])){
    $id = $_POST['id'];
    $update = mysqli_query($c,"update tasks set status = 'selesai' where id = '$id'");

    if($update){
        header('location:index.php');
    }else{
        echo '
        <script>alert("Gagal Mengupdate Status");
        window.location.href="index.php";
        </script>;
        ';
    }
}


//hapus pelanggan
if(isset($_POST['hapustask'])){
    $id = $_POST['id'];

    $query = mysqli_query($c,"delete from tasks where id='$id'");
    if($query){
        header('location:index.php');
    }else{
        echo '
        <script>alert("Gagal");
        window.location.href="index.php";
        </script>;
        ';
    }
}

?>