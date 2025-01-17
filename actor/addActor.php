<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("localhost", "root", "root", "proyectoPeliculas");

if (!$conection) {
    die("Connection failed: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$obrasAdd = $_POST['obrasAnadir'] != "" ? explode(",", $_POST['obrasAnadir']) : "";

$sqlInsertActor = "INSERT INTO actor (nombre) VALUES ('$nombre')";

if ($conection->query($sqlInsertActor)) {
    // Recupera el ID del actor recién insertado
    $id = mysqli_insert_id($conection);  

    if ($obrasAdd != "") {
        $sqlInsertVideoActor = "INSERT INTO video_actor (actor, video) VALUES ";
        $values = [];

        foreach ($obrasAdd as $obra) {
            $values[] = "($id, " . (int)$obra . ")";  
        }

        // Unimos todos los valores con coma para crear una sola consulta
        $sqlInsertVideoActor .= implode(", ", $values);

        // Ejecuta la consulta para insertar las relaciones en video_actor
        if ($conection->query($sqlInsertVideoActor)) {
            $_SESSION['alert'] = 'Se añadió correctamente el actor y sus obras';
            header('Location: ../home/home.view.php');
            exit();
        } else {
            $_SESSION['alert'] = 'Hubo un error al añadir las obras: ' . addslashes($conection->error);
            header('Location: video.view.php');
            exit();
        }
    } else {
        $_SESSION['alert'] = 'Se añadió correctamente el actor, pero no se añadieron obras. El array: '. $obrasAdd. " el post: ".$_POST['obrasAnadir'];
        header('Location: ../home/home.view.php');
        exit();
    }
} else {
    $_SESSION['alert'] = 'Hubo un error al añadir el actor: ' . addslashes($conection->error);
    header('Location: video.view.php');
    exit();
}
?>
