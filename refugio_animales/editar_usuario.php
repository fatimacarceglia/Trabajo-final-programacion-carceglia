<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_admin();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if (!$id) { header("Location: admin_usuarios.php"); exit; }

$consulta = $pdo->prepare("SELECT id, nombre, apellido, dni, correo, rol FROM usuarios WHERE id = ? AND fecha_archivado IS NULL");
$consulta->execute([$id]);
$usuario = $consulta->fetch();
if (!$usuario) { header("Location: admin_usuarios.php"); exit; }

$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $apellido = trim($_POST["apellido"] ?? "");
    $dni = trim($_POST["dni"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $rol = $_POST["rol"] ?? "usuario";

    if ($nombre === "" || $apellido === "" || $dni === "" || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !in_array($rol, ["usuario", "admin"], true)) {
        $mensaje = "Revisá los datos ingresados.";
    } else {
        $duplicado = $pdo->prepare("SELECT id FROM usuarios WHERE (dni = ? OR correo = ?) AND id <> ?");
        $duplicado->execute([$dni, $correo, $id]);
        if ($duplicado->fetch()) {
            $mensaje = "Ese DNI o correo ya pertenece a otra cuenta.";
        } else {
            $actualizar = $pdo->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, dni = ?, correo = ?, rol = ? WHERE id = ?");
            $actualizar->execute([$nombre, $apellido, $dni, $correo, $rol, $id]);
            header("Location: admin_usuarios.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Editar usuario | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body class="form-page"><div class="form-shell"><div class="form-card"><span class="eyebrow">ADMINISTRACIÓN</span><h1>Editar usuario</h1><?php if ($mensaje): ?><div class="notice error"><?= e($mensaje) ?></div><?php endif; ?>
<form method="POST"><label>Nombre<input name="nombre" required value="<?= e($_POST["nombre"] ?? $usuario["nombre"]) ?>"></label><label>Apellido<input name="apellido" required value="<?= e($_POST["apellido"] ?? $usuario["apellido"]) ?>"></label><label>DNI<input name="dni" required value="<?= e($_POST["dni"] ?? $usuario["dni"]) ?>"></label><label>Correo<input type="email" name="correo" required value="<?= e($_POST["correo"] ?? $usuario["correo"]) ?>"></label><label>Rol<select name="rol"><option value="usuario" <?= ($usuario["rol"] === "usuario" ? "selected" : "") ?>>Usuario</option><option value="admin" <?= ($usuario["rol"] === "admin" ? "selected" : "") ?>>Administrador</option></select></label><button class="button button-primary full-button">Guardar cambios</button></form><a class="back-link" href="admin_usuarios.php">← Volver a usuarios</a></div></div></body></html>
