<?php
session_start();  
$user = $_POST['user'];
$pass = $_POST['password'];
$rpass = $_POST['rpassword'];

$conection = mysqli_connect("db", "root", "test", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    if ($pass != $rpass) {
        $_SESSION['alert'] = 'Las contraseñas no coinciden';
        header('Location: ../register/register.view.php');
        exit(); 
    } else {
        $user = $conection->real_escape_string($user);
        $pass = $conection->real_escape_string($pass);

        $sql = "SELECT * FROM users WHERE user = '$user' AND password = '$pass'";
        $result = $conection->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['alert'] = 'El usuario ya existe';
            header('Location: ../login/login.view.php');
            exit();
        } else {
            $sqlCreate = "INSERT INTO users (user, password) VALUES ('$user', '$pass')";
            if ($conection->query($sqlCreate) === TRUE) {
                $_SESSION['alert'] = 'Registro exitoso';
                header('Location: ../login/login.view.php');
                exit();
            } else {
                $_SESSION['alert'] = 'Error al registrar el usuario';
                header('Location: ../register/register.view.php');
                exit();
            }
        }
    }
}
