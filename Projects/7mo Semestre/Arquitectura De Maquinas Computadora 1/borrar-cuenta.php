<?php

ob_start();

require_once __DIR__ . "/includes/session.php";
require_once __DIR__ . "/includes/progreso.php";

if (!estudianteAutenticado()) {
    header("Location: login.php");
    exit;
}

$carnetEstudiante = obtenerCarnetEstudiante();
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $confirmacionCarnet = strtoupper(trim($_POST["confirmacion_carnet"] ?? ""));

    if ($confirmacionCarnet !== $carnetEstudiante) {
        $error = "El carnet ingresado no coincide con tu carnet actual.";
    } else {
        eliminarEstudiante($carnetEstudiante);

        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                "",
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();

        header("Location: login.php?cuenta_eliminada=1");
        exit;
    }
}

$currentPage = "borrar-cuenta";
?>

<?php require_once __DIR__ . "/includes/header.php"; ?>

<main>
    <section class="page-hero delete-account-hero">
        <span class="badge badge-danger">Zona de peligro</span>

        <h1>Borrar cuenta</h1>

        <p>
            Esta acción eliminará tu cuenta local de estudiante y todo tu progreso guardado.
            Para confirmar, escribí exactamente tu carnet universitario.
        </p>
    </section>

    <section class="section section-alt">
        <div class="delete-account-card">
            <div class="danger-note">
                <h2>Advertencia importante</h2>

                <p>
                    Se eliminará permanentemente el progreso asociado al carnet:
                    <strong><?php echo htmlspecialchars($carnetEstudiante, ENT_QUOTES, "UTF-8"); ?></strong>
                </p>

                <p>
                    Esta acción no se puede deshacer. Si volvés a iniciar sesión con el mismo carnet,
                    tu progreso empezará desde cero.
                </p>
            </div>

            <?php if ($error !== ""): ?>
                <div class="auth-alert">
                    <?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="auth-form delete-account-form" autocomplete="off">
                <label for="confirmacion_carnet">
                    Escribí tu carnet para confirmar
                </label>

                <input
                    type="text"
                    id="confirmacion_carnet"
                    name="confirmacion_carnet"
                    placeholder="<?php echo htmlspecialchars($carnetEstudiante, ENT_QUOTES, "UTF-8"); ?>"
                    required>

                <small>
                    Debe coincidir exactamente con tu carnet actual:
                    <strong><?php echo htmlspecialchars($carnetEstudiante, ENT_QUOTES, "UTF-8"); ?></strong>
                </small>

                <div class="delete-actions">
                    <a href="index.php" class="btn btn-light">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-danger">
                        Sí, borrar mi cuenta
                    </button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>