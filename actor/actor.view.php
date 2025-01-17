<?php
session_start();
if (!isset($_SESSION['user'])) {
    $_SESSION['alert'] = 'Tiene que iniciar sesión';
    header('Location: ../login/login.view.php');
    exit();
}
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
    <title>Actor</title>
    <link rel="icon" href="../assets/icoFilm.svg" type="image/x-icon">
    <link rel="stylesheet" href="actor.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                        <a class="nav-link" href="../home/home.view.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../home/logout.php">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="table-container">
        <div id="buttons">
            <a id="back" href="../home/home.view.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#007bff"
                    class="bi bi-skip-backward-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M11.729 5.055a.5.5 0 0 0-.52.038L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.271-.445" />
                </svg>
            </a>
            <a id="add">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#007bff" class="bi bi-plus-circle"
                    viewBox="0 0 16 16">
                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1z" />
                    <path d="M8.5 4a.5.5 0 0 0-1 0v3H4a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3V4z" />
                </svg>
            </a>
        </div>
        <table id="tableActores" class="table table-striped table-bordered table-hover"></table>
    </div>


    <div id="overlayEdit" class="ocultoEdit"></div>
    <div id="interfazEdit" class="ocultoEdit">
        <div class="modal-content">
            <form action="crudActor/editActor.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idActor" name="idActor">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="obras">Obras</label>
                        <div class="obras"></div>
                        <input type="hidden" name="obrasAdd" id="obrasAdd">
                        <input type="hidden" name="obrasDelete" id="obrasDelete">
                    </div>
                    <div class="form-group">
                        <input type="text" id="search" onkeyup="buscar(this)">
                        <ul id="resultados"></ul>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" id="cerrarInterfazBtnEdit">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <div id="overlayCreate" class="ocultoCreate"></div>
    <div id="interfazCreate" class="ocultoCreate">
        <div class="modal-content">
            <form action="crudActor/addActor.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="idActor" name="idActor">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="obrasAnadir">Obras</label>
                        <div class="obrasAnadir"></div>
                        <input type="hidden" name="obrasAnadir" id="obrasAnadir">
                    </div>
                    <div class="form-group">
                        <input type="text" id="search" onkeyup="buscarAdd(this)">
                        <ul id="resultadosAdd"></ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" id="cerrarInterfazBtnCreate">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2025 Entretenimiento. Todos los derechos reservados.</p>
    </footer>

    <script src="actor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        crossorigin="anonymous"></script>
</body>

</html>