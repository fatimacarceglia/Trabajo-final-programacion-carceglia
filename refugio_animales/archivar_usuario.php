<?php
require_once "conexion.php";
require_once "funciones.php";
proteger_admin();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
if ($id && $id != $_SESSION["usuario_id"]) {
    $consulta = $pdo->prepare("UPDATE usuarios SET fecha_archivado = NOW() WHERE id = ? AND fecha_archivado IS NULL");
    $consulta->execute([$id]);
}
header("Location: admin_usuarios.php");
exit;
?>
