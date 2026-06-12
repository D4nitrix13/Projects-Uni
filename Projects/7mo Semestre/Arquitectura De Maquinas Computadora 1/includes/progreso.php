<?php

const PROGRESO_ESTUDIANTES_PATH = __DIR__ . "/../storage/progreso/estudiantes.json";
const NOTA_MINIMA_APROBACION = 7;

function asegurarArchivoProgreso(): void
{
    $directorio = dirname(PROGRESO_ESTUDIANTES_PATH);

    if (!is_dir($directorio)) {
        mkdir($directorio, 0775, true);
    }

    if (!file_exists(PROGRESO_ESTUDIANTES_PATH)) {
        file_put_contents(PROGRESO_ESTUDIANTES_PATH, "{}");
    }
}

function leerEstudiantesRegistrados(): array
{
    asegurarArchivoProgreso();

    $contenido = file_get_contents(PROGRESO_ESTUDIANTES_PATH);
    $datos = json_decode($contenido, true);

    return is_array($datos) ? $datos : [];
}

function guardarEstudiantesRegistrados(array $datos): void
{
    asegurarArchivoProgreso();

    $json = json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    if ($json === false) {
        $json = "{}";
    }

    file_put_contents(PROGRESO_ESTUDIANTES_PATH, $json, LOCK_EX);
}

function obtenerNombreModuloPorQuiz(string $quizId): string
{
    $modulos = [
        "unidad1Quiz" => "Unidad I: Introducción a los microprocesadores y microcontroladores",
        "unidad2Quiz" => "Unidad II: Arquitectura del microprocesador",
        "unidad3Quiz" => "Unidad III: Programación del microprocesador",
        "unidad4Quiz" => "Unidad IV: Arquitectura de los microcontroladores",
        "unidad5Quiz" => "Unidad V: Programadores del microcontrolador"
    ];

    return $modulos[$quizId] ?? $quizId;
}

function registrarEstudiante(string $carnet): void
{
    $carnet = strtoupper(trim($carnet));
    $estudiantes = leerEstudiantesRegistrados();

    if (!isset($estudiantes[$carnet])) {
        $estudiantes[$carnet] = [
            "carnet" => $carnet,
            "creado_en" => date("Y-m-d H:i:s"),
            "ultimo_acceso" => date("Y-m-d H:i:s"),
            "modulos_aprobados" => [],
            "puntajes" => []
        ];
    } else {
        $estudiantes[$carnet]["ultimo_acceso"] = date("Y-m-d H:i:s");
    }

    guardarEstudiantesRegistrados($estudiantes);
}

function obtenerProgresoEstudiante(string $carnet): array
{
    $carnet = strtoupper(trim($carnet));
    $estudiantes = leerEstudiantesRegistrados();

    return $estudiantes[$carnet] ?? [
        "carnet" => $carnet,
        "creado_en" => null,
        "ultimo_acceso" => null,
        "modulos_aprobados" => [],
        "puntajes" => []
    ];
}

function obtenerPuntajeQuiz(string $carnet, string $quizId): int
{
    $progreso = obtenerProgresoEstudiante($carnet);

    return (int) ($progreso["puntajes"][$quizId] ?? 0);
}

function quizAprobado(string $carnet, string $quizId, int $minimo = NOTA_MINIMA_APROBACION): bool
{
    return obtenerPuntajeQuiz($carnet, $quizId) >= $minimo;
}

