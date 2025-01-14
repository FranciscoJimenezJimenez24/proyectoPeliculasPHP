<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("localhost", "root", "root", "proyectoPeliculas");
if (!$conection) {
    die(json_encode(["error" => "Error de conexión: " . mysqli_connect_error()])); // Si hay error de conexión
}

// Consulta SQL para obtener todos los actores y sus videos
$sql = "SELECT a.id, a.nombre, GROUP_CONCAT(va.video ORDER BY va.video) AS videos
        FROM actor a
        JOIN video_actor va ON a.id = va.actor
        GROUP BY a.id, a.nombre";

$result = $conection->query($sql);

if ($result && mysqli_num_rows($result) > 0) {
    $actores = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $actores[] = [
            "id" => $row['id'],
            "nombre" => $row['nombre'],
            "videos" => $row['videos']  
        ];
    }
    echo json_encode($actores); 
} else {
    echo json_encode(["error" => "No se encontraron actores o videos asociados."]);
}

$conection->close();
