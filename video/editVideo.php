<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("localhost", "root", "root", "proyectoPeliculas");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = intval($_POST['idVideo']);
$titulo = $_POST['titulo'];
$minuto_duracion = $_POST['minuto_duracion'];
$fecha_estreno = $_POST['fecha_estreno'];
$sqlUpdate = "UPDATE video SET titulo = '$titulo', minuto_duracion = $minuto_duracion, fecha_estreno = '$fecha_estreno' WHERE id = $id";
if ($conection->query($sqlUpdate)) {
    $_SESSION['alert'] = 'Se editó correctamente el video';
    header('Location: ../home/home.view.php');
    exit();
} else {
    $_SESSION['alert'] = 'Hubo un error al editar el video' . addslashes($conection->error);
    header('Location: video.view.php');
    exit();
}
