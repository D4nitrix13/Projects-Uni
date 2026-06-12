<?php
$pageTitle = "Simulador Arduino — Arquitectura de Máquinas";
$currentPage = "simulador";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<link rel="stylesheet" href="<?php echo $basePath; ?>simulador/style.css">

<section class="page-hero sim-page-hero">
  <span class="badge">Simulador interactivo</span>
  <h1>Simulador Arduino UNO R3</h1>
  <p>
    Arrastra componentes, conecta cables y simula circuitos electrónicos
    directamente en el navegador. Selecciona un ejemplo o construye tu propio
    diseño.
  </p>

  <div class="hero-actions">
    <a href="<?php echo $basePath; ?>tutoriales/arduino-tinkercad.php" class="btn btn-primary">
      Ver tutorial de Arduino
    </a>
    <a href="<?php echo $basePath; ?>practicas/arduino-practicas.php" class="btn btn-secondary">
      Prácticas Arduino
    </a>
    <a href="<?php echo $basePath; ?>practicas/emu8086-practicas.php" class="btn btn-secondary">
      Prácticas EMU8086
    </a>
  </div>
</section>

<div class="sim-subtoolbar">
  <span class="subtoolbar-label">⚡ Simulador Arduino UNO</span>

  <select class="sim-select" id="example-select">
    <option value="" disabled selected>— Cargar ejemplo —</option>
    <option value="0">LED Encendido</option>
    <option value="1">LED Parpadeante</option>
    <option value="2">LED con Pulsador</option>
  </select>

  <button class="sim-btn sim-btn-success" id="btn-simulate">▶ Simular</button>
  <button class="sim-btn sim-btn-danger" id="btn-clear">✕ Limpiar</button>
</div>

<main class="sim-main">
  <aside class="sim-palette">
    <div class="palette-title">Componentes</div>

    <div class="palette-item" data-component="led" title="Arrastrar LED a la protoboard">
      <div class="palette-icon"><div class="palette-led"></div></div>
      <span>LED</span>
    </div>

    <div class="palette-item" data-component="resistor" title="Arrastrar resistencia 220Ω">
      <div class="palette-icon">
        <div class="palette-resistor">
          <div class="bands">
            <span style="background:#ef4444;"></span>
            <span style="background:#ef4444;"></span>
            <span style="background:#fbbf24;"></span>
            <span style="background:#22c55e;"></span>
          </div>
        </div>
      </div>
      <span>Resistencia</span>
    </div>

    <div class="palette-item" data-component="button" title="Arrastrar pulsador">
      <div class="palette-icon"><div class="palette-button"></div></div>
      <span>Pulsador</span>
    </div>

    <div class="palette-title" style="margin-top:12px;">Cables</div>

    <div class="palette-wire-options">
      <div class="palette-item" data-wire-color="#ef4444" title="Cable rojo (VCC)">
        <div class="wire-swatch red"></div>
        <span style="font-size:0.6rem;">Rojo</span>
      </div>
      <div class="palette-item" data-wire-color="#1e293b" title="Cable negro (GND)">
        <div class="wire-swatch black"></div>
        <span style="font-size:0.6rem;">Negro</span>
      </div>
      <div class="palette-item" data-wire-color="#3b82f6" title="Cable azul (señal)">
        <div class="wire-swatch blue"></div>
        <span style="font-size:0.6rem;">Azul</span>
      </div>
      <div class="palette-item" data-wire-color="#22c55e" title="Cable verde (señal)">
        <div class="wire-swatch green"></div>
        <span style="font-size:0.6rem;">Verde</span>
      </div>
    </div>

    <div class="palette-title" style="margin-top:12px;">Ayuda</div>
    <div style="font-size:0.65rem;color:#64748b;line-height:1.5;padding:4px;">
      <strong>Arrastrar:</strong> componente → protoboard<br/>
      <strong>Cables:</strong> selecciona color, luego clic en pin → clic en hueco<br/>
      <strong>LED:</strong> clic derecho para cambiar color<br/>
      <strong>Eliminar:</strong> doble clic en componente o clic en cable
    </div>

    <div class="sim-inspector" id="comp-inspector">
      <div class="inspector-title">Componentes colocados</div>
      <div class="inspector-empty" id="inspector-empty">Ninguno</div>
      <div id="inspector-list"></div>
    </div>
  </aside>

  <section class="sim-workspace">
    <div class="workspace-canvas">
      <div id="arduino-container"></div>
      <div id="protoboard-container"></div>
    </div>
  </section>

  <aside class="sim-code-panel">
    <div class="code-header">
      <h3>Código Arduino</h3>
      <span class="code-badge">C++</span>
    </div>
    <div class="code-editor-wrapper">
      <pre class="code-highlight-layer" id="code-display"></pre>
    </div>
    <div class="code-footer">
      <span style="font-size:0.65rem;color:#94a3b8;">
        El código se carga automáticamente al seleccionar un ejemplo.
      </span>
    </div>
  </aside>
</main>

<footer class="sim-status">
  <div class="status-msg">
    <span class="status-dot idle" id="status-dot"></span>
    <span id="status-msg">Iniciando simulador...</span>
  </div>
  <span style="font-size:0.6rem;color:#475569;">
    Simulador interactivo — Proyecto Académico
  </span>
</footer>

<script src="<?php echo $basePath; ?>simulador/arduino-sim.js"></script>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>
