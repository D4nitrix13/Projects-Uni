/* =========================================================
   Arduino Simulator — Complete Logic
   ========================================================= */

(function () {
  'use strict';

  // =========================================================
  // Config
  // =========================================================
  var PROTO_ROWS = 10;
  var PROTO_COLS = 15;
  var GAP_COL = 7;
  var LED_COLORS = [
    { name: 'Rojo', value: '#ef4444' },
    { name: 'Verde', value: '#22c55e' },
    { name: 'Azul', value: '#3b82f6' },
    { name: 'Amarillo', value: '#eab308' },
    { name: 'Blanco', value: '#f8fafc' },
    { name: 'Naranja', value: '#f97316' },
    { name: 'Rosa', value: '#ec4899' },
    { name: 'Cian', value: '#06b6d4' },
  ];
  var COMP_SPAN = { led: 2, resistor: 2, button: 6 };

  // =========================================================
  // State
  // =========================================================
  var state = {
    components: [],       // { type, row, col, el, extra, ports: {A:{el,row,col}, K:{...}} }
    wires: [],            // { from: {type, id/row/col, el, portId}, to: same, color, el, points:[] }
    selectedComponent: null,
    selectedWire: null,
    wireSource: null,
    dragActive: false,
    simulating: false,
    simulationTimers: [],
    currentExample: null,
    wireColor: '#3b82f6',
    simListeners: [],
    pinStates: {},        // { '13': 'HIGH', '2': 'LOW', ... }
    compCounter: 0,       // unique component counter for port IDs
    wirePreview: null,    // { line, points:[] } for drawing preview
    draggingWirePoint: null, // { wireIndex, pointIndex }
  };

  // =========================================================
  // DOM refs
  // =========================================================
  var dom = {};

  // =========================================================
  // Examples
  // =========================================================
  var examples = [
    {
      id: 'led-on',
      name: 'LED Encendido',
      code: 'int led = 13;\n\nvoid setup() {\n  pinMode(led, OUTPUT);\n}\n\nvoid loop() {\n  digitalWrite(led, HIGH);\n}',
      circuit: {
        components: [
          { type: 'led', row: 2, col: 3, extra: { color: '#ef4444' } },
          { type: 'resistor', row: 3, col: 3, extra: {} },
        ],
        wires: [
          { from: 'D13', to: { port: 0, id: 'A' }, color: '#3b82f6' },
          { from: { port: 0, id: 'K' }, to: { port: 1, id: 'L' }, color: '#1e293b' },
          { from: { port: 1, id: 'R' }, to: 'GND', color: '#1e293b' },
        ],
      },
      run: function (done) {
        state.pinStates['D13'] = 'HIGH';
        updateCircuitLights();
        done();
      },
    },
    {
      id: 'blink',
      name: 'LED Parpadeante',
      code: 'int led = 13;\n\nvoid setup() {\n  pinMode(led, OUTPUT);\n}\n\nvoid loop() {\n  digitalWrite(led, HIGH);\n  delay(1000);\n  digitalWrite(led, LOW);\n  delay(1000);\n}',
      circuit: {
        components: [
          { type: 'led', row: 2, col: 3, extra: { color: '#ef4444' } },
          { type: 'resistor', row: 3, col: 3, extra: {} },
        ],
        wires: [
          { from: 'D13', to: { port: 0, id: 'A' }, color: '#3b82f6' },
          { from: { port: 0, id: 'K' }, to: { port: 1, id: 'L' }, color: '#1e293b' },
          { from: { port: 1, id: 'R' }, to: 'GND', color: '#1e293b' },
        ],
      },
      run: function (done) {
        var on = true;
        state.pinStates['D13'] = 'HIGH';
        updateCircuitLights();
        var timer = setInterval(function () {
          on = !on;
          state.pinStates['D13'] = on ? 'HIGH' : 'LOW';
          updateCircuitLights();
          statusMsg(on ? 'LED encendido' : 'LED apagado', 'running');
        }, 1000);
        state.simulationTimers.push(timer);
        done();
      },
    },
    {
      id: 'button',
      name: 'LED con Pulsador',
      code: 'int boton = 2;\nint led = 13;\nint estadoBoton = 0;\n\nvoid setup() {\n  pinMode(boton, INPUT);\n  pinMode(led, OUTPUT);\n}\n\nvoid loop() {\n  estadoBoton = digitalRead(boton);\n  if (estadoBoton == HIGH) {\n    digitalWrite(led, HIGH);\n  } else {\n    digitalWrite(led, LOW);\n  }\n}',
      circuit: {
        components: [
          { type: 'led', row: 2, col: 3, extra: { color: '#ef4444' } },
          { type: 'resistor', row: 4, col: 3, extra: {} },
          { type: 'button', row: 7, col: 3, extra: {} },
        ],
        wires: [
          { from: 'D13', to: { port: 0, id: 'A' }, color: '#3b82f6' },
          { from: { port: 0, id: 'K' }, to: { port: 1, id: 'L' }, color: '#1e293b' },
          { from: { port: 1, id: 'R' }, to: 'GND', color: '#1e293b' },
          { from: 'D2', to: { port: 2, id: 'T1' }, color: '#22c55e' },
          { from: '5V', to: { port: 2, id: 'T2' }, color: '#ef4444' },
        ],
      },
      run: function (done) {
        var btn = findCompEl('button');
        var btnEl = btn && btn.querySelector('.button-cap');
        if (!btnEl) { done(); return; }

        function press() {
          btnEl.classList.add('pressed');
          state.pinStates['D2'] = 'HIGH';
          state.pinStates['D13'] = 'HIGH';
          updateCircuitLights();
          statusMsg('LED encendido — botón presionado', 'running');
        }
        function release() {
          btnEl.classList.remove('pressed');
          state.pinStates['D2'] = 'LOW';
          state.pinStates['D13'] = 'LOW';
          updateCircuitLights();
          statusMsg('LED apagado — botón liberado', 'running');
        }

        btnEl.addEventListener('mousedown', press);
        btnEl.addEventListener('mouseup', release);
        btnEl.addEventListener('mouseleave', release);
        btnEl.addEventListener('touchstart', press, { passive: true });
        btnEl.addEventListener('touchend', release, { passive: true });
        btnEl.style.cursor = 'pointer';

        state.simListeners.push(
          { el: btnEl, type: 'mousedown', fn: press },
          { el: btnEl, type: 'mouseup', fn: release },
          { el: btnEl, type: 'mouseleave', fn: release },
          { el: btnEl, type: 'touchstart', fn: press },
          { el: btnEl, type: 'touchend', fn: release },
        );

        done();
      },
    },
  ];

  // =========================================================
  // Helpers
  // =========================================================
  function statusMsg(msg, type) {
    if (dom.statusMsg) dom.statusMsg.textContent = msg || 'Listo';
    if (dom.statusDot) dom.statusDot.className = 'status-dot ' + (type || 'idle');
  }

  function findCompEl(type) {
    for (var i = 0; i < state.components.length; i++) {
      if (state.components[i].type === type) return state.components[i].el;
    }
    return null;
  }

  function compIndexByEl(el) {
    for (var i = 0; i < state.components.length; i++) {
      if (state.components[i].el === el) return i;
    }
    return -1;
  }

  function findPinEl(pinId) {
    return dom.arduinoBoard && dom.arduinoBoard.querySelector(
      '.arduino-pin[data-pin-id="' + pinId + '"]'
    );
  }

  function findHoleEl(row, col) {
    return dom.protoGrid && dom.protoGrid.querySelector(
      '.proto-cell[data-row="' + row + '"][data-col="' + col + '"]'
    );
  }

  function centerRel(el, ref) {
    if (!el || !ref) return { x: 0, y: 0 };
    var er = el.getBoundingClientRect();
    var rr = ref.getBoundingClientRect();
    return {
      x: er.left + er.width / 2 - rr.left,
      y: er.top + er.height / 2 - rr.top,
    };
  }

  function compName(type) {
    return { led: 'LED', resistor: 'Resistencia 220\u03A9', button: 'Pulsador' }[type] || type;
  }

  function compValue(comp) {
    if (comp.type === 'led') return comp.extra.color || '#ef4444';
    if (comp.type === 'resistor') return '220\u03A9';
    if (comp.type === 'button') return 'Pulsador NA';
    return '';
  }

  // =========================================================
  // Syntax Highlighting (Arduino C++) — unchanged
  // =========================================================
  function escapeHtml(str) {
    return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  }

  function createSyntaxTokenizer() {
    var tokens = [];
    function indexToLetters(n) {
      var s = '';
      do { s = String.fromCharCode(97 + (n % 26)) + s; n = Math.floor(n / 26); } while (n > 0);
      return s;
    }
    function addToken(html) {
      var token = '\u00A7\u00A7SYNTAX_PLACEHOLDER_' + indexToLetters(tokens.length) + '\u00A7\u00A7';
      tokens.push({ token: token, html: html });
      return token;
    }
    function restore(code) {
      var r = code;
      tokens.forEach(function (item) { r = r.split(item.token).join(item.html); });
      return r;
    }
    return { addToken: addToken, restore: restore };
  }

  function highlightWithTokenRegex(code, regex, className, tokenizer) {
    var fn = tokenizer.addToken;
    return code.replace(regex, function (m) { return fn('<span class="' + className + '">' + m + '</span>'); });
  }

  function highlightArduinoCode(rawCode) {
    var code = escapeHtml(rawCode);
    var tokenizer = createSyntaxTokenizer();

    code = highlightWithTokenRegex(code, /\/\/.*$/gm, 'syntax-comment', tokenizer);
    code = highlightWithTokenRegex(code, /\/\*[\s\S]*?\*\//g, 'syntax-comment', tokenizer);
    code = highlightWithTokenRegex(code, /'[^']*'/g, 'syntax-string', tokenizer);
    code = highlightWithTokenRegex(code, /"[^"]*"/g, 'syntax-string', tokenizer);

    code = highlightWithTokenRegex(code,
      /\b(void|int|float|double|char|byte|bool|boolean|long|short|unsigned|const|String)\b/g,
      'syntax-type', tokenizer);
    code = highlightWithTokenRegex(code,
      /\b(if|else|for|while|do|switch|case|break|continue|return)\b/g,
      'syntax-keyword', tokenizer);
    code = highlightWithTokenRegex(code,
      /\b(setup|loop|pinMode|digitalWrite|digitalRead|analogRead|analogWrite|delay|map)\b/g,
      'syntax-function', tokenizer);
    code = highlightWithTokenRegex(code,
      /\b(Serial|begin|println|print|HIGH|LOW|INPUT|OUTPUT|INPUT_PULLUP|A0|A1|A2|A3|A4|A5)\b/g,
      'syntax-constant', tokenizer);
    code = highlightWithTokenRegex(code, /\b(\d+)\b/g, 'syntax-number', tokenizer);

    return tokenizer.restore(code);
  }

  function setHighlightedCode(code) {
    if (!dom.codeDisplay) return;
    if (typeof window.highlightArduinoCode === 'function') {
      dom.codeDisplay.innerHTML = window.highlightArduinoCode(code) + '\n';
    } else {
      dom.codeDisplay.innerHTML = highlightArduinoCode(code) + '\n';
    }
  }

  // =========================================================
  // Tooltips
  // =========================================================
  function addTooltip(el, text, row, col) {
    var tip = document.createElement('div');
    tip.className = 'comp-tooltip';
    tip.style.display = 'none';
    el.style.position = 'relative';
    el.appendChild(tip);

    function updateTip() {
      var parts = [text + ' \u2014 F' + (row + 1) + ' C' + (col + 1)];
      for (var i = 0; i < state.wires.length; i++) {
        var w = state.wires[i];
        if (w.to && w.to.row === row && w.to.col === col && w.from && w.from.id) {
          parts.push('\u2192 ' + w.from.id);
        }
      }
      tip.textContent = parts.join(' ');
    }

    el.addEventListener('mouseenter', function () { updateTip(); tip.style.display = 'block'; });
    el.addEventListener('mouseleave', function () { tip.style.display = 'none'; });
  }

  // =========================================================
  // Component Inspector (sidebar)
  // =========================================================
  function updateInspector() {
    var list = document.getElementById('inspector-list');
    var empty = document.getElementById('inspector-empty');
    if (!list || !empty) return;

    list.innerHTML = '';
    if (state.components.length === 0) {
      empty.style.display = 'block';
      return;
    }
    empty.style.display = 'none';

    state.components.forEach(function (c) {
      var row = c.row != null ? c.row + 1 : '\u2014';
      var col = c.col != null ? c.col + 1 : '\u2014';
      var item = document.createElement('div');
      item.className = 'inspector-item';
      item.innerHTML = '<span class="inspector-name">' + compName(c.type) + '</span>' +
        '<span class="inspector-loc">F' + row + ' C' + col + '</span>';
      list.appendChild(item);
    });
  }

  // =========================================================
  // Safe spawn position calculator
  // =========================================================
  function getSafeSpawnPosition(type) {
    var canvas = dom.workspaceCanvas;
    var board = dom.protoContainer;
    if (!canvas || !board) return { x: 40, y: 80 };

    var canvasRect = canvas.getBoundingClientRect();
    var boardRect = board.getBoundingClientRect();

    var boardLeft = boardRect.left - canvasRect.left;
    var boardTop = boardRect.top - canvasRect.top;

    if (type === 'led') {
      return { x: boardLeft + boardRect.width - 180, y: boardTop + 40 };
    }
    if (type === 'resistor') {
      return { x: boardLeft + boardRect.width - 120, y: boardTop + 80 };
    }
    if (type === 'button') {
      return { x: boardLeft + boardRect.width - 100, y: boardTop + 20 };
    }
    return { x: boardLeft + 40, y: boardTop + 80 };
  }

  // =========================================================
  // Arduino
  // =========================================================
  function buildArduino() {
    var c = dom.arduinoContainer;
    c.innerHTML = '';

    var board = document.createElement('div');
    board.className = 'arduino-board';

    // Top bar
    var top = document.createElement('div');
    top.className = 'arduino-top';
    var usb = document.createElement('div');
    usb.className = 'arduino-usb';
    usb.textContent = 'USB';
    top.appendChild(usb);
    var pw = document.createElement('div');
    pw.className = 'arduino-power';
    var pj = document.createElement('div');
    pj.className = 'power-jack';
    pw.appendChild(pj);
    top.appendChild(pw);
    board.appendChild(top);

    // Chip
    var chipDiv = document.createElement('div');
    chipDiv.className = 'arduino-chip';
    var chip = document.createElement('div');
    chip.className = 'chip-body';
    chip.textContent = 'ATmega328P';
    var sm = document.createElement('small');
    sm.textContent = 'Powered by Arduino';
    chip.appendChild(sm);
    chipDiv.appendChild(chip);
    board.appendChild(chipDiv);

    // Pins
    var leftPins = [
      'A0', 'A1', 'A2', 'A3', 'A4', 'A5',
      '5V', '3V3', 'GND', 'Vin',
    ];
    var rightPins = [
      'D0', 'D1', 'D2', 'D3', 'D4', 'D5', 'D6', 'D7',
      'D8', 'D9', 'D10', 'D11', 'D12', 'D13',
    ];

    var pinRow = document.createElement('div');
    pinRow.className = 'arduino-pins';

    var lg = document.createElement('div');
    lg.className = 'pin-group';
    var ll = document.createElement('div');
    ll.className = 'pin-group-label';
    ll.textContent = 'ANALOG / POWER';
    lg.appendChild(ll);
    var lr = document.createElement('div');
    lr.className = 'pin-row';
    leftPins.forEach(function (id) {
      var p = document.createElement('div');
      p.className = 'arduino-pin pin-port';
      p.dataset.pinId = id;
      p.dataset.portId = 'pin:' + id;
      p.textContent = id;
      p.title = id;
      p.addEventListener('click', function (e) { e.stopPropagation(); onPortClick(this); });
      lr.appendChild(p);
    });
    lg.appendChild(lr);
    pinRow.appendChild(lg);

    var rg = document.createElement('div');
    rg.className = 'pin-group';
    var rl = document.createElement('div');
    rl.className = 'pin-group-label';
    rl.textContent = 'DIGITAL';
    rg.appendChild(rl);
    var rr = document.createElement('div');
    rr.className = 'pin-row';
    rightPins.forEach(function (id) {
      var p = document.createElement('div');
      p.className = 'arduino-pin pin-port';
      p.dataset.pinId = id;
      p.dataset.portId = 'pin:' + id;
      p.textContent = id;
      p.title = id;
      p.addEventListener('click', function (e) { e.stopPropagation(); onPortClick(this); });
      rr.appendChild(p);
    });
    rg.appendChild(rr);
    pinRow.appendChild(rg);

    board.appendChild(pinRow);
    c.appendChild(board);
    dom.arduinoBoard = board;
  }

  // =========================================================
  // Protoboard
  // =========================================================
  function buildProtoboard() {
    var container = dom.protoContainer;
    container.innerHTML = '';

    var board = document.createElement('div');
    board.className = 'protoboard';
    board.style.position = 'relative';

    var lbl = document.createElement('div');
    lbl.className = 'protoboard-label';
    lbl.textContent = 'PROTOBOARD';
    board.appendChild(lbl);

    var colNames = ['', '\u2212', '+', 'a', 'b', 'c', 'd', 'e', '', 'f', 'g', 'h', 'i', 'j', '+', '\u2212'];
    var ch = document.createElement('div');
    ch.className = 'proto-col-labels';
    for (var ci = 0; ci < PROTO_COLS + 1; ci++) {
      var cd = document.createElement('div');
      cd.className = 'proto-col-label';
      cd.textContent = colNames[ci] || '';
      if (ci - 1 === GAP_COL) cd.textContent = '';
      ch.appendChild(cd);
    }
    board.appendChild(ch);

    var grid = document.createElement('div');
    grid.className = 'proto-grid';

    for (var r = 0; r < PROTO_ROWS; r++) {
      var row = document.createElement('div');
      row.className = 'proto-row';

      var rl = document.createElement('div');
      rl.className = 'proto-row-label';
      rl.textContent = r + 1;
      row.appendChild(rl);

      for (var col = 0; col < PROTO_COLS; col++) {
        if (col === GAP_COL) {
          var gap = document.createElement('div');
          gap.className = 'proto-gap';
          row.appendChild(gap);
          continue;
        }

        var cell = document.createElement('div');
        cell.className = 'proto-cell';
        cell.dataset.row = r;
        cell.dataset.col = col;

        if (col === 0 || col === 14) cell.classList.add('rail-negative');
        if (col === 1 || col === 13) cell.classList.add('rail-positive');

        var hole = document.createElement('div');
        hole.className = 'hole';
        cell.appendChild(hole);

        cell.addEventListener('click', function (e) {
          e.stopPropagation();
          onHoleClick(this);
        });

        row.appendChild(cell);
      }

      grid.appendChild(row);
    }

    board.appendChild(grid);
    container.appendChild(board);
    dom.protoBoard = board;
    dom.protoGrid = grid;

    if (!dom.wiresSvg) {
      var canvas = dom.workspaceCanvas;
      if (canvas) {
        var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'wires-svg');
        svg.style.position = 'absolute';
        svg.style.top = '0';
        svg.style.left = '0';
        svg.style.width = '100%';
        svg.style.height = '100%';
        svg.style.pointerEvents = 'none';
        svg.style.zIndex = '3';
        canvas.appendChild(svg);
        dom.wiresSvg = svg;
      }
    }
  }

  // =========================================================
  // Compute port position for a component
  // Ports are positioned at cell centers on the protoboard
  // =========================================================
  function getCompPortPos(comp, portName) {
    var portDef = comp.ports[portName];
    if (!portDef) return null;
    return getHoleCenterRelSvg(portDef.row, portDef.col);
  }

  function getHoleCenterRelSvg(row, col) {
    if (!dom.wiresSvg) return null;
    var cell = findHoleEl(row, col);
    if (!cell) return null;
    var hole = cell.querySelector('.hole') || cell;
    return centerRel(hole, dom.wiresSvg);
  }

  // =========================================================
  // Component DOM
  // =========================================================
  function makeCompEl(type, extra) {
    extra = extra || {};
    var div = document.createElement('div');
    div.className = 'component component-' + type;
    div.dataset.componentType = type;
    div.style.overflow = 'visible';
    div.style.position = 'relative';

    var inner = document.createElement('div');
    inner.className = 'comp-inner';
    inner.style.width = '100%';
    inner.style.height = '100%';
    inner.style.position = 'relative';

    var html = '';
    if (type === 'led') {
      var col = extra.color || '#ef4444';
      html = '<div class="led-bulb" style="background:' + col + ';--led-color:' + col + ';"></div>' +
        '<div class="led-body"></div>' +
        '<div class="led-leg left-leg"></div>' +
        '<div class="led-leg right-leg"></div>';
    } else if (type === 'resistor') {
      html = '<div class="resistor-body">' +
        '<span class="band band-1"></span><span class="band band-2"></span>' +
        '<span class="band band-3"></span><span class="band band-4"></span>' +
        '</div>' +
        '<div class="resistor-leg left-leg"></div>' +
        '<div class="resistor-leg right-leg"></div>';
    } else if (type === 'button') {
      html = '<div class="button-cap"></div>' +
        '<div class="button-base"></div>' +
        '<div class="button-leg left-leg"></div>' +
        '<div class="button-leg right-leg"></div>';
    }

    inner.innerHTML = html;
    div.appendChild(inner);

    // Add port elements
    addPortsToComp(div, type, extra);

    return div;
  }

  function addPortsToComp(el, type, extra) {
    var span = COMP_SPAN[type] || 1;
    var ports;
    if (type === 'led') {
      ports = { A: 0, K: span };
    } else if (type === 'resistor') {
      ports = { L: 0, R: span };
    } else if (type === 'button') {
      ports = { T1: 0, T2: span };
    } else {
      return;
    }

    var CELL_W = 26, CELL_GAP = 1;
    var cellStep = CELL_W + CELL_GAP; // 27
    var compWidth = span * cellStep + CELL_W; // span cells + 1 full cell width

    el.style.width = compWidth + 'px';
    el.style.overflow = 'visible';

    // Port positions: left port at cell col center, right port at cell (col+span) center
    // Within the component: first cell starts at x=0, each cell is 27px wide with 26px content
    // Cell center is at offset*cellStep + 13
    for (var name in ports) {
      var offset = ports[name];
      var portEl = document.createElement('div');
      portEl.className = 'comp-port';
      portEl.dataset.portName = name;
      portEl.style.cssText = 'position:absolute;width:12px;height:12px;border-radius:50%;' +
        'background:rgba(59,130,246,0.6);border:2px solid #3b82f6;cursor:pointer;z-index:5;' +
        'transform:translate(-50%,-50%);';

      // Port center at cell center within the component
      var portX = offset * cellStep + 13;
      var portY = 13; // cell vertical center (26/2)

      portEl.style.left = portX + 'px';
      portEl.style.top = portY + 'px';
      portEl.title = name;
      portEl.addEventListener('click', function (e) {
        e.stopPropagation();
        onPortClick(this);
      });
      el.appendChild(portEl);
    }
  }

  // =========================================================
  // Position a component on the protoboard
  // Left leg at (row, col), component spans COMP_SPAN[type] cells
  // =========================================================
  function posComp(el, type, row, col) {
    if (!dom.protoBoard) { return; }

    var span = COMP_SPAN[type] || 1;
    var CELL_W = 26;
    var CELL_GAP = 1;
    var ROW_LABEL_W = 22;
    var COL_LABEL_H = 16;
    var COL_LABEL_MARGIN = 3;
    var PROTO_PAD = 8;

    // Component covers cells col .. col+span
    // Align component left edge with cell col's left edge
    var x = PROTO_PAD + ROW_LABEL_W + CELL_GAP + col * (CELL_W + CELL_GAP);
    // Align component top with cell row's top edge
    var y = PROTO_PAD + COL_LABEL_H + COL_LABEL_MARGIN + row * (CELL_W + CELL_GAP);

    el.style.position = 'absolute';
    el.style.left = x + 'px';
    el.style.top = y + 'px';
  }

  // =========================================================
  // Place component
  // =========================================================
  function placeComp(type, row, col, extra) {
    extra = extra || {};
    var el = makeCompEl(type, extra);
    posComp(el, type, row, col);

    var compId = state.compCounter++;
    el.dataset.type = type;
    el.dataset.row = row;
    el.dataset.col = col;
    el.dataset.compId = compId;

    // Register ports with their actual cell positions
    var span = COMP_SPAN[type] || 1;
    var ports = {};
    var CELL_W = 26, CELL_GAP = 1;

    if (type === 'led') {
      ports.A = { el: el.querySelector('.comp-port[data-port-name="A"]'), row: row, col: col };
      ports.K = { el: el.querySelector('.comp-port[data-port-name="K"]'), row: row, col: col + span };
    } else if (type === 'resistor') {
      ports.L = { el: el.querySelector('.comp-port[data-port-name="L"]'), row: row, col: col };
      ports.R = { el: el.querySelector('.comp-port[data-port-name="R"]'), row: row, col: col + span };
    } else if (type === 'button') {
      ports.T1 = { el: el.querySelector('.comp-port[data-port-name="T1"]'), row: row, col: col };
      ports.T2 = { el: el.querySelector('.comp-port[data-port-name="T2"]'), row: row, col: col + span };
    }

    for (var pn in ports) {
      if (ports[pn].el) {
        ports[pn].el.dataset.portId = 'comp:' + compId + ':' + pn;
      }
    }

    if (type === 'led') {
      el.addEventListener('contextmenu', function (e) {
        e.preventDefault();
        e.stopPropagation();
        showColorPicker(this, extra);
      });
    }

    el.addEventListener('dblclick', function (e) {
      e.stopPropagation();
      if (state.simulating) return;
      if (confirm('Eliminar ' + compName(type) + '?')) removeComp(this);
    });

    dom.protoBoard.appendChild(el);

    state.components.push({
      type: type, row: row, col: col, el: el, extra: extra,
      ports: ports, compId: compId,
    });

    // Drag-to-move
    el.addEventListener('mousedown', function (e) {
      if (state.simulating) return;
      if (e.button !== 0) return;
      if (e.target.closest('.comp-port')) return;
      e.stopPropagation();

      var startX = e.clientX;
      var startY = e.clientY;
      var moved = false;
      var comp = this;
      var origRow = +comp.dataset.row;
      var origCol = +comp.dataset.col;
      var ctype = comp.dataset.type;

      var ghost = document.createElement('div');
      ghost.style.cssText = 'position:fixed;z-index:1000;pointer-events:none;opacity:0.8;' +
        'width:80px;box-shadow:0 8px 24px rgba(0,0,0,0.2);' +
        'background:#f1f5f9;border:1px solid #e2e8f0;border-radius:8px;padding:6px 8px;' +
        'display:flex;flex-direction:column;align-items:center;gap:4px;font-size:0.7rem;font-weight:600;';
      ghost.textContent = compName(ctype);

      function onMove(ev) {
        var mx = ev.clientX;
        var my = ev.clientY;
        if (mx === undefined) return;
        var dx = mx - startX;
        var dy = my - startY;
        if (!moved && (Math.abs(dx) > 5 || Math.abs(dy) > 5)) {
          moved = true;
          ghost.style.left = (startX - 40) + 'px';
          ghost.style.top = (startY - 20) + 'px';
          document.body.appendChild(ghost);
          comp.style.opacity = '0.3';
        }
        if (moved) {
          ghost.style.left = (mx - 40) + 'px';
          ghost.style.top = (my - 20) + 'px';
          highlightHole(mx, my);
        }
      }

      function onUp(ev) {
        var mx = ev.clientX;
        var my = ev.clientY;
        document.removeEventListener('mousemove', onMove);
        document.removeEventListener('mouseup', onUp);
        if (ghost.parentNode) ghost.remove();
        comp.style.opacity = '';

        if (moved && mx !== undefined) {
          clearHoleHighlights();
          var near = nearestHole(mx, my);
          var validRow = near ? near.row : origRow;
          var validCol = near ? near.col : origCol;
          if (near) {
            if (type === 'led' || type === 'resistor') {
              validCol = near.col < 4 ? 3 : (near.col > 10 ? 3 : near.col);
            } else if (type === 'button') {
              validCol = near.col < 4 ? 2 : (near.col > 10 ? 2 : near.col);
            }
            if (validCol === GAP_COL) { validCol = type === 'button' ? 2 : 3; }
            if (validCol < 0) validCol = 0;
            if (validCol >= PROTO_COLS) validCol = PROTO_COLS - 1;
          }
          if (near) {
            var idx = compIndexByEl(comp);
            var cdata = idx >= 0 ? state.components[idx] : null;
            comp.dataset.row = validRow;
            comp.dataset.col = validCol;
            posComp(comp, type, validRow, validCol);
            if (cdata) {
              cdata.row = validRow;
              cdata.col = validCol;
              // Update port positions
              updateCompPorts(cdata);
            }
            updateInspector();
            statusMsg(compName(type) + ' movido a F' + (validRow + 1) + ' C' + (validCol + 1));
          } else {
            comp.dataset.row = origRow;
            comp.dataset.col = origCol;
            posComp(comp, type, origRow, origCol);
            statusMsg(compName(type) + ' devuelto a F' + (origRow + 1) + ' C' + (origCol + 1));
          }
        } else if (!moved) {
          selectComp(comp);
        }
      }

      document.addEventListener('mousemove', onMove);
      document.addEventListener('mouseup', onUp);
    });

    updateInspector();
    return el;
  }

  function updateCompPorts(cdata) {
    var span = COMP_SPAN[cdata.type] || 1;
    var r = cdata.row, col = cdata.col;
    if (cdata.ports.A) { cdata.ports.A.row = r; cdata.ports.A.col = col; }
    if (cdata.ports.K) { cdata.ports.K.row = r; cdata.ports.K.col = col + span; }
    if (cdata.ports.L) { cdata.ports.L.row = r; cdata.ports.L.col = col; }
    if (cdata.ports.R) { cdata.ports.R.row = r; cdata.ports.R.col = col + span; }
    if (cdata.ports.T1) { cdata.ports.T1.row = r; cdata.ports.T1.col = col; }
    if (cdata.ports.T2) { cdata.ports.T2.row = r; cdata.ports.T2.col = col + span; }
  }

  // =========================================================
  // Select / Remove
  // =========================================================
  function selectComp(el) {
    if (state.selectedComponent) state.selectedComponent.classList.remove('selected');
    el.classList.add('selected');
    state.selectedComponent = el;
    deselectWire();
    statusMsg('Seleccionado: ' + compName(el.dataset.type) + ' (doble clic para eliminar)');
  }

  function removeComp(el) {
    // Remove associated wires first
    var idx = compIndexByEl(el);
    if (idx >= 0) {
      var c = state.components[idx];
      var portIds = [];
      for (var pn in c.ports) {
        if (c.ports[pn].el) portIds.push(c.ports[pn].el.dataset.portId);
      }
      // Remove wires connected to this component's ports
      state.wires = state.wires.filter(function (w) {
        var match = false;
        if (w.from && w.from.portId && portIds.indexOf(w.from.portId) >= 0) match = true;
        if (w.to && w.to.portId && portIds.indexOf(w.to.portId) >= 0) match = true;
        if (match && w.el && w.el.parentNode) w.el.parentNode.removeChild(w.el);
        return !match;
      });
    }

    if (state.selectedComponent === el) state.selectedComponent = null;
    state.components = state.components.filter(function (c) { return c.el !== el; });
    if (el.parentNode) el.parentNode.removeChild(el);
    updateInspector();
    updateWires();
    statusMsg('Componente eliminado');
  }

  function deselectWire() {
    if (state.selectedWire !== null) {
      state.selectedWire = null;
      state.draggingWirePoint = null;
      updateWires();
    }
  }

  // =========================================================
  // Port / Pin Click → Wire system
  // =========================================================
  function onPortClick(el) {
    if (state.simulating) return;
    var portId = el.dataset.portId;
    if (!portId) return;

    var isPin = portId.indexOf('pin:') === 0;
    var isComp = portId.indexOf('comp:') === 0;

    // Determine source data
    var srcData = {
      portId: portId,
      el: el,
      isPin: isPin,
      isComp: isComp,
    };

    // Resolve position
    var pos = getPortPos(portId, el);
    if (pos) { srcData.x = pos.x; srcData.y = pos.y; }

    if (!state.wireSource) {
      // First click — start wire
      state.wireSource = srcData;
      el.classList.add('active-source');

      // Create preview layer
      state.wirePreview = { line: null, points: [] };
      statusMsg('Origen: ' + portLabel(portId) + ' — haz clic en otro puerto para conectar, o en el área para agregar puntos');
      return;
    }

    // Second click — same source cancels
    if (state.wireSource.portId === portId) {
      cancelWire();
      return;
    }

    // Complete wire
    completeWire(state.wireSource, srcData);
  }

  function portLabel(portId) {
    if (portId.indexOf('pin:') === 0) return portId.slice(4);
    var m = portId.match(/comp:(\d+):(.+)/);
    if (m) return 'Comp.' + m[1] + ':' + m[2];
    return portId;
  }

  function getPortPos(portId, el) {
    if (!dom.wiresSvg) return null;
    return centerRel(el, dom.wiresSvg);
  }

  // =========================================================
  // Wire preview (follows the mouse)
  // =========================================================
  function updateWirePreview(mx, my) {
    if (!state.wireSource || !dom.wiresSvg) return;

    var svg = dom.wiresSvg;
    var preview = svg.querySelector('.wire-preview-group');
    if (!preview) {
      preview = document.createElementNS('http://www.w3.org/2000/svg', 'g');
      preview.setAttribute('class', 'wire-preview-group');
      svg.appendChild(preview);
    }
    preview.innerHTML = '';

    var srcPos = state.wireSource;
    var fromX = srcPos.x || 0;
    var fromY = srcPos.y || 0;

    // Points relative to SVG
    var svgRect = svg.getBoundingClientRect();
    var toX = mx - svgRect.left;
    var toY = my - svgRect.top;

    var pts = state.wirePreview ? state.wirePreview.points : [];
    var allPoints = [{ x: fromX, y: fromY }];
    pts.forEach(function (p) { allPoints.push(p); });
    allPoints.push({ x: toX, y: toY });

    if (allPoints.length < 2) return;

    var pathData = 'M ' + allPoints[0].x.toFixed(1) + ',' + allPoints[0].y.toFixed(1);
    for (var i = 1; i < allPoints.length; i++) {
      pathData += ' L ' + allPoints[i].x.toFixed(1) + ',' + allPoints[i].y.toFixed(1);
    }

    var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', pathData);
    path.setAttribute('stroke', state.wireColor || '#3b82f6');
    path.setAttribute('stroke-width', '2');
    path.setAttribute('fill', 'none');
    path.setAttribute('stroke-dasharray', '6,4');
    path.setAttribute('opacity', '0.7');
    path.style.pointerEvents = 'none';
    preview.appendChild(path);

    // Draw intermediate points
    pts.forEach(function (p) {
      var dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
      dot.setAttribute('cx', p.x.toFixed(1));
      dot.setAttribute('cy', p.y.toFixed(1));
      dot.setAttribute('r', '3');
      dot.setAttribute('fill', state.wireColor || '#3b82f6');
      dot.setAttribute('opacity', '0.5');
      dot.style.pointerEvents = 'none';
      preview.appendChild(dot);
    });
  }

  function clearWirePreview() {
    if (dom.wiresSvg) {
      var preview = dom.wiresSvg.querySelector('.wire-preview-group');
      if (preview) preview.remove();
    }
  }

  function addWirePreviewPoint(event) {
    if (!state.wireSource || !dom.wiresSvg) return;
    if (!state.wirePreview) state.wirePreview = { line: null, points: [] };

    var svgRect = dom.wiresSvg.getBoundingClientRect();
    var pt = {
      x: event.clientX - svgRect.left,
      y: event.clientY - svgRect.top,
    };
    state.wirePreview.points.push(pt);
    statusMsg('Punto de ruta agregado — haz clic en otro puerto para conectar');
  }

  // =========================================================
  // Wire SVG rendering
  // =========================================================
  function buildPolylinePath(points) {
    if (points.length < 2) return '';
    var d = 'M ' + points[0].x.toFixed(1) + ',' + points[0].y.toFixed(1);
    for (var i = 1; i < points.length; i++) {
      d += ' L ' + points[i].x.toFixed(1) + ',' + points[i].y.toFixed(1);
    }
    return d;
  }

  function drawWire(from, to, color, points) {
    var svg = dom.wiresSvg;
    if (!svg) return null;

    var fromPos = getPortPos(from.portId, from.el);
    var toPos = getPortPos(to.portId, to.el);
    if (!fromPos || !toPos) return null;

    var allPoints = [fromPos];
    if (points && points.length > 0) {
      points.forEach(function (p) { allPoints.push(p); });
    }
    allPoints.push(toPos);

    var group = document.createElementNS('http://www.w3.org/2000/svg', 'g');

    var pathData = buildPolylinePath(allPoints);
    var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', pathData);
    path.setAttribute('stroke', color);
    path.setAttribute('stroke-width', '2.5');
    path.setAttribute('fill', 'none');
    path.setAttribute('stroke-linecap', 'round');
    path.setAttribute('stroke-linejoin', 'round');
    path.style.pointerEvents = 'auto';
    path.style.cursor = 'pointer';
    group.appendChild(path);

    // Endpoints
    [fromPos, toPos].forEach(function (pt) {
      var dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
      dot.setAttribute('cx', pt.x.toFixed(1));
      dot.setAttribute('cy', pt.y.toFixed(1));
      dot.setAttribute('r', '4');
      dot.setAttribute('fill', color);
      dot.setAttribute('stroke', '#fff');
      dot.setAttribute('stroke-width', '1.5');
      var label = document.createElementNS('http://www.w3.org/2000/svg', 'title');
      label.textContent = color;
      dot.appendChild(label);
      group.appendChild(dot);
    });

    svg.appendChild(group);
    return { el: group, path: path, points: allPoints };
  }

  function updateWires() {
    if (!dom.wiresSvg) return;
    // Clear all wire elements
    dom.wiresSvg.querySelectorAll('.wire-group').forEach(function (g) { g.remove(); });

    state.wires.forEach(function (w, idx) {
      var fromPos = getPortPos(w.from.portId, w.from.el);
      var toPos = getPortPos(w.to.portId, w.to.el);
      if (!fromPos || !toPos) return;

      var allPoints = [fromPos];
      if (w.points && w.points.length > 0) {
        w.points.forEach(function (p) { allPoints.push({ x: p.x, y: p.y }); });
      }
      allPoints.push(toPos);

      var group = document.createElementNS('http://www.w3.org/2000/svg', 'g');
      group.setAttribute('class', 'wire-group');
      if (state.selectedWire === idx) group.classList.add('wire-selected');

      var pathData = buildPolylinePath(allPoints);
      var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('d', pathData);
      path.setAttribute('stroke', w.color);
      path.setAttribute('stroke-width', state.selectedWire === idx ? '4' : '2.5');
      path.setAttribute('fill', 'none');
      path.setAttribute('stroke-linecap', 'round');
      path.setAttribute('stroke-linejoin', 'round');
      path.style.pointerEvents = 'auto';
      path.style.cursor = 'pointer';
      path.dataset.wireIndex = idx;

      // Click → select wire
      path.addEventListener('click', function (e) {
        e.stopPropagation();
        if (state.simulating) return;
        state.selectedWire = idx;
        deselectComponent();
        updateWires();
        statusMsg('Cable seleccionado — arrastra puntos blancos para ajustar ruta, Doble clic para eliminar');
      });

      // Double-click → delete wire
      path.addEventListener('dblclick', function (e) {
        e.stopPropagation();
        if (state.simulating) return;
        deleteWire(idx);
      });

      group.appendChild(path);

      // Endpoint dots
      [fromPos, toPos].forEach(function (pt) {
        var dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        dot.setAttribute('cx', pt.x.toFixed(1));
        dot.setAttribute('cy', pt.y.toFixed(1));
        dot.setAttribute('r', '4');
        dot.setAttribute('fill', w.color);
        dot.setAttribute('stroke', '#fff');
        dot.setAttribute('stroke-width', '1.5');
        group.appendChild(dot);
      });

      // Control points (draggable) when selected
      if (state.selectedWire === idx && w.points && w.points.length > 0) {
        w.points.forEach(function (pt, pIdx) {
          var ctrl = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
          ctrl.setAttribute('cx', pt.x.toFixed(1));
          ctrl.setAttribute('cy', pt.y.toFixed(1));
          ctrl.setAttribute('r', '7');
          ctrl.setAttribute('fill', '#fff');
          ctrl.setAttribute('stroke', '#0f172a');
          ctrl.setAttribute('stroke-width', '2');
          ctrl.setAttribute('cursor', 'move');
          ctrl.style.pointerEvents = 'auto';
          ctrl.dataset.wireIndex = idx;
          ctrl.dataset.pointIndex = pIdx;

          ctrl.addEventListener('mousedown', function (e) {
            e.stopPropagation();
            e.preventDefault();
            state.draggingWirePoint = { wireIndex: idx, pointIndex: pIdx };
          });

          group.appendChild(ctrl);
        });
      }

      dom.wiresSvg.appendChild(group);
    });
  }

  function deleteWire(idx) {
    if (idx < 0 || idx >= state.wires.length) return;
    var w = state.wires[idx];
    if (w.el && w.el.parentNode) w.el.parentNode.removeChild(w.el);
    state.wires.splice(idx, 1);
    if (state.selectedWire === idx) state.selectedWire = null;
    else if (state.selectedWire > idx) state.selectedWire--;
    updateWires();
    statusMsg('Cable eliminado');
  }

  function deselectComponent() {
    if (state.selectedComponent) {
      state.selectedComponent.classList.remove('selected');
      state.selectedComponent = null;
    }
  }

  // =========================================================
  // Complete wire connection
  // =========================================================
  function completeWire(from, to) {
    var svg = dom.wiresSvg;
    if (!svg) { cancelWire(); return; }

    var color = state.wireColor || '#3b82f6';
    var points = state.wirePreview ? state.wirePreview.points : [];

    var fromPos = getPortPos(from.portId, from.el);
    var toPos = getPortPos(to.portId, to.el);
    if (!fromPos || !toPos) { cancelWire(); return; }

    var allPoints = [fromPos];
    points.forEach(function (p) { allPoints.push({ x: p.x, y: p.y }); });
    allPoints.push(toPos);

    var group = document.createElementNS('http://www.w3.org/2000/svg', 'g');
    group.setAttribute('class', 'wire-group');

    var pathData = buildPolylinePath(allPoints);
    var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', pathData);
    path.setAttribute('stroke', color);
    path.setAttribute('stroke-width', '2.5');
    path.setAttribute('fill', 'none');
    path.setAttribute('stroke-linecap', 'round');
    path.setAttribute('stroke-linejoin', 'round');
    path.style.pointerEvents = 'auto';
    path.style.cursor = 'pointer';
    path.title = 'Cable';
    path.dataset.wireIndex = state.wires.length;

    path.addEventListener('click', function (e) {
      e.stopPropagation();
      if (state.simulating) return;
      var wi = parseInt(this.dataset.wireIndex, 10);
      state.selectedWire = wi;
      deselectComponent();
      updateWires();
      statusMsg('Cable seleccionado');
    });

    path.addEventListener('dblclick', function (e) {
      e.stopPropagation();
      if (state.simulating) return;
      var wi = parseInt(this.dataset.wireIndex, 10);
      deleteWire(wi);
    });

    group.appendChild(path);

    // Endpoint dots
    [fromPos, toPos].forEach(function (pt) {
      var dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
      dot.setAttribute('cx', pt.x.toFixed(1));
      dot.setAttribute('cy', pt.y.toFixed(1));
      dot.setAttribute('r', '4');
      dot.setAttribute('fill', color);
      dot.setAttribute('stroke', '#fff');
      dot.setAttribute('stroke-width', '1.5');
      group.appendChild(dot);
    });

    svg.appendChild(group);

    if (from.el) from.el.classList.remove('active-source');

    state.wires.push({
      from: { portId: from.portId, el: from.el },
      to: { portId: to.portId, el: to.el },
      color: color,
      el: group,
      points: points.map(function (p) { return { x: p.x, y: p.y }; }),
    });

    clearWirePreview();
    state.wireSource = null;
    state.wirePreview = null;
    statusMsg('Cable conectado');
  }

  function cancelWire() {
    if (state.wireSource && state.wireSource.el) {
      state.wireSource.el.classList.remove('active-source');
    }
    state.wireSource = null;
    state.wirePreview = null;
    clearWirePreview();
    statusMsg('Conexión cancelada');
  }

  // =========================================================
  // Graph-based circuit simulation
  // =========================================================
  function getProtoEdges() {
    var edges = [];
    // Power rails: each column is a vertical bus connecting all rows
    [0, 1, 13, 14].forEach(function (col) {
      for (var r = 0; r < PROTO_ROWS - 1; r++) {
        edges.push({ from: { row: r, col: col }, to: { row: r + 1, col: col } });
      }
    });
    // Left terminal strip: cols 2-6, rows 0-4 connected, rows 5-9 connected
    for (var col = 2; col <= 6; col++) {
      for (var r = 0; r < 4; r++) {
        edges.push({ from: { row: r, col: col }, to: { row: r + 1, col: col } });
      }
      for (var r = 5; r < 9; r++) {
        edges.push({ from: { row: r, col: col }, to: { row: r + 1, col: col } });
      }
    }
    // Right terminal strip: cols 8-12, rows 0-4 connected, rows 5-9 connected
    for (var col = 8; col <= 12; col++) {
      for (var r = 0; r < 4; r++) {
        edges.push({ from: { row: r, col: col }, to: { row: r + 1, col: col } });
      }
      for (var r = 5; r < 9; r++) {
        edges.push({ from: { row: r, col: col }, to: { row: r + 1, col: col } });
      }
    }
    return edges;
  }

  function buildGraph() {
    var graph = {};
    function addEdge(a, b) {
      if (!graph[a]) graph[a] = [];
      if (!graph[b]) graph[b] = [];
      if (graph[a].indexOf(b) === -1) graph[a].push(b);
      if (graph[b].indexOf(a) === -1) graph[b].push(a);
    }

    // Wire connections
    state.wires.forEach(function (w) {
      addEdge(w.from.portId, w.to.portId);
    });

    // Component internal connections
    state.components.forEach(function (c) {
      if (c.type === 'led') {
        var aid = 'comp:' + c.compId + ':A';
        var kid = 'comp:' + c.compId + ':K';
        addEdge(aid, kid);
      } else if (c.type === 'resistor') {
        var lid = 'comp:' + c.compId + ':L';
        var rid = 'comp:' + c.compId + ':R';
        addEdge(lid, rid);
      }
    });

    // Protoboard connections: each port sits on a hole cell → connect port to its hole
    state.components.forEach(function (c) {
      for (var pn in c.ports) {
        var p = c.ports[pn];
        if (p.el && p.el.dataset.portId) {
          var holeKey = 'hole:' + p.row + ',' + p.col;
          addEdge(p.el.dataset.portId, holeKey);
        }
      }
    });

    // Arduino pins connect to their virtual "hole" in the circuit
    // We treat pin:XX as connected to hole:pin/XX in the graph
    // For simulation: HIGH pins are sources, GND is sink

    // Protoboard internal edges
    getProtoEdges().forEach(function (e) {
      var a = 'hole:' + e.from.row + ',' + e.from.col;
      var b = 'hole:' + e.to.row + ',' + e.to.col;
      addEdge(a, b);
    });

    return graph;
  }

  function areConnected(graph, start, target, visited) {
    if (start === target) return true;
    if (!graph[start]) return false;
    visited = visited || {};
    if (visited[start]) return false;
    visited[start] = true;
    for (var i = 0; i < graph[start].length; i++) {
      if (areConnected(graph, graph[start][i], target, visited)) return true;
    }
    return false;
  }

  function updateCircuitLights() {
    var graph = buildGraph();

    // Find which pins are HIGH
    var highPorts = [];
    for (var pin in state.pinStates) {
      if (state.pinStates[pin] === 'HIGH') {
        highPorts.push('pin:' + pin);
      }
    }

    // GND is always active
    var groundPorts = ['pin:GND'];

    // For each LED, check anode → HIGH and cathode → GND
    state.components.forEach(function (c) {
      if (c.type !== 'led') return;
      var aid = 'comp:' + c.compId + ':A';
      var kid = 'comp:' + c.compId + ':K';
      var bulb = c.el && c.el.querySelector('.led-bulb');
      if (!bulb) return;

      var anodeHigh = false;
      highPorts.forEach(function (hp) {
        if (areConnected(graph, aid, hp)) anodeHigh = true;
      });
      var cathodeGnd = false;
      groundPorts.forEach(function (gp) {
        if (areConnected(graph, kid, gp)) cathodeGnd = true;
      });

      if (anodeHigh && cathodeGnd) {
        bulb.classList.add('on');
      } else {
        bulb.classList.remove('on');
      }
    });
  }

  // =========================================================
  // Drag & Drop from palette
  // =========================================================
  function initDragDrop() {
    var items = dom.palette.querySelectorAll('[data-component]');
    items.forEach(function (item) {
      item.addEventListener('mousedown', function (e) {
        if (state.simulating) return;
        startDrag(e, item.dataset.component);
      });
      item.addEventListener('touchstart', function (e) {
        if (state.simulating) return;
        startDrag(e, item.dataset.component);
      }, { passive: false });
    });

    var wireItems = dom.palette.querySelectorAll('[data-wire-color]');
    wireItems.forEach(function (item) {
      item.addEventListener('click', function () {
        if (state.simulating) return;
        state.wireColor = this.dataset.wireColor;
        wireItems.forEach(function (w) { w.style.borderColor = 'var(--border)'; });
        this.style.borderColor = 'var(--primary)';
        statusMsg('Color cable: ' + colorName(state.wireColor));
      });
    });

    function colorName(c) {
      return { '#ef4444': 'Rojo', '#1e293b': 'Negro', '#3b82f6': 'Azul', '#22c55e': 'Verde' }[c] || c;
    }
  }

  function startDrag(e, type) {
    if (state.dragActive) return;
    state.dragActive = true;

    var cx = e.clientX || (e.touches && e.touches[0].clientX);
    var cy = e.clientY || (e.touches && e.touches[0].clientY);
    if (cx === undefined || cy === undefined) return;

    var ghost = document.createElement('div');
    ghost.style.cssText = 'position:fixed;z-index:1000;pointer-events:none;opacity:0.85;' +
      'width:80px;transform:scale(1.1);box-shadow:0 8px 24px rgba(0,0,0,0.2);' +
      'background:#f1f5f9;border:1px solid #e2e8f0;border-radius:8px;padding:10px 8px;' +
      'display:flex;flex-direction:column;align-items:center;gap:6px;font-size:0.75rem;font-weight:600;';
    ghost.textContent = compName(type) || type;
    ghost.style.left = (cx - 40) + 'px';
    ghost.style.top = (cy - 20) + 'px';
    document.body.appendChild(ghost);

    function move(ev) {
      var mx = ev.clientX || (ev.touches && ev.touches[0].clientX);
      var my = ev.clientY || (ev.touches && ev.touches[0].clientY);
      if (mx === undefined) return;
      ghost.style.left = (mx - 40) + 'px';
      ghost.style.top = (my - 20) + 'px';
      highlightHole(mx, my);
    }

    function up(ev) {
      var mx = ev.clientX || (ev.changedTouches && ev.changedTouches[0].clientX);
      var my = ev.clientY || (ev.changedTouches && ev.changedTouches[0].clientY);
      ghost.remove();
      clearHoleHighlights();

      if (mx !== undefined) {
        var near = nearestHole(mx, my);
        if (near) {
          dropComp(type, near.row, near.col);
        } else {
          var spawn = getSafeSpawnPosition(type);
          var spawnNear = nearestHoleFromPoint(spawn.x, spawn.y);
          if (spawnNear) {
            dropComp(type, spawnNear.row, spawnNear.col);
          } else {
            var c = type === 'button' ? 2 : 3;
            dropComp(type, 1, c);
          }
          statusMsg(compName(type) + ' colocado cerca de la protoboard');
        }
      }

      state.dragActive = false;
      document.removeEventListener('mousemove', move);
      document.removeEventListener('mouseup', up);
      document.removeEventListener('touchmove', move);
      document.removeEventListener('touchend', up);
    }

    document.addEventListener('mousemove', move);
    document.addEventListener('mouseup', up);
    document.addEventListener('touchmove', move, { passive: false });
    document.addEventListener('touchend', up, { passive: false });
  }

  function nearestHoleFromPoint(canvasX, canvasY) {
    if (!dom.workspaceCanvas) return null;
    var canvasRect = dom.workspaceCanvas.getBoundingClientRect();
    return nearestHole(canvasX + canvasRect.left, canvasY + canvasRect.top);
  }

  function nearestHole(cx, cy) {
    var best = null, bestDist = Infinity;
    dom.protoGrid.querySelectorAll('.proto-cell').forEach(function (cell) {
      var r = cell.getBoundingClientRect();
      var x = r.left + r.width / 2, y = r.top + r.height / 2;
      var d = Math.sqrt((cx - x) * (cx - x) + (cy - y) * (cy - y));
      if (d < bestDist) { bestDist = d; best = { row: +cell.dataset.row, col: +cell.dataset.col, el: cell }; }
    });
    return bestDist < 150 ? best : null;
  }

  function highlightHole(cx, cy) {
    clearHoleHighlights();
    var n = nearestHole(cx, cy);
    if (n && n.el) n.el.classList.add('snap-active');
  }

  function clearHoleHighlights() {
    dom.protoGrid.querySelectorAll('.snap-active').forEach(function (c) { c.classList.remove('snap-active'); });
  }

  function dropComp(type, row, col) {
    var extra = type === 'led' ? { color: '#ef4444' } : {};
    var c = col;
    if (type === 'led' || type === 'resistor') {
      c = col < 4 ? 3 : (col > 10 ? 3 : col);
    } else if (type === 'button') {
      c = col < 4 ? 2 : (col > 10 ? 2 : col);
    }
    if (c === GAP_COL) { c = type === 'button' ? 2 : 3; }
    if (c < 0) c = 0;
    if (c >= PROTO_COLS) c = PROTO_COLS - 1;
    // Ensure right leg doesn't exceed protoboard
    var span = COMP_SPAN[type] || 1;
    if (c + span >= PROTO_COLS) c = PROTO_COLS - 1 - span;
    var el = placeComp(type, row, c, extra);
    if (el) statusMsg(compName(type) + ' colocado en fila ' + (row + 1));
  }

  // =========================================================
  // Hole Click — creates wire points or deselects
  // =========================================================
  function onHoleClick(cell) {
    if (state.simulating) return;

    // If wire source is active, add an intermediate point
    if (state.wireSource) {
      // Create a synthetic event to add point
      var svg = dom.wiresSvg;
      if (!svg) return;
      var rect = cell.getBoundingClientRect();
      var svgRect = svg.getBoundingClientRect();
      var fakeEvent = {
        clientX: rect.left + rect.width / 2,
        clientY: rect.top + rect.height / 2,
      };
      addWirePreviewPoint(fakeEvent);
      updateWirePreview(fakeEvent.clientX, fakeEvent.clientY);
      return;
    }

    // No wire source: deselect
    deselectComponent();
  }

  // =========================================================
  // LED Color Picker
  // =========================================================
  function showColorPicker(compEl, extra) {
    var old = document.querySelector('.color-picker-popup');
    if (old) old.remove();

    var rect = compEl.getBoundingClientRect();

    var pop = document.createElement('div');
    pop.className = 'color-picker-popup';
    pop.style.position = 'fixed';
    pop.style.zIndex = '30';
    pop.style.left = (rect.left + rect.width / 2 - 65) + 'px';
    pop.style.top = (rect.top - 70) + 'px';

    LED_COLORS.forEach(function (c) {
      var opt = document.createElement('div');
      opt.className = 'color-option';
      if (c.value === (extra.color || '#ef4444')) opt.classList.add('selected');
      opt.style.background = c.value;
      opt.addEventListener('click', function (e) {
        e.stopPropagation();
        var bulb = compEl.querySelector('.led-bulb');
        if (bulb) {
          bulb.style.background = c.value;
          bulb.style.setProperty('--led-color', c.value);
          extra.color = c.value;
        }
        pop.remove();
        statusMsg('Color LED: ' + c.name);
      });
      pop.appendChild(opt);
    });

    document.body.appendChild(pop);

    setTimeout(function () {
      var handler = function (e) {
        if (!pop.contains(e.target)) { pop.remove(); document.removeEventListener('click', handler); }
      };
      document.addEventListener('click', handler);
    }, 0);
  }

  // =========================================================
  // Load Example
  // =========================================================
  function loadExample(idx) {
    if (state.simulating) stopSim();
    clearCircuit();
    var ex = examples[idx];
    if (!ex) return;

    state.currentExample = idx;
    setHighlightedCode(ex.code);

    // Place components
    (ex.circuit.components || []).forEach(function (c) {
      placeComp(c.type, c.row, c.col, c.extra || {});
    });

    // Draw wires — format: { from: 'D13'|{port:N,id:'A'}, to: same, color }
    (ex.circuit.wires || []).forEach(function (w) {
      var fromPortId = resolveWirePort(w.from);
      var toPortId = resolveWirePort(w.to);
      if (!fromPortId || !toPortId) return;

      var fromEl = dom.arduinoBoard.querySelector('[data-port-id="' + fromPortId + '"]') ||
                   dom.protoBoard.querySelector('[data-port-id="' + fromPortId + '"]');
      var toEl = dom.arduinoBoard.querySelector('[data-port-id="' + toPortId + '"]') ||
                 dom.protoBoard.querySelector('[data-port-id="' + toPortId + '"]');

      if (!fromEl || !toEl || !dom.wiresSvg) return;

      var fromPos = centerRel(fromEl, dom.wiresSvg);
      var toPos = centerRel(toEl, dom.wiresSvg);
      if (!fromPos || !toPos) return;

      // Draw using the same path as manual wires
      var allPoints = [fromPos, toPos];
      var group = document.createElementNS('http://www.w3.org/2000/svg', 'g');
      group.setAttribute('class', 'wire-group');

      var pathData = buildPolylinePath(allPoints);
      var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
      path.setAttribute('d', pathData);
      path.setAttribute('stroke', w.color);
      path.setAttribute('stroke-width', '2.5');
      path.setAttribute('fill', 'none');
      path.setAttribute('stroke-linecap', 'round');
      path.setAttribute('stroke-linejoin', 'round');
      path.style.pointerEvents = 'auto';
      path.style.cursor = 'pointer';
      path.dataset.wireIndex = state.wires.length;

      path.addEventListener('click', function (e) {
        e.stopPropagation();
        if (state.simulating) return;
        var wi = parseInt(this.dataset.wireIndex, 10);
        state.selectedWire = wi;
        deselectComponent();
        updateWires();
      });

      path.addEventListener('dblclick', function (e) {
        e.stopPropagation();
        if (state.simulating) return;
        var wi = parseInt(this.dataset.wireIndex, 10);
        deleteWire(wi);
      });

      group.appendChild(path);

      [fromPos, toPos].forEach(function (pt) {
        var dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
        dot.setAttribute('cx', pt.x.toFixed(1));
        dot.setAttribute('cy', pt.y.toFixed(1));
        dot.setAttribute('r', '4');
        dot.setAttribute('fill', w.color);
        dot.setAttribute('stroke', '#fff');
        dot.setAttribute('stroke-width', '1.5');
        group.appendChild(dot);
      });

      dom.wiresSvg.appendChild(group);

      state.wires.push({
        from: { portId: fromPortId, el: fromEl },
        to: { portId: toPortId, el: toEl },
        color: w.color,
        el: group,
        points: [],
      });
    });

    statusMsg('Ejemplo cargado: ' + ex.name);
  }

  function resolveWirePort(ref) {
    if (typeof ref === 'string') {
      // Arduino pin reference
      return 'pin:' + ref;
    }
    if (ref && typeof ref === 'object') {
      // Component port reference: { port: N, id: 'A' }
      var idx = ref.port;
      var pid = ref.id;
      if (idx >= 0 && idx < state.components.length) {
        var c = state.components[idx];
        if (c.ports && c.ports[pid] && c.ports[pid].el) {
          return c.ports[pid].el.dataset.portId;
        }
      }
    }
    return null;
  }

  // =========================================================
  // Clear Circuit
  // =========================================================
  function clearCircuit() {
    if (state.simulating) stopSim();

    state.components.forEach(function (c) { if (c.el && c.el.parentNode) c.el.parentNode.removeChild(c.el); });
    state.components = [];

    state.wires.forEach(function (w) { if (w.el && w.el.parentNode) w.el.parentNode.removeChild(w.el); });
    state.wires = [];

    if (dom.arduinoBoard) {
      dom.arduinoBoard.querySelectorAll('.connected, .active-source').forEach(function (p) {
        p.classList.remove('connected', 'active-source');
      });
    }

    cancelWire();
    state.selectedComponent = null;
    state.selectedWire = null;
    state.currentExample = null;
    state.compCounter = 0;
    state.pinStates = {};
    if (dom.codeDisplay) dom.codeDisplay.innerHTML = '<span class="syntax-comment">// Carga un ejemplo para ver el c\u00F3digo aqu\u00ED</span>';
    statusMsg('Circuito limpiado');
  }

  // =========================================================
  // Start / Stop Simulation
  // =========================================================
  function startSim() {
    if (state.simulating) return;
    var idx = state.currentExample;
    if (idx === null || idx === undefined) { statusMsg('Carga un ejemplo primero', 'error'); return; }
    var ex = examples[idx];
    if (!ex) { statusMsg('Ejemplo inv\u00E1lido', 'error'); return; }

    // Reset pin states to LOW
    state.pinStates = {};
    'D0,D1,D2,D3,D4,D5,D6,D7,D8,D9,D10,D11,D12,D13,A0,A1,A2,A3,A4,A5,5V,3V3,GND,Vin'.split(',').forEach(function (id) {
      state.pinStates[id] = 'LOW';
    }); // GND is always implicitly LOW/connected

    state.simulating = true;
    dom.simBtn.textContent = '\u23F9 Detener';
    dom.simBtn.className = 'sim-btn sim-btn-danger';
    dom.simBtn.onclick = stopSim;

    dom.palette.style.opacity = '0.5';
    dom.palette.style.pointerEvents = 'none';

    statusMsg('Simulando: ' + ex.name, 'running');

    try {
      ex.run(function () {});
    } catch (err) {
      statusMsg('Error: ' + err.message, 'error');
      stopSim();
    }
  }

  function stopSim() {
    state.simulating = false;

    state.simulationTimers.forEach(function (t) { clearInterval(t); clearTimeout(t); });
    state.simulationTimers = [];

    state.simListeners.forEach(function (l) {
      if (l.el && l.el.parentNode) l.el.removeEventListener(l.type, l.fn);
    });
    state.simListeners = [];

    state.pinStates = {};

    dom.protoBoard.querySelectorAll('.led-bulb.on').forEach(function (b) { b.classList.remove('on'); });
    dom.protoBoard.querySelectorAll('.button-cap.pressed').forEach(function (b) { b.classList.remove('pressed'); b.style.cursor = ''; });

    statusMsg('Simulaci\u00F3n detenida', 'idle');

    dom.simBtn.textContent = '\u25B6 Simular';
    dom.simBtn.className = 'sim-btn sim-btn-success';
    dom.simBtn.onclick = startSim;

    dom.palette.style.opacity = '';
    dom.palette.style.pointerEvents = '';
  }

  // =========================================================
  // Init
  // =========================================================
  function init() {
    dom.palette = document.querySelector('.sim-palette');
    dom.workspace = document.querySelector('.sim-workspace');
    dom.workspaceCanvas = document.querySelector('.workspace-canvas');
    dom.arduinoContainer = document.getElementById('arduino-container');
    dom.protoContainer = document.getElementById('protoboard-container');
    dom.codeDisplay = document.getElementById('code-display');
    dom.statusMsg = document.getElementById('status-msg');
    dom.statusDot = document.getElementById('status-dot');
    dom.simBtn = document.getElementById('btn-simulate');
    dom.exampleSelect = document.getElementById('example-select');
    dom.btnClear = document.getElementById('btn-clear');

    if (!dom.arduinoContainer || !dom.protoContainer || !dom.workspaceCanvas) {
      console.error('Missing required DOM elements');
      return;
    }

    buildArduino();
    buildProtoboard();
    initDragDrop();

    var defWire = dom.palette.querySelector('[data-wire-color="#3b82f6"]');
    if (defWire) { defWire.style.borderColor = 'var(--primary)'; state.wireColor = '#3b82f6'; }

    if (dom.exampleSelect) {
      dom.exampleSelect.addEventListener('change', function () {
        var v = parseInt(this.value, 10);
        if (!isNaN(v) && v >= 0) loadExample(v);
      });
    }

    if (dom.simBtn) dom.simBtn.onclick = startSim;

    if (dom.btnClear) dom.btnClear.addEventListener('click', clearCircuit);

    // Click workspace background
    dom.workspace.addEventListener('click', function (e) {
      // If click is directly on workspace (not a child), deselect
      if (e.target === dom.workspace || e.target === dom.workspaceCanvas) {
        if (state.selectedComponent) {
          state.selectedComponent.classList.remove('selected');
          state.selectedComponent = null;
        }
        if (state.wireSource) cancelWire();
        deselectWire();
        var picker = document.querySelector('.color-picker-popup');
        if (picker) picker.remove();
      }
    });

    // Mouse move → wire preview
    document.addEventListener('mousemove', function (e) {
      if (state.wireSource && !state.dragActive) {
        updateWirePreview(e.clientX, e.clientY);
      }
      // Drag wire point
      if (state.draggingWirePoint !== null) {
        var dwp = state.draggingWirePoint;
        var w = state.wires[dwp.wireIndex];
        if (w && w.points && w.points[dwp.pointIndex] && dom.wiresSvg) {
          var svgRect = dom.wiresSvg.getBoundingClientRect();
          w.points[dwp.pointIndex].x = e.clientX - svgRect.left;
          w.points[dwp.pointIndex].y = e.clientY - svgRect.top;
          updateWires();
        }
      }
    });

    // Mouse up → stop dragging wire point
    document.addEventListener('mouseup', function () {
      if (state.draggingWirePoint !== null) {
        state.draggingWirePoint = null;
        statusMsg('Punto del cable ajustado');
      }
    });

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        if (state.wireSource) cancelWire();
        var picker = document.querySelector('.color-picker-popup');
        if (picker) picker.remove();
      }
      // Delete selected wire with Delete/Backspace (when not editing text)
      if ((e.key === 'Delete' || e.key === 'Backspace') && state.selectedWire !== null) {
        var activeTag = document.activeElement ? document.activeElement.tagName.toLowerCase() : '';
        if (!['textarea', 'input', 'select'].includes(activeTag)) {
          e.preventDefault();
          deleteWire(state.selectedWire);
        }
      }
    });

    if (dom.codeDisplay) dom.codeDisplay.innerHTML = '<span class="syntax-comment">// Carga un ejemplo para ver el c\u00F3digo aqu\u00ED</span>';
    updateInspector();
    statusMsg('Listo \u2014 arrastra componentes o carga un ejemplo');
    console.log('Arduino Simulator initialized');
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

})();
