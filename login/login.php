<?php
session_start();
$user = $_POST['user'];
$pass = $_POST['password'];

$conection = mysqli_connect("localhost", "root", "root", "proyectoPeliculas");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // Escapar las variables para evitar inyección SQL
    $user = $conection->real_escape_string($user);
    $pass = $conection->real_escape_string($pass);
    $sql = "SELECT * FROM usuarios WHERE usuario = '$user' AND password = '$pass'";
    $result = $conection->query($sql);
    if ($result->num_rows > 0) {
        header('Location: ../home/home.view.php');
        exit();  
    } else {
        $sqlUser = "SELECT * FROM usuarios WHERE usuario = '$user'";
        $resultUser = $conection->query($sqlUser);
        if ($resultUser->num_rows > 0) {
            $_SESSION['alert'] = 'Contraseña incorrecta';
            header('Location: ../login/login.view.php');
            exit();  
        } else {
            $_SESSION['alert'] = 'El usuario no existe';
            header('Location: ../register/register.view.php');
            exit();  
        }
    }
}