function guardarModuloAprobado(string $carnet, string $quizId, int $puntaje): array
{
    $carnet = strtoupper(trim($carnet));
    $estudiantes = leerEstudiantesRegistrados();

    if (!isset($estudiantes[$carnet])) {
        registrarEstudiante($carnet);
        $estudiantes = leerEstudiantesRegistrados();
    }

    $puntajeAnterior = $estudiantes[$carnet]["puntajes"][$quizId] ?? 0;
    $mejorPuntaje = max((int) $puntajeAnterior, $puntaje);

    $estudiantes[$carnet]["ultimo_acceso"] = date("Y-m-d H:i:s");
    $estudiantes[$carnet]["puntajes"][$quizId] = $mejorPuntaje;

    if ($mejorPuntaje >= NOTA_MINIMA_APROBACION) {
        $estudiantes[$carnet]["modulos_aprobados"][$quizId] = [
            "quiz_id" => $quizId,
            "modulo" => obtenerNombreModuloPorQuiz($quizId),
            "puntaje" => $mejorPuntaje,
            "aprobado_en" => $estudiantes[$carnet]["modulos_aprobados"][$quizId]["aprobado_en"] ?? date("Y-m-d H:i:s"),
            "actualizado_en" => date("Y-m-d H:i:s")
        ];
    }

    guardarEstudiantesRegistrados($estudiantes);

    return $estudiantes[$carnet];
}

function eliminarEstudiante(string $carnet): bool
{
    $carnet = strtoupper(trim($carnet));
    $estudiantes = leerEstudiantesRegistrados();

    if (!isset($estudiantes[$carnet])) {
        return false;
    }

    unset($estudiantes[$carnet]);

    guardarEstudiantesRegistrados($estudiantes);

    return true;
}

function obtenerConfiguracionUnidades(): array
{
    return [
        "unidad1.php" => [
            "nombre" => "Unidad I",
            "current_page" => "unidad1",
            "quiz" => "unidad1Quiz",
            "requisito" => null,
            "redirigir_a" => "/pages/unidad1.php"
        ],
        "unidad2.php" => [
            "nombre" => "Unidad II",
            "current_page" => "unidad2",
            "quiz" => "unidad2Quiz",
            "requisito" => "unidad1Quiz",
            "redirigir_a" => "/pages/unidad1.php"
        ],
        "unidad3.php" => [
            "nombre" => "Unidad III",
            "current_page" => "unidad3",
            "quiz" => "unidad3Quiz",
            "requisito" => "unidad2Quiz",
            "redirigir_a" => "/pages/unidad2.php"
        ],
        "unidad4.php" => [
            "nombre" => "Unidad IV",
            "current_page" => "unidad4",
            "quiz" => "unidad4Quiz",
            "requisito" => "unidad3Quiz",
            "redirigir_a" => "/pages/unidad3.php"
        ],
        "unidad5.php" => [
            "nombre" => "Unidad V",
            "current_page" => "unidad5",
            "quiz" => "unidad5Quiz",
            "requisito" => "unidad4Quiz",
            "redirigir_a" => "/pages/unidad4.php"
        ]
    ];
}

function puedeAccederAUnidad(string $carnet, string $archivoUnidad): bool
{
    $unidades = obtenerConfiguracionUnidades();

    if (!isset($unidades[$archivoUnidad])) {
        return true;
    }

    $requisito = $unidades[$archivoUnidad]["requisito"];

    if ($requisito === null) {
        return true;
    }

    return quizAprobado($carnet, $requisito);
}

function protegerAccesoUnidad(): void
{
    if (!function_exists("estudianteAutenticado") || !estudianteAutenticado()) {
        return;
    }

    $archivoActual = basename(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
    $unidades = obtenerConfiguracionUnidades();

    if (!isset($unidades[$archivoActual])) {
        return;
    }

    $carnet = obtenerCarnetEstudiante();

    if (puedeAccederAUnidad($carnet, $archivoActual)) {
        return;
    }

    $_SESSION["mensaje_bloqueo_unidad"] = "Debes aprobar la unidad anterior con al menos 7/10 para desbloquear este contenido.";

    header("Location: " . $unidades[$archivoActual]["redirigir_a"]);
    exit;
}

function unidadBloqueadaParaEstudiante(string $carnet, string $archivoUnidad): bool
{
    return !puedeAccederAUnidad($carnet, $archivoUnidad);
}
