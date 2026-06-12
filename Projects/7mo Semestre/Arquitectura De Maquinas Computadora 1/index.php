<?php
$pageTitle = "Inicio | Arquitectura de Máquinas";
$currentPage = "inicio";
require_once __DIR__ . "/includes/header.php";
require_once __DIR__ . "/includes/navbar.php";

$carnetEstudiante = obtenerCarnetEstudiante();
$unidades = obtenerConfiguracionUnidades();

function estadoUnidadIndex(string $carnet, string $archivo, array $unidad): array
{
    $puntaje = obtenerPuntajeQuiz($carnet, $unidad["quiz"]);
    $bloqueada = unidadBloqueadaParaEstudiante($carnet, $archivo);
    $aprobada = $puntaje >= NOTA_MINIMA_APROBACION;

    if ($aprobada) {
        return [
            "texto" => "Aprobada",
            "clase" => "unit-status-approved",
            "detalle" => "Puntaje: {$puntaje}/10",
            "bloqueada" => false
        ];
    }

    if ($bloqueada) {
        return [
            "texto" => "Bloqueada",
            "clase" => "unit-status-locked",
            "detalle" => "Aprueba la unidad anterior con mínimo 7/10 para desbloquearla.",
            "bloqueada" => true
        ];
    }

    return [
        "texto" => "Disponible",
        "clase" => "unit-status-available",
        "detalle" => "Realiza el cuestionario para aprobarla.",
        "bloqueada" => false
    ];
}

function descripcionUnidadIndex(string $archivo): string
{
    return match ($archivo) {
        "unidad1.php" => "Introducción a los microprocesadores y microcontroladores.",
        "unidad2.php" => "Arquitectura del microprocesador y conexión con dispositivos.",
        "unidad3.php" => "Programación del microprocesador usando lenguaje ensamblador.",
        "unidad4.php" => "Arquitectura de los microcontroladores y tipos principales.",
        "unidad5.php" => "Programación de microcontroladores, instrucciones y herramientas.",
        default => "Contenido educativo de arquitectura de máquinas."
    };
}
?>

<main>
    <section class="hero">
        <div class="hero-content">
            <span class="badge">Proyecto Final AMC</span>
            <h1>Web Educativa de Arquitectura de Computadoras</h1>
            <p>
                Aprende los fundamentos de los microprocesadores, microcontroladores,
                programación en EMU8086 y simulación de Arduino con Tinkercad.
            </p>

            <div class="hero-actions">
                <a href="pages/unidad1.php" class="btn btn-primary">
                    Comenzar curso
                </a>
            </div>
        </div>

        <div class="hero-card">
            <h3>Tu progreso</h3>

            <ul class="progress-list">
                <?php foreach ($unidades as $archivo => $unidad): ?>
                    <?php $estado = estadoUnidadIndex($carnetEstudiante, $archivo, $unidad); ?>

                    <li>
                        <span><?php echo htmlspecialchars($unidad["nombre"]); ?></span>
                        <strong class="<?php echo $estado["clase"]; ?>">
                            <?php echo htmlspecialchars($estado["texto"]); ?>
                        </strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Unidades</span>
            <h2>Temario del proyecto</h2>
            <p>
                Las unidades se desbloquean en orden. Para avanzar necesitas aprobar
                el cuestionario de la unidad anterior con una nota mínima de 7/10.
            </p>
        </div>

        <div class="cards-grid">
            <?php foreach ($unidades as $archivo => $unidad): ?>
                <?php
                $estado = estadoUnidadIndex($carnetEstudiante, $archivo, $unidad);
                $href = "pages/" . $archivo;
                ?>

                <article class="card unit-card-index <?php echo $estado["bloqueada"] ? 'unit-card-locked' : ''; ?>">
                    <div class="unit-card-top">
                        <h3><?php echo htmlspecialchars($unidad["nombre"]); ?></h3>

                        <span class="unit-status <?php echo $estado["clase"]; ?>">
                            <?php echo htmlspecialchars($estado["texto"]); ?>
                        </span>
                    </div>

                    <p>
                        <?php echo htmlspecialchars(descripcionUnidadIndex($archivo)); ?>
                    </p>

                    <small class="unit-card-detail">
                        <?php echo htmlspecialchars($estado["detalle"]); ?>
                    </small>

                    <?php if ($estado["bloqueada"]): ?>
                        <button type="button"
                            class="unit-card-link-disabled"
                            disabled
                            aria-disabled="true"
                            title="Unidad bloqueada. Debes aprobar la unidad anterior.">
                            Bloqueada 🔒
                        </button>
                    <?php else: ?>
                        <a href="<?php echo $href; ?>">
                            Ver unidad
                        </a>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Práctica</span>
            <h2>Tutoriales obligatorios</h2>
            <p>
                Se incluyen guías paso a paso para instalar y usar EMU8086,
                además de una introducción práctica a Arduino con Tinkercad.
            </p>
        </div>

        <div class="cards-grid two-columns">
            <article class="card featured-card">
                <h3>Tutorial de EMU8086</h3>
                <p>
                    Aprende a descargar, instalar y utilizar EMU8086 para ejecutar
                    programas básicos en lenguaje ensamblador.
                </p>
                <a href="tutoriales/emu8086.php" class="btn btn-primary">
                    Abrir tutorial
                </a>
            </article>

            <article class="card featured-card">
                <h3>Tutorial de Arduino</h3>
                <p>
                    Aprende a usar Tinkercad Circuits para simular proyectos con
                    Arduino UNO, LEDs, botones y código básico.
                </p>
                <a href="tutoriales/arduino-tinkercad.php" class="btn btn-primary">
                    Abrir tutorial
                </a>
            </article>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>