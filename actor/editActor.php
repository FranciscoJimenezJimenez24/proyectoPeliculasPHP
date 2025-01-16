<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = intval($_POST['idActor']);
$nombre = $_POST['nombre'];
$obrasFinal = $_POST['obrasFinal'];
$sqlUpdate = "UPDATE actor SET nombre = '$nombre' WHERE id = $id";
$arrayObras = explode(",", $obrasFinal);

// consultas DELETE
$sqlDelete = "";
foreach ($arrayObras as $obra) {
    $sqlDelete .= "DELETE FROM video_actor WHERE actor = $id AND video = $obra; ";
}

// consulta INSERT
$sqlInsert = "INSERT INTO video_actor (actor, video) VALUES ";
$values = [];
foreach ($arrayObras as $obra) {
    $values[] = "($id, $obra)";
}
$sqlInsert .= implode(", ", $values);

if ($conection->query($sqlUpdate) && $conection->query($sqlDelete) && $conection->query($sqlInsert)) {
    $_SESSION['alert'] = 'Se editó correctamente el actor';
    header('Location: ../home/home.view.php');
    exit();
} else {
    $_SESSION['alert'] = 'Hubo un error al editar el actor: ' . addslashes($conection->error);
    header('Location: video.view.php');
    exit();
}

