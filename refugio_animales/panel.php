<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_pagina();

$consulta = $pdo->prepare("SELECT nombre, apellido, dni, correo, rol FROM usuarios WHERE id = ? AND fecha_archivado IS NULL");
$consulta->execute([$_SESSION["usuario_id"]]);
$usuario = $consulta->fetch();
if (!$usuario) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Mi cuenta | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body>
<header class="navbar"><a class="logo" href="index.php">Huellitas</a><nav><a href="index.php">Volver al index</a><a class="nav-button" href="cerrar_sesion.php">Cerrar sesión</a></nav></header>
<main class="dashboard">
    <span class="eyebrow">ÁREA PERSONAL</span>
    <h1>¡Hola, <?= e($usuario["nombre"]) ?>!</h1>
    <p class="dashboard-intro">Gracias por ser parte de Huellitas, acá podés consultar tus datos.</p>
    <section class="profile-card">
        <h2>Mis datos personales</h2>
        <div class="profile-grid">
            <div><span>Nombre</span><strong><?= e($usuario["nombre"]) ?></strong></div>
            <div><span>Apellido</span><strong><?= e($usuario["apellido"]) ?></strong></div>
            <div><span>DNI</span><strong><?= e($usuario["dni"]) ?></strong></div>
            <div><span>Correo</span><strong><?= e($usuario["correo"]) ?></strong></div>
            <div><span>Tipo de cuenta</span><strong><?= e($usuario["rol"]) ?></strong></div>
        </div>
        <?php if ($usuario["rol"] === "admin"): ?><a class="button button-primary" href="admin_usuarios.php">Ir al panel administrador</a><?php endif; ?>
    </section>
    <section class="help-banner dashboard-help"><div><h2>¡Gracias por ayudar!</h2><p>Cada persona que se suma nos acerca a más finales felices.</p></div><a class="button button-light" href="index.php#adopciones">Ver animales</a></section>
</main>
</body></html>
