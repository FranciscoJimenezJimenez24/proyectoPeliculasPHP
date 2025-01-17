<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}
$tipo_video = $_POST['tipo_video'];
$titulo = $_POST['titulo'];
$minuto_duracion = $_POST['minuto_duracion'];
$fecha_estreno = $_POST['fecha_estreno'];

$sql = "INSERT INTO video (titulo, minuto_duracion, fecha_estreno, tipo_video) VALUES ('$titulo', $minuto_duracion, '$fecha_estreno', $tipo_video)"; 
if ($conection->query($sql)) {
    $_SESSION['alert'] = 'Se creo correctamente el video';
    header('Location: ../../home/home.view.php');
    exit();
} else {
    $_SESSION['alert'] = 'Hubo un error al crear el video' . addslashes($conection->error);
    header('Location: ../video.view.php');
    exit();
}
