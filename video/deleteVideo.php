<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = intval($_POST['idVideo']);
$sqlDelete = "DELETE FROM video WHERE id = $id";
if ($conection->query($sqlDelete)) {
    $_SESSION['alert'] = "El valor del id: $id Se eliminó correctamente el video";
    header('Location: ../home/home.view.php');
    exit();
} else {
    $_SESSION['alert'] = 'Hubo un error al eliminar el video' . addslashes($conection->error);
    header('Location: video.view.php');
    exit();
}