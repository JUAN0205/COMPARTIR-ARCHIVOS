<?php
session_start();

// Usuarios permitidos
$usuarios = [
    "admin" => password_hash("12345", PASSWORD_BCRYPT),
    "usuario" => password_hash("claveSegura", PASSWORD_BCRYPT)
];

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($usuarios[$usuario]) && password_verify($password, $usuarios[$usuario])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        $error = "⚠️ Usuario o contraseña incorrectos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
        <label>Usuario:</label>
        <input type="text" name="usuario" required> <br>
        <label>Contraseña:</label>
        <input type="password" name="password" required> <br>
        <button type="submit" name="login">Ingresar</button>
    </form>
    <p style="color: red;"><?php echo $error ?? ''; ?></p>
</body>
</html>
