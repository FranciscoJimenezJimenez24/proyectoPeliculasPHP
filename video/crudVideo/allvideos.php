<?php
session_start();
header('Content-Type: application/json');

$conection = mysqli_connect("db", "root", "root", "dbname");
if (!$conection) {
    die(json_encode(["error" => "Error de conexión: " . mysqli_connect_error()]));
}
$sql = "SELECT * FROM video";
$result = $conection->query($sql);

if ($result && mysqli_num_rows($result) > 0) {
    $videos = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $videos[] = [
            "id" => $row['id'],
            "titulo" => $row['titulo'],
            "minuto_duracion" => $row['minuto_duracion'],
            "fecha_estreno" => $row['fecha_estreno'],
            "tipo_video" => $row['tipo_video'],
        ];
    }
    echo json_encode($videos);
} else {
    echo json_encode(["error" => "No se encontraron videos para el tipo solicitado."]);
}


$conection->close();
