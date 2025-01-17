<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = intval($_POST['id']);
$sql = "SELECT a.* FROM actor a JOIN video_actor va ON a.id = va.actor JOIN video v ON va.video = v.id WHERE v.id = $id;";
$result = $conection->query($sql);

if ($result && mysqli_num_rows($result) > 0) {
    $actores = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $actores[] = [
            "id" => $row['id'],
            "nombre" => $row['nombre'],
        ];
    }
    echo json_encode($actores); 
} else {
    $_SESSION['alert'] = 'Hubo un error' . addslashes($conection->error);
    header('Location: ../video.view.php');
    exit();
}

$conection->close();