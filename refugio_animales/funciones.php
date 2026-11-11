<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function proteger_pagina() {
    if (!isset($_SESSION["usuario_id"])) {
        header("Location: login.php");
        exit;
    }
}

function proteger_admin() {
    proteger_pagina();
    if (($_SESSION["rol"] ?? "") !== "admin") {
        header("Location: panel.php");
        exit;
    }
}

function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
}
?>
