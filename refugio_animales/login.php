<?php
require_once "conexion.php";
require_once "funciones.php";

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    $consulta = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ? AND fecha_archivado IS NULL");
    $consulta->execute([$correo]);
    $usuario = $consulta->fetch();

    if ($usuario && password_verify($password, $usuario["contrasena"])) {
        session_regenerate_id(true);
        $_SESSION["usuario_id"] = $usuario["id"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["apellido"] = $usuario["apellido"];
        $_SESSION["rol"] = $usuario["rol"];
        header("Location: panel.php");
        exit;
    } else {
        $mensaje = "Correo o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Ingresar | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body class="form-page">
<div class="form-shell">
    <a class="logo form-logo" href="index.php">Huellitas</a>
    <div class="form-card">
        <span class="eyebrow">QUÉ BUENO VERTE</span>
        <h1>Iniciar sesión</h1>
        <p>Ingresá a tu cuenta</p>
        <?php if ($mensaje): ?><div class="notice error"><?= e($mensaje) ?></div><?php endif; ?>
        <form method="POST" action="login.php">
            <label>Correo electrónico<input type="email" name="correo" required></label>
            <label>Contraseña<input type="password" name="password" required></label>
            <button class="button button-primary full-button" type="submit">Ingresar</button>
        </form>
        <p class="form-bottom">¿no tenés cuenta? <a href="registro.php">Registrate</a></p>
        <a class="back-link" href="index.php">← Volver al inicio</a>
    </div>
</div>
</body></html>
