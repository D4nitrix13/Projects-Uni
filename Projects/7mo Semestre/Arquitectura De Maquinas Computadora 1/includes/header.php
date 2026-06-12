<?php
require_once __DIR__ . "/session.php";
require_once __DIR__ . "/progreso.php";

protegerPagina();
protegerAccesoUnidad();

$basePath = "";

if (
    str_contains($_SERVER["PHP_SELF"], "/pages/") ||
    str_contains($_SERVER["PHP_SELF"], "/tutoriales/") ||
    str_contains($_SERVER["PHP_SELF"], "/practicas/") ||
    str_contains($_SERVER["PHP_SELF"], "/simulador/")
) {
    $basePath = "../";
}

$mensajeBloqueoUnidad = $_SESSION["mensaje_bloqueo_unidad"] ?? "";
unset($_SESSION["mensaje_bloqueo_unidad"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Arquitectura de Máquinas"; ?>
    </title>

    <link rel="stylesheet" href="<?php echo $basePath; ?>assets/css/styles.css">
</head>

<body>

    <?php if ($mensajeBloqueoUnidad !== ""): ?>
        <div class="unit-block-alert">
            <?php echo htmlspecialchars($mensajeBloqueoUnidad); ?>
        </div>
    <?php endif; ?>