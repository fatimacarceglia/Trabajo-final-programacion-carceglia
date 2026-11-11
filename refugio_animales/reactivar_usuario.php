<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_admin();
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id) {
    $consulta = $pdo->prepare("UPDATE usuarios SET fecha_archivado = NULL WHERE id = ?");
    $consulta->execute([$id]);
}
header("Location: usuarios_archivados.php");
exit;
?>
