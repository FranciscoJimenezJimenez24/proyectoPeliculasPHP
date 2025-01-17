<?php
session_start();
if (isset($_SESSION['alert'])) {
    // Mostramos el mensaje en un alert de JavaScript
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    // Limpiamos el mensaje después de mostrarlo
    unset($_SESSION['alert']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../assets/icoFilm.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
                Login Here
            </div>
            <div class="card-body">
                <form method="post" action="login.php">
                    <div class="mb-3">
                        <label for="user" class="form-label">User</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <p>You don't have an account? Register <a href="../register/register.view.php">here</a></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>