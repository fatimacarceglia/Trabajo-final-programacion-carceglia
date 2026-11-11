<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_admin();

$busqueda = trim($_GET["buscar"] ?? "");
$sql = "SELECT id, nombre, apellido, dni, correo, rol FROM usuarios WHERE fecha_archivado IS NULL";
$parametros = [];
if ($busqueda !== "") {
    $sql .= " AND (nombre LIKE ? OR apellido LIKE ? OR dni LIKE ? OR correo LIKE ?)";
    $buscar = "%$busqueda%";
    $parametros = [$buscar, $buscar, $buscar, $buscar];
}
$sql .= " ORDER BY id DESC";
$consulta = $pdo->prepare($sql);
$consulta->execute($parametros);
$usuarios = $consulta->fetchAll();
?>
<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Administrar usuarios | Huellitas</title><link rel="stylesheet" href="css/estilos.css"></head>
<body><header class="navbar"><a class="logo" href="index.php">Huellitas</a><nav><a href="panel.php">Mi cuenta</a><a class="nav-button" href="cerrar_sesion.php">Cerrar sesión</a></nav></header>
<main class="dashboard wide-dashboard"><span class="eyebrow">ADMINISTRACIÓN</span><h1>Gestión de usuarios</h1><p class="dashboard-intro">Buscá, editá y archivá las cuentas registradas.</p>
<form class="search-form" method="GET"><input type="text" name="buscar" placeholder="Buscar por nombre, DNI o correo..." value="<?= e($busqueda) ?>"><button class="button button-primary" type="submit">Buscar</button><a class="button button-light" href="usuarios_archivados.php">Ver archivados</a></form>
<div class="table-wrap"><table><thead><tr><th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Correo</th><th>Rol</th><th>Acciones</th></tr></thead><tbody>
<?php foreach ($usuarios as $u): ?><tr><td><?= e($u["id"]) ?></td><td><?= e($u["nombre"]) ?></td><td><?= e($u["apellido"]) ?></td><td><?= e($u["dni"]) ?></td><td><?= e($u["correo"]) ?></td><td><?= e($u["rol"]) ?></td><td class="actions"><a href="editar_usuario.php?id=<?= e($u["id"]) ?>">Editar</a><a href="archivar_usuario.php?id=<?= e($u["id"]) ?>" onclick="return confirm('¿Archivar este usuario?')">Archivar</a></td></tr><?php endforeach; ?>
<?php if (!$usuarios): ?><tr><td colspan="7">No se encontraron usuarios.</td></tr><?php endif; ?>
</tbody></table></div></main></body></html>
