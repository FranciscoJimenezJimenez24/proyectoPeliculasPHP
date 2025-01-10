<?php
session_start();
if (isset($_SESSION['alert'])) {
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Opciones de Entretenimiento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Entretenimiento</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-cover text-center py-5">
        <div class="container">
            <h1 class="display-4">¡Elige tu entretenimiento!</h1>
            <p class="lead">Selecciona una de las siguientes opciones para disfrutar de contenido de calidad.</p>
        </div>
    </header>

    <div class="container py-5">
        <div class="row text-center">

            <div class="col-md-4">
                <div class="card option-card shadow-lg border-0">
                    <!-- <img src="https://source.unsplash.com/500x300/?documentary" class="card-img-top" alt="Documentales"> -->
                    <div class="card-body">
                        <h5 class="card-title">Documentales</h5>
                        <p class="card-text">Explora las historias más fascinantes del mundo.</p>
                        <a href="#" id="documentaries" class="btn btn-primary">Ver Documentales</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card option-card shadow-lg border-0">
                    <!-- <img src="https://source.unsplash.com/500x300/?series" class="card-img-top" alt="Series"> -->
                    <div class="card-body">
                        <h5 class="card-title">Series</h5>
                        <p class="card-text">Sumérgete en las mejores series de todos los géneros.</p>
                        <a href="#" id="series" class="btn btn-primary" >Ver Series</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card option-card shadow-lg border-0">
                    <!-- <img src="https://source.unsplash.com/500x300/?movie" class="card-img-top" alt="Películas"> -->
                    <div class="card-body">
                        <h5 class="card-title">Películas</h5>
                        <p class="card-text">Disfruta de las últimas y más populares películas.</p>
                        <a href="#" id="movies" class="btn btn-primary">Ver Películas</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Entretenimiento. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="home.js"></script>
</body>

</html>