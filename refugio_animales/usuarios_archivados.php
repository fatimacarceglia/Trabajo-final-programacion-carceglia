<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_admin();
$usuarios = $pdo->query("SELECT id, nombre, apellido, dni, correo FROM usuarios WHERE fecha_archivado IS NOT NULL ORDER BY fecha_archivado DESC")->fetchAll();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Usuarios archivados | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body><header class="navbar"><a class="logo" href="index.php">🐾 Huellitas</a><nav><a href="admin_usuarios.php">Usuarios activos</a><a href="cerrar_sesion.php">Cerrar sesión</a></nav></header>
<main class="dashboard wide-dashboard"><span class="eyebrow">ADMINISTRACIÓN</span><h1>Usuarios archivados</h1><p class="dashboard-intro">Podés reactivar una cuenta cuando sea necesario.</p><div class="table-wrap"><table><thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Correo</th><th>Acción</th></tr></thead><tbody>
<?php foreach ($usuarios as $u): ?><tr><td><?= e($u["id"]) ?></td><td><?= e($u["nombre"]) ?></td><td><?= e($u["apellido"]) ?></td><td><?= e($u["dni"]) ?></td><td><?= e($u["correo"]) ?></td><td><a href="reactivar_usuario.php?id=<?= e($u["id"]) ?>">Reactivar</a></td></tr><?php endforeach; ?>
<?php if (!$usuarios): ?><tr><td colspan="6">No hay usuarios archivados.</td></tr><?php endif; ?>
</tbody></table></div></main></body></html>
