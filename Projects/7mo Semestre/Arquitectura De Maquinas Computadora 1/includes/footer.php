<?php
require_once __DIR__ . "/session.php";

$basePath = "";

if (
    str_contains($_SERVER["PHP_SELF"], "/pages/") ||
    str_contains($_SERVER["PHP_SELF"], "/tutoriales/") ||
    str_contains($_SERVER["PHP_SELF"], "/practicas/") ||
    str_contains($_SERVER["PHP_SELF"], "/simulador/")
) {
    $basePath = "../";
}
?>

<footer class="footer">
    <div>
        <h3>Arquitectura de Máquinas</h3>
        <p>
            Proyecto educativo sobre microprocesadores, microcontroladores,
            EMU8086 y Arduino.
        </p>
    </div>

    <p class="footer-copy">
        Proyecto Final AMC &copy; <?php echo date("Y"); ?>
    </p>
</footer>

<script src="<?php echo $basePath; ?>assets/js/main.js"></script>

<?php if (estudianteAutenticado()): ?>
    <script src="<?php echo $basePath; ?>assets/js/progreso.js"></script>
<?php endif; ?>

</body>

</html>