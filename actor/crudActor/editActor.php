<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = intval($_POST['idActor']);
$nombre = $_POST['nombre'];
$obrasAdd = $_POST['obrasAdd'] != "" ? explode(",", $_POST['obrasAdd']) : "";
$obrasDelete = $_POST['obrasDelete'] != "" ? explode(",", $_POST['obrasDelete']) : "";
$sqlUpdate = "UPDATE actor SET nombre = '$nombre' WHERE id = $id";

// consultas DELETE
$sqlDelete = "";
if ($obrasDelete != "") {
    foreach ($obrasDelete as $obra) {
        $sqlDelete .= "DELETE FROM video_actor WHERE actor = $id AND video = $obra; ";
    }
}

// consulta INSERT
$sqlInsert = "INSERT INTO video_actor (actor, video) VALUES ";
$values = [];
if ($obrasAdd != "") {
    foreach ($obrasAdd as $obra) {
        $values[] = "($id, $obra)";
    }
    $sqlInsert .= implode(", ", $values);
}

if ($conection->query($sqlUpdate)) {
    // Si hay una consulta DELETE, ejecutarla
    if ($sqlDelete != "") {
        $conection->query($sqlDelete);
    }

    // Si hay una consulta INSERT, ejecutarla
    if ($sqlInsert != "") {
        $conection->query($sqlInsert);
    }

    $_SESSION['alert'] = 'Se editó correctamente el actor';
    header('Location: ../../home/home.view.php');
    exit();
} else {
    $_SESSION['alert'] = 'Hubo un error al editar el actor: ' . addslashes($conection->error);
    header('Location: ../actor.view.php');
    exit();
}

