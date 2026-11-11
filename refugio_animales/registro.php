<?php
require_once "conexion.php";
require_once "funciones.php";

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dni = trim($_POST["dni"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($nombre === "" || $apellido === "" || $dni === "" || $correo === "" || $password === "") {
        $mensaje = "Completá todos los campos.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Ingresá un correo electrónico válido.";
    } elseif (strlen($password) < 6) {
        $mensaje = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        $consulta = $pdo->prepare("SELECT id FROM usuarios WHERE dni = ? OR correo = ?");
        $consulta->execute([$dni, $correo]);
        if ($consulta->fetch()) {
            $mensaje = "Ese DNI o correo ya está registrado.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertar = $pdo->prepare("INSERT INTO usuarios (nombre, apellido, dni, correo, contrasena, rol) VALUES (?, ?, ?, ?, ?, 'usuario')");
            $insertar->execute([$nombre, $apellido, $dni, $correo, $hash]);
            $mensaje = "¡Tu cuenta fue creada! Ya podés iniciar sesión.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Crear cuenta | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body class="form-page">
<div class="form-shell">
    <a class="logo form-logo" href="index.php">Huellitas</a>
    <div class="form-card">
        <span class="eyebrow">BIENVENIDO</span>
        <h1>Crear una cuenta</h1>
        <p>Registrate para formar parte de nuestro refugio.</p>
        <?php if ($mensaje): ?><div class="notice"><?= e($mensaje) ?></div><?php endif; ?>
        <form method="POST" action="registro.php">
            <div class="field-row">
                <label>Nombre<input type="text" name="nombre" required value="<?= e($_POST["nombre"] ?? "") ?>"></label>
                <label>Apellido<input type="text" name="apellido" required value="<?= e($_POST["apellido"] ?? "") ?>"></label>
            </div>
            <label>DNI<input type="text" name="dni" required value="<?= e($_POST["dni"] ?? "") ?>"></label>
            <label>Correo electrónico<input type="email" name="correo" required value="<?= e($_POST["correo"] ?? "") ?>"></label>
            <label>Contraseña<input type="password" name="password" required minlength="6"></label>
            <button class="button button-primary full-button" type="submit">Registrarme</button>
        </form>
        <p class="form-bottom">¿Ya tenés cuenta? <a href="login.php">Iniciá sesión</a></p>
        <a class="back-link" href="index.php">← Volver al inicio</a>
    </div>
</div>
</body></html>
