<?php
session_start();
if (isset($_SESSION['alert'])) {
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="detailVideo.css">
    <title>Document</title>
</head>

<body>
    <div id="actores"></div>
    <button id="button">Volver</button>
    <script src="detailVideo.js"></script>
</body>

</html>