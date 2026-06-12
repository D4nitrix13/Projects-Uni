<?php

require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../includes/progreso.php";

header("Content-Type: application/json; charset=utf-8");

function responderJson(array $respuesta, int $codigoHttp = 200): void
{
    http_response_code($codigoHttp);

    echo json_encode(
        $respuesta,
        JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
    );

    exit;
}

try {
    if (!estudianteAutenticado()) {
        responderJson([
            "ok" => false,
            "message" => "No hay estudiante autenticado."
        ], 401);
    }

    $carnet = obtenerCarnetEstudiante();

    if ($carnet === "") {
        responderJson([
            "ok" => false,
            "message" => "No se pudo obtener el carnet del estudiante."
        ], 401);
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $estudiante = obtenerProgresoEstudiante($carnet);

        responderJson([
            "ok" => true,
            "estudiante" => $estudiante
        ]);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $contenido = file_get_contents("php://input");

        if ($contenido === false || trim($contenido) === "") {
            responderJson([
                "ok" => false,
                "message" => "No se recibieron datos."
            ], 400);
        }

        $datos = json_decode($contenido, true);

        if (!is_array($datos)) {
            responderJson([
                "ok" => false,
                "message" => "JSON inválido."
            ], 400);
        }

        $quizId = trim($datos["quizId"] ?? "");
        $score = $datos["score"] ?? null;

        if ($quizId === "") {
            responderJson([
                "ok" => false,
                "message" => "Falta el identificador del quiz."
            ], 400);
        }

        if (!is_numeric($score)) {
            responderJson([
                "ok" => false,
                "message" => "El puntaje no es válido."
            ], 400);
        }

        $score = (int) $score;

        if ($score < 0 || $score > 10) {
            responderJson([
                "ok" => false,
                "message" => "El puntaje debe estar entre 0 y 10."
            ], 400);
        }

        $estudiante = guardarModuloAprobado($carnet, $quizId, $score);

        responderJson([
            "ok" => true,
            "message" => "Progreso guardado correctamente.",
            "estudiante" => $estudiante
        ]);
    }

    responderJson([
        "ok" => false,
        "message" => "Método HTTP no permitido."
    ], 405);
} catch (Throwable $error) {
    responderJson([
        "ok" => false,
        "message" => "Error interno al procesar el progreso.",
        "error" => $error->getMessage()
    ], 500);
}
