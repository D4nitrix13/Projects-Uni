<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function estudianteAutenticado(): bool
{
    return isset($_SESSION["estudiante_carnet"]) && $_SESSION["estudiante_carnet"] !== "";
}

function obtenerCarnetEstudiante(): string
{
    return $_SESSION["estudiante_carnet"] ?? "";
}

function protegerPagina(): void
{
    $archivoActual = basename($_SERVER["PHP_SELF"]);

    $paginasPublicas = [
        "login.php"
    ];

    if (!in_array($archivoActual, $paginasPublicas, true) && !estudianteAutenticado()) {
        header("Location: /login.php");
        exit;
    }
}

function validarCarnet(string $carnet): bool
{
    return preg_match('/^[0-9]{4}-[0-9]{4}[A-Za-z]$/', $carnet) === 1;
}
