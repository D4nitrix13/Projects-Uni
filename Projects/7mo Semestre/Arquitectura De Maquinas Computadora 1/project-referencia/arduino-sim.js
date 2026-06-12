const labCanvas = document.getElementById("labCanvas");
const wireLayer = document.getElementById("wireLayer");
const emptyHint = document.getElementById("emptyHint");
const consoleOutput = document.getElementById("consoleOutput");
const labStatus = document.getElementById("labStatus");
const arduinoCode = document.getElementById("arduinoCode");
const wireColor = document.getElementById("wireColor");

const runSimulationButton = document.getElementById("runSimulation");
const stopSimulationButton = document.getElementById("stopSimulation");
const clearCircuitButton = document.getElementById("clearCircuit");
const exampleBlink13Button = document.getElementById("exampleBlink13");
const exampleBlink8Button = document.getElementById("exampleBlink8");

const components = new Map();
let wires = [];
let componentCounter = 0;
let selectedPortId = null;
let selectedComponentId = null;
let selectedWireIndex = null;
let dragging = null;
let draggingWirePoint = null;
let previewPoint = null;
let draftWirePoints = [];
let simulationRunning = false;
let simulationTimer = null;
let pinStates = {};

const defaultPositions = {
  arduino: { x: 90, y: 280 },
  led: { x: 680, y: 160 },
  resistor: { x: 485, y: 355 }
};

const ledColorNames = {
  red: "rojo",
  green: "verde",
  orange: "naranja",
  yellow: "amarillo",
  purple: "morado"
};

function writeConsole(message) {
  consoleOutput.textContent = message;
}

function appendConsole(message) {
  consoleOutput.textContent += "\n" + message;
}

function setStatus(message, type = "normal") {
  labStatus.textContent = message;
  labStatus.classList.remove("ok", "error");

  if (type === "ok") {
    labStatus.classList.add("ok");
  }

  if (type === "error") {
    labStatus.classList.add("error");
  }
}

function updateEmptyHint() {
  emptyHint.style.display = components.size === 0 ? "block" : "none";
}

function escapeSelectorValue(value) {
  if (window.CSS && typeof window.CSS.escape === "function") {
    return window.CSS.escape(value);
  }

  return value.replace(/"/g, '\\"');
}

function capitalize(text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
}

function getCanvasWidth() {
  return labCanvas.clientWidth || labCanvas.offsetWidth || 900;
}

function getCanvasHeight() {
  return labCanvas.clientHeight || labCanvas.offsetHeight || 650;
}

function clampComponentPosition(component) {
  const maxX = Math.max(0, getCanvasWidth() - component.element.offsetWidth - 8);
  const maxY = Math.max(0, getCanvasHeight() - component.element.offsetHeight - 8);

  component.x = Math.min(maxX, Math.max(0, component.x));
  component.y = Math.min(maxY, Math.max(0, component.y));

  component.element.style.left = `${component.x}px`;
  component.element.style.top = `${component.y}px`;
}

function clearPortSelection() {
  selectedPortId = null;
  previewPoint = null;
  draftWirePoints = [];

  labCanvas.querySelectorAll(".lab-port").forEach((port) => {
    port.classList.remove("selected");
  });

  updateWires();
}

function clearElementSelection() {
  selectedComponentId = null;
  selectedWireIndex = null;

  labCanvas.querySelectorAll(".lab-component").forEach((component) => {
    component.classList.remove("selected");
  });

  updateWires();
}

function clearAllSelections() {
  clearPortSelection();
  clearElementSelection();
}

function selectComponent(componentId) {
  selectedWireIndex = null;
  selectedComponentId = componentId;

  labCanvas.querySelectorAll(".lab-component").forEach((component) => {
    component.classList.toggle("selected", component.dataset.componentId === componentId);
  });

  const component = components.get(componentId);

  if (component && component.type === "led") {
    setStatus("LED seleccionado. Usa el selector que aparece debajo para cambiar su color.", "ok");
  }

  updateWires();
}

function selectWire(index) {
  clearPortSelection();
  selectedComponentId = null;
  selectedWireIndex = index;

  labCanvas.querySelectorAll(".lab-component").forEach((component) => {
    component.classList.remove("selected");
  });

  updateWires();
  setStatus("Cable seleccionado. Puedes mover sus puntos blancos o presionar Supr/Delete para eliminarlo.");
}

function getComponentName(type) {
  const names = {
    arduino: "Arduino Uno R3",
    led: "LED",
    resistor: "Resistencia 220Ω"
  };

  return names[type] || "Componente";
}

function getLedColorOptions(selectedColor) {
  return Object.entries(ledColorNames)
    .map(([value, label]) => {
      const selected = value === selectedColor ? "selected" : "";
      return `<option value="${value}" ${selected}>${capitalize(label)}</option>`;
    })
    .join("");
}

function findFirstComponentByType(type) {
  for (const component of components.values()) {
    if (component.type === type) {
      return component;
    }
  }

  return null;
}

function createComponent(type) {
  if (type === "arduino" && findFirstComponentByType("arduino")) {
    writeConsole("Ya existe una placa Arduino en el área de trabajo.");
    setStatus("Solo se permite una placa Arduino para este simulador.", "error");
    return;
  }

  const id = `${type}-${++componentCounter}`;
  const basePosition = defaultPositions[type] || { x: 120, y: 120 };
  const offset = Math.min(componentCounter * 10, 36);
  const selectedLedColor = type === "led" ? "red" : null;

  const component = {
    id,
    type,
    x: basePosition.x + offset,
    y: basePosition.y + offset,
    ledColor: selectedLedColor,
    element: document.createElement("div")
  };

  component.element.className = `lab-component lab-${type}`;
  component.element.dataset.componentId = id;
  component.element.dataset.type = type;

  if (type === "led") {
    component.element.classList.add(`lab-led-color-${selectedLedColor}`);
  }

  component.element.style.left = `${component.x}px`;
  component.element.style.top = `${component.y}px`;
  component.element.innerHTML = getComponentTemplate(type, id, component);

  labCanvas.appendChild(component.element);
  components.set(id, component);

  clampComponentPosition(component);
  updateEmptyHint();
  updateWireLayerSize();
  updateWires();
  selectComponent(id);

  writeConsole(`Componente agregado: ${getComponentName(type)}.`);
  setStatus(`Componente agregado: ${getComponentName(type)}.`, "ok");
}

function getArduinoTemplate(id) {
  return `
    <div class="lab-component-header">Arduino Uno R3</div>

    <div class="lab-arduino-usb"></div>
    <div class="lab-arduino-jack"></div>
    <div class="lab-arduino-reset"></div>
    <div class="lab-arduino-crystal"></div>

    <div class="lab-board-screw screw-one"></div>
    <div class="lab-board-screw screw-two"></div>
    <div class="lab-board-screw screw-three"></div>

    <div class="lab-arduino-brand">
      <span class="lab-infinity">∞</span>
      <strong>Arduino</strong>
    </div>

    <div class="lab-arduino-title">
      UNO
      <small>R3</small>
    </div>

    <div class="lab-chip">ATmega328P</div>
    <div class="lab-pin-header top"></div>
    <div class="lab-pin-header bottom"></div>
    <div class="lab-power-header"></div>
    <span class="lab-arduino-pin-title top-title">DIGITAL</span>
    <span class="lab-arduino-pin-title bottom-title">POWER / DIGITAL</span>

    <button type="button" class="lab-port ground" data-port-id="${id}:GND" data-port-label="GND" style="left: 31px; top: 185px;" title="GND">G</button>
    <button type="button" class="lab-port power" data-port-id="${id}:5V" data-port-label="5V" style="left: 68px; top: 185px;" title="5V">5</button>

    <button type="button" class="lab-port" data-port-id="${id}:D8" data-port-label="D8" style="left: 185px; top: 20px;" title="Pin digital 8">8</button>
    <button type="button" class="lab-port" data-port-id="${id}:D9" data-port-label="D9" style="left: 211px; top: 20px;" title="Pin digital 9">9</button>
    <button type="button" class="lab-port" data-port-id="${id}:D10" data-port-label="D10" style="left: 237px; top: 20px;" title="Pin digital 10">10</button>
    <button type="button" class="lab-port" data-port-id="${id}:D11" data-port-label="D11" style="left: 263px; top: 20px;" title="Pin digital 11">11</button>
    <button type="button" class="lab-port" data-port-id="${id}:D12" data-port-label="D12" style="left: 289px; top: 20px;" title="Pin digital 12">12</button>
    <button type="button" class="lab-port" data-port-id="${id}:D13" data-port-label="D13" style="left: 315px; top: 20px;" title="Pin digital 13">13</button>

    <button type="button" class="lab-port" data-port-id="${id}:D2" data-port-label="D2" style="left: 185px; top: 185px;" title="Pin digital 2">2</button>
    <button type="button" class="lab-port" data-port-id="${id}:D3" data-port-label="D3" style="left: 211px; top: 185px;" title="Pin digital 3">3</button>
    <button type="button" class="lab-port" data-port-id="${id}:D4" data-port-label="D4" style="left: 237px; top: 185px;" title="Pin digital 4">4</button>
    <button type="button" class="lab-port" data-port-id="${id}:D5" data-port-label="D5" style="left: 263px; top: 185px;" title="Pin digital 5">5</button>
    <button type="button" class="lab-port" data-port-id="${id}:D6" data-port-label="D6" style="left: 289px; top: 185px;" title="Pin digital 6">6</button>
    <button type="button" class="lab-port" data-port-id="${id}:D7" data-port-label="D7" style="left: 315px; top: 185px;" title="Pin digital 7">7</button>
  `;
}

function getLedTemplate(id, component) {
  const selectedColor = component.ledColor || "red";

  return `
    <div class="lab-component-header">LED</div>

    <div class="lab-led-bulb" data-led-bulb="true"></div>
    <div class="lab-led-flat-side"></div>
    <div class="lab-led-leg long"></div>
    <div class="lab-led-leg short"></div>
    <div class="lab-led-name">LED</div>

    <label class="lab-led-control">
      <span>Color</span>
      <select data-led-color-select="true" data-component-id="${id}" aria-label="Cambiar color del LED">
        ${getLedColorOptions(selectedColor)}
      </select>
    </label>

    <button type="button" class="lab-port" data-port-id="${id}:A" data-port-label="A" style="left: 48px; top: 138px;" title="Ánodo A">A</button>
    <button type="button" class="lab-port ground" data-port-id="${id}:K" data-port-label="K" style="left: 82px; top: 126px;" title="Cátodo K">K</button>
  `;
}

function getResistorTemplate(id) {
  return `
    <div class="lab-component-header">Resistencia 220Ω</div>

    <div class="lab-resistor-line"></div>
    <div class="lab-resistor-body">
      <span class="band band-one"></span>
      <span class="band band-two"></span>
      <span class="band band-three"></span>
      <span class="band band-four"></span>
    </div>
    <div class="lab-resistor-name">220Ω</div>

    <button type="button" class="lab-port" data-port-id="${id}:L" data-port-label="L" style="left: 0; top: 28px;" title="Terminal izquierda">L</button>
    <button type="button" class="lab-port" data-port-id="${id}:R" data-port-label="R" style="right: 0; top: 28px;" title="Terminal derecha">R</button>
  `;
}

function getComponentTemplate(type, id, component = {}) {
  if (type === "arduino") {
    return getArduinoTemplate(id);
  }

  if (type === "led") {
    return getLedTemplate(id, component);
  }

  if (type === "resistor") {
    return getResistorTemplate(id);
  }

  return "";
}

function getPortElement(portId) {
  return labCanvas.querySelector(`[data-port-id="${escapeSelectorValue(portId)}"]`);
}

function getPortCenter(portId) {
  const port = getPortElement(portId);

  if (!port) {
    return null;
  }

  const portRect = port.getBoundingClientRect();
  const canvasRect = labCanvas.getBoundingClientRect();

  return {
    x: portRect.left + portRect.width / 2 - canvasRect.left,
    y: portRect.top + portRect.height / 2 - canvasRect.top
  };
}

function getCanvasPointFromEvent(event) {
  const canvasRect = labCanvas.getBoundingClientRect();

  return {
    x: event.clientX - canvasRect.left,
    y: event.clientY - canvasRect.top
  };
}

function updateWireLayerSize() {
  const width = getCanvasWidth();
  const height = getCanvasHeight();

  wireLayer.setAttribute("width", width);
  wireLayer.setAttribute("height", height);
  wireLayer.setAttribute("viewBox", `0 0 ${width} ${height}`);
}

function buildPolylinePath(points) {
  if (points.length === 0) {
    return "";
  }

  const [firstPoint, ...restPoints] = points;
  let pathData = `M ${firstPoint.x} ${firstPoint.y}`;

  restPoints.forEach((point) => {
    pathData += ` L ${point.x} ${point.y}`;
  });

  return pathData;
}

function getWirePoints(wire) {
  const start = getPortCenter(wire.from);
  const end = getPortCenter(wire.to);

  if (!start || !end) {
    return [];
  }

  return [start, ...(wire.points || []), end];
}

function getDraftWirePoints() {
  const start = getPortCenter(selectedPortId);

  if (!start || !previewPoint) {
    return [];
  }

  return [start, ...draftWirePoints, previewPoint];
}

function createSvgElement(tagName) {
  return document.createElementNS("http://www.w3.org/2000/svg", tagName);
}

function createWireEndCircle(point, color) {
  const circle = createSvgElement("circle");

  circle.setAttribute("cx", point.x);
  circle.setAttribute("cy", point.y);
  circle.setAttribute("r", "5");
  circle.setAttribute("fill", color);
  circle.setAttribute("class", "lab-wire-end");
  circle.setAttribute("pointer-events", "none");

  return circle;
}

function createWireControlPoint(point, wireIndex, pointIndex) {
  const control = createSvgElement("circle");

  control.setAttribute("cx", point.x);
  control.setAttribute("cy", point.y);
  control.setAttribute("r", "7");
  control.setAttribute("fill", "#ffffff");
  control.setAttribute("stroke", "#0f172a");
  control.setAttribute("stroke-width", "2");
  control.setAttribute("cursor", "move");
  control.setAttribute("pointer-events", "all");
  control.dataset.wireIndex = wireIndex;
  control.dataset.pointIndex = pointIndex;

  control.addEventListener("pointerdown", (event) => {
    event.preventDefault();
    event.stopPropagation();

    draggingWirePoint = {
      wireIndex,
      pointIndex
    };

    selectWire(wireIndex);
    setStatus("Moviendo punto del cable. Arrástralo para acomodar la ruta.", "ok");
  });

  return control;
}

function createWireGroup(wire, index, selected = false) {
  const points = getWirePoints(wire);

  if (points.length < 2) {
    return null;
  }

  const group = createSvgElement("g");
  const pathData = buildPolylinePath(points);

  if (selected) {
    group.classList.add("lab-wire-selected");
  }

  const visiblePath = createSvgElement("path");
  visiblePath.setAttribute("d", pathData);
  visiblePath.setAttribute("class", "lab-wire-path-visible");
  visiblePath.setAttribute("stroke", wire.color);
  visiblePath.setAttribute("pointer-events", "none");

  const hitPath = createSvgElement("path");
  hitPath.setAttribute("d", pathData);
  hitPath.setAttribute("class", "lab-wire-path-hit");
  hitPath.setAttribute("pointer-events", "stroke");
  hitPath.dataset.wireIndex = index;

  hitPath.addEventListener("pointerdown", (event) => {
    event.preventDefault();
    event.stopPropagation();
    selectWire(index);
  });

  hitPath.addEventListener("dblclick", (event) => {
    event.preventDefault();
    event.stopPropagation();
    deleteWire(index);
  });

  group.appendChild(visiblePath);
  group.appendChild(createWireEndCircle(points[0], wire.color));
  group.appendChild(createWireEndCircle(points[points.length - 1], wire.color));
  group.appendChild(hitPath);

  if (selected && wire.points && wire.points.length > 0) {
    wire.points.forEach((point, pointIndex) => {
      group.appendChild(createWireControlPoint(point, index, pointIndex));
    });
  }

  return group;
}

function renderPreviewWire() {
  if (!selectedPortId || !previewPoint) {
    return;
  }

  const points = getDraftWirePoints();

  if (points.length < 2) {
    return;
  }

  const preview = createSvgElement("path");
  preview.setAttribute("d", buildPolylinePath(points));
  preview.setAttribute("class", "lab-wire-preview");
  preview.setAttribute("stroke", wireColor.value);
  preview.setAttribute("pointer-events", "none");

  wireLayer.appendChild(preview);

  draftWirePoints.forEach((point) => {
    const marker = createSvgElement("circle");

    marker.setAttribute("cx", point.x);
    marker.setAttribute("cy", point.y);
    marker.setAttribute("r", "5");
    marker.setAttribute("fill", wireColor.value);
    marker.setAttribute("stroke", "#ffffff");
    marker.setAttribute("stroke-width", "2");
    marker.setAttribute("pointer-events", "none");

    wireLayer.appendChild(marker);
  });
}

function updateWires() {
  updateWireLayerSize();
  wireLayer.innerHTML = "";

  wires.forEach((wire, index) => {
    const wireGroup = createWireGroup(wire, index, index === selectedWireIndex);

    if (wireGroup) {
      wireLayer.appendChild(wireGroup);
    }
  });

  renderPreviewWire();
}

function connectPorts(firstPortId, secondPortId) {
  if (firstPortId === secondPortId) {
    setStatus("No puedes conectar un pin consigo mismo.", "error");
    writeConsole("Error: seleccionaste el mismo pin dos veces.");
    return;
  }

  const alreadyExists = wires.some((wire) => {
    return (
      (wire.from === firstPortId && wire.to === secondPortId) ||
      (wire.from === secondPortId && wire.to === firstPortId)
    );
  });

  if (alreadyExists) {
    setStatus("Ese cable ya existe.", "error");
    writeConsole("Error: ese cable ya estaba conectado.");
    return;
  }

  wires.push({
    from: firstPortId,
    to: secondPortId,
    color: wireColor.value,
    points: draftWirePoints.map((point) => ({
      x: point.x,
      y: point.y
    }))
  });

  selectedWireIndex = null;
  draftWirePoints = [];
  previewPoint = null;

  updateWires();
  updateCircuitLights();

  setStatus("Cable conectado correctamente. Si lo seleccionas, podrás mover sus puntos intermedios.", "ok");
  writeConsole(`Cable conectado:\n${firstPortId}\n→ ${secondPortId}`);
}

function addDraftWirePoint(event) {
  if (!selectedPortId) {
    return;
  }

  const point = getCanvasPointFromEvent(event);

  draftWirePoints.push({
    x: point.x,
    y: point.y
  });

  previewPoint = point;
  updateWires();

  setStatus("Punto de ruta agregado. Sigue moviendo el cable y haz clic en otro punto o en un pin final.", "ok");
}

function handlePortClick(port, event) {
  event.preventDefault();
  event.stopPropagation();

  clearElementSelection();
  const portId = port.dataset.portId;

  if (!selectedPortId) {
    selectedPortId = portId;
    previewPoint = getCanvasPointFromEvent(event);
    draftWirePoints = [];
    port.classList.add("selected");
    updateWires();
    setStatus(`Primer punto seleccionado: ${port.dataset.portLabel}. Mueve el mouse; haz clic en el área para crear quiebres o en otro pin para conectar.`);
    return;
  }

  const firstPort = getPortElement(selectedPortId);

  if (firstPort) {
    firstPort.classList.remove("selected");
  }

  const firstPortId = selectedPortId;
  selectedPortId = null;
  previewPoint = null;

  connectPorts(firstPortId, portId);
}

function startDragging(componentElement, event) {
  if (
    event.target.closest(".lab-port") ||
    event.target.closest(".lab-led-control") ||
    event.target.closest("select") ||
    event.target.closest("button")
  ) {
    return;
  }

  const componentId = componentElement.dataset.componentId;
  const component = components.get(componentId);

  if (!component) {
    return;
  }

  clearPortSelection();
  selectComponent(componentId);

  dragging = {
    component,
    startX: event.clientX,
    startY: event.clientY,
    originalX: component.x,
    originalY: component.y
  };

  componentElement.classList.add("dragging");
}

function dragComponent(event) {
  if (!dragging) {
    return;
  }

  const deltaX = event.clientX - dragging.startX;
  const deltaY = event.clientY - dragging.startY;

  const maxX = Math.max(0, getCanvasWidth() - dragging.component.element.offsetWidth - 8);
  const maxY = Math.max(0, getCanvasHeight() - dragging.component.element.offsetHeight - 8);
  const newX = Math.min(maxX, Math.max(0, dragging.originalX + deltaX));
  const newY = Math.min(maxY, Math.max(0, dragging.originalY + deltaY));

  dragging.component.x = newX;
  dragging.component.y = newY;
  dragging.component.element.style.left = `${newX}px`;
  dragging.component.element.style.top = `${newY}px`;

  updateWires();
}

function stopDragging() {
  if (!dragging) {
    return;
  }

  dragging.component.element.classList.remove("dragging");
  dragging = null;
}

function dragWirePoint(event) {
  if (!draggingWirePoint) {
    return;
  }

  const wire = wires[draggingWirePoint.wireIndex];

  if (!wire || !wire.points || !wire.points[draggingWirePoint.pointIndex]) {
    return;
  }

  const point = getCanvasPointFromEvent(event);

  wire.points[draggingWirePoint.pointIndex] = {
    x: Math.max(0, Math.min(getCanvasWidth(), point.x)),
    y: Math.max(0, Math.min(getCanvasHeight(), point.y))
  };

  updateWires();
}

function stopDraggingWirePoint() {
  if (!draggingWirePoint) {
    return;
  }

  draggingWirePoint = null;
  setStatus("Punto del cable ajustado.", "ok");
}

function deleteWire(index) {
  if (index < 0 || index >= wires.length) {
    return;
  }

  stopSimulation();
  wires.splice(index, 1);
  selectedWireIndex = null;
  updateWires();
  updateCircuitLights();

  writeConsole("Cable eliminado.");
  setStatus("Cable eliminado.", "ok");
}

function deleteComponent(componentId) {
  const component = components.get(componentId);

  if (!component) {
    return;
  }

  stopSimulation();

  wires = wires.filter((wire) => {
    return !wire.from.startsWith(`${componentId}:`) && !wire.to.startsWith(`${componentId}:`);
  });

  component.element.remove();
  components.delete(componentId);
  selectedComponentId = null;

  updateEmptyHint();
  updateWires();
  updateCircuitLights();

  writeConsole(`Componente eliminado: ${getComponentName(component.type)}.`);
  setStatus("Componente eliminado.", "ok");
}

function clearCircuit() {
  stopSimulation();

  components.forEach((component) => {
    component.element.remove();
  });

  components.clear();
  wires = [];
  selectedPortId = null;
  selectedComponentId = null;
  selectedWireIndex = null;
  previewPoint = null;
  draftWirePoints = [];
  draggingWirePoint = null;
  pinStates = {};

  updateEmptyHint();
  updateWires();

  writeConsole("Circuito limpiado. Agrega componentes nuevamente.");
  setStatus("Circuito limpio.");
}

function changeLedColor(componentId, newColor) {
  const component = components.get(componentId);

  if (!component || component.type !== "led") {
    return;
  }

  Object.keys(ledColorNames).forEach((color) => {
    component.element.classList.remove(`lab-led-color-${color}`);
  });

  component.ledColor = newColor;
  component.element.classList.add(`lab-led-color-${newColor}`);
  updateCircuitLights();

  writeConsole(`Color del LED cambiado a ${ledColorNames[newColor]}.`);
  setStatus(`Color del LED cambiado a ${ledColorNames[newColor]}.`, "ok");
}

function buildGraph() {
  const graph = new Map();

  function addNode(node) {
    if (!graph.has(node)) {
      graph.set(node, []);
    }
  }

  function addEdge(a, b) {
    addNode(a);
    addNode(b);
    graph.get(a).push(b);
    graph.get(b).push(a);
  }

  wires.forEach((wire) => {
    addEdge(wire.from, wire.to);
  });

  components.forEach((component) => {
    if (component.type === "resistor") {
      addEdge(`${component.id}:L`, `${component.id}:R`);
    }
  });

  return graph;
}

function areConnected(graph, start, target) {
  if (start === target) {
    return true;
  }

  if (!graph.has(start)) {
    return false;
  }

  const visited = new Set();
  const stack = [start];

  while (stack.length > 0) {
    const current = stack.pop();

    if (current === target) {
      return true;
    }

    if (visited.has(current)) {
      continue;
    }

    visited.add(current);

    const neighbors = graph.get(current) || [];

    neighbors.forEach((neighbor) => {
      if (!visited.has(neighbor)) {
        stack.push(neighbor);
      }
    });
  }

  return false;
}

function getArduinoComponents() {
  return Array.from(components.values()).filter((component) => component.type === "arduino");
}

function getLedComponents() {
  return Array.from(components.values()).filter((component) => component.type === "led");
}

function getHighOutputPorts() {
  const highPorts = [];
  const arduinos = getArduinoComponents();

  arduinos.forEach((arduino) => {
    Object.entries(pinStates).forEach(([pinName, value]) => {
      if (value === "HIGH") {
        highPorts.push(`${arduino.id}:D${pinName}`);
      }
    });
  });

  return highPorts;
}

function getGroundPorts() {
  const groundPorts = [];
  const arduinos = getArduinoComponents();

  arduinos.forEach((arduino) => {
    groundPorts.push(`${arduino.id}:GND`);
  });

  return groundPorts;
}

function updateCircuitLights() {
  const graph = buildGraph();
  const highPorts = getHighOutputPorts();
  const groundPorts = getGroundPorts();
  const leds = getLedComponents();

  leds.forEach((led) => {
    const anode = `${led.id}:A`;
    const cathode = `${led.id}:K`;

    const anodeHasHighSignal = highPorts.some((highPort) => {
      return areConnected(graph, anode, highPort);
    });

    const cathodeHasGround = groundPorts.some((groundPort) => {
      return areConnected(graph, cathode, groundPort);
    });

    const ledBulb = led.element.querySelector("[data-led-bulb='true']");

    if (!ledBulb) {
      return;
    }

    if (anodeHasHighSignal && cathodeHasGround) {
      ledBulb.classList.add("on");
    } else {
      ledBulb.classList.remove("on");
    }
  });
}

function cleanCode(code) {
  return code
    .replace(/\/\/.*$/gm, "")
    .replace(/\/\*[\s\S]*?\*\//g, "");
}

function extractLoopBody(code) {
  const loopMatch = /void\s+loop\s*\(\s*\)\s*\{/i.exec(code);

  if (!loopMatch) {
    return null;
  }

  let index = loopMatch.index + loopMatch[0].length;
  let braceCount = 1;
  let body = "";

  while (index < code.length) {
    const char = code[index];

    if (char === "{") {
      braceCount++;
    }

    if (char === "}") {
      braceCount--;

      if (braceCount === 0) {
        break;
      }
    }

    body += char;
    index++;
  }

  return body;
}

function parsePinModes(code) {
  const outputPins = new Set();
  const regex = /pinMode\s*\(\s*(\d+)\s*,\s*OUTPUT\s*\)/gi;
  let match = regex.exec(code);

  while (match) {
    outputPins.add(match[1]);
    match = regex.exec(code);
  }

  return outputPins;
}

function parseCommands(code) {
  const cleanedCode = cleanCode(code);
  const loopBody = extractLoopBody(cleanedCode);

  if (!/void\s+setup\s*\(\s*\)/i.test(cleanedCode)) {
    return {
      error: "Error: falta la función void setup()."
    };
  }

  if (!loopBody) {
    return {
      error: "Error: falta la función void loop()."
    };
  }

  const outputPins = parsePinModes(cleanedCode);
  const commands = [];
  const warnings = [];
  const commandRegex = /digitalWrite\s*\(\s*(\d+)\s*,\s*(HIGH|LOW)\s*\)|delay\s*\(\s*(\d+)\s*\)/gi;
  let match = commandRegex.exec(loopBody);

  while (match) {
    if (match[1]) {
      const pin = match[1];
      const value = match[2].toUpperCase();

      if (!outputPins.has(pin)) {
        warnings.push(`Advertencia: usas digitalWrite(${pin}, ${value}), pero no configuraste pinMode(${pin}, OUTPUT).`);
      }

      commands.push({
        type: "digitalWrite",
        pin,
        value
      });
    } else {
      let milliseconds = Number(match[3]);

      if (Number.isNaN(milliseconds)) {
        milliseconds = 1000;
      }

      if (milliseconds < 100) {
        milliseconds = 100;
      }

      if (milliseconds > 5000) {
        milliseconds = 5000;
        warnings.push("Advertencia: delay mayor a 5000 ms fue limitado a 5000 ms para la simulación.");
      }

      commands.push({
        type: "delay",
        milliseconds
      });
    }

    match = commandRegex.exec(loopBody);
  }

  if (commands.length === 0) {
    return {
      error: "Error: no se encontraron instrucciones digitalWrite() o delay() dentro de loop()."
    };
  }

  return {
    commands,
    warnings
  };
}

function resetPinStates() {
  pinStates = {};

  for (let pin = 2; pin <= 13; pin++) {
    pinStates[String(pin)] = "LOW";
  }

  updateCircuitLights();
}

function stopSimulation() {
  simulationRunning = false;
  clearTimeout(simulationTimer);
  simulationTimer = null;
  resetPinStates();
}

function runSimulation() {
  stopSimulation();

  const arduino = findFirstComponentByType("arduino");

  if (!arduino) {
    writeConsole("Error: agrega una placa Arduino antes de ejecutar la simulación.");
    setStatus("Falta Arduino.", "error");
    return;
  }

  const leds = getLedComponents();

  if (leds.length === 0) {
    writeConsole("Error: agrega al menos un LED para visualizar la salida.");
    setStatus("Falta LED.", "error");
    return;
  }

  if (wires.length === 0) {
    writeConsole("Error: no hay cables conectados. Haz clic en un pin y luego en otro para crear cables.");
    setStatus("Faltan cables.", "error");
    return;
  }

  const parsed = parseCommands(arduinoCode.value);

  if (parsed.error) {
    writeConsole(parsed.error);
    setStatus("Error en el código.", "error");
    return;
  }

  resetPinStates();
  simulationRunning = true;

  let message =
    "Compilación simulada correcta.\n\n" +
    "Iniciando ejecución de loop().\n" +
    "El simulador leerá digitalWrite() y delay().";

  if (parsed.warnings.length > 0) {
    message += "\n\n" + parsed.warnings.join("\n");
  }

  writeConsole(message);
  setStatus("Simulación en ejecución.", "ok");

  executeCommandSequence(parsed.commands, 0);
}

function executeCommandSequence(commands, index) {
  if (!simulationRunning) {
    return;
  }

  const command = commands[index % commands.length];

  if (command.type === "digitalWrite") {
    pinStates[command.pin] = command.value;
    updateCircuitLights();

    appendConsole(`digitalWrite(${command.pin}, ${command.value});`);

    simulationTimer = setTimeout(() => {
      executeCommandSequence(commands, index + 1);
    }, 120);

    return;
  }

  if (command.type === "delay") {
    appendConsole(`delay(${command.milliseconds});`);

    simulationTimer = setTimeout(() => {
      executeCommandSequence(commands, index + 1);
    }, command.milliseconds);
  }
}

function loadBlink13Example() {
  arduinoCode.value = `void setup() {
  pinMode(13, OUTPUT);
}

void loop() {
  digitalWrite(13, HIGH);
  delay(1000);

  digitalWrite(13, LOW);
  delay(1000);
}`;
}

function loadBlink8Example() {
  arduinoCode.value = `void setup() {
  pinMode(8, OUTPUT);
}

void loop() {
  digitalWrite(8, HIGH);
  delay(500);

  digitalWrite(8, LOW);
  delay(500);
}`;
}

function initializeEvents() {
  document.querySelectorAll("[data-add]").forEach((button) => {
    button.addEventListener("click", () => {
      createComponent(button.dataset.add);
    });
  });

  labCanvas.addEventListener("pointerdown", (event) => {
    const port = event.target.closest(".lab-port");

    if (port) {
      return;
    }

    const componentElement = event.target.closest(".lab-component");

    if (selectedPortId && !componentElement) {
      event.preventDefault();
      addDraftWirePoint(event);
      return;
    }

    if (!componentElement) {
      clearElementSelection();
      return;
    }

    startDragging(componentElement, event);
  });

  labCanvas.addEventListener("pointermove", (event) => {
    if (selectedPortId && !dragging && !draggingWirePoint) {
      previewPoint = getCanvasPointFromEvent(event);
      updateWires();
    }
  });

  labCanvas.addEventListener("click", (event) => {
    const port = event.target.closest(".lab-port");

    if (port) {
      handlePortClick(port, event);
      return;
    }

    if (selectedPortId) {
      return;
    }

    if (!event.target.closest(".lab-component")) {
      clearElementSelection();
    }
  });

  labCanvas.addEventListener("change", (event) => {
    const ledSelect = event.target.closest("[data-led-color-select]");

    if (!ledSelect) {
      return;
    }

    event.stopPropagation();
    changeLedColor(ledSelect.dataset.componentId, ledSelect.value);
  });

  labCanvas.addEventListener("dblclick", (event) => {
    const port = event.target.closest(".lab-port");
    const ledControl = event.target.closest(".lab-led-control");

    if (port || ledControl || selectedPortId) {
      return;
    }

    const componentElement = event.target.closest(".lab-component");

    if (!componentElement) {
      return;
    }

    deleteComponent(componentElement.dataset.componentId);
  });

  window.addEventListener("pointermove", (event) => {
    if (draggingWirePoint) {
      dragWirePoint(event);
      return;
    }

    dragComponent(event);
  });

  window.addEventListener("pointerup", () => {
    stopDraggingWirePoint();
    stopDragging();
  });

  window.addEventListener("resize", () => {
    components.forEach((component) => {
      clampComponentPosition(component);
    });

    updateWires();
  });

  window.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      clearAllSelections();
      setStatus("Selección cancelada.");
      return;
    }

    if (event.key !== "Delete" && event.key !== "Backspace") {
      return;
    }

    const activeTag = document.activeElement ? document.activeElement.tagName.toLowerCase() : "";

    if (["textarea", "input", "select"].includes(activeTag)) {
      return;
    }

    if (selectedWireIndex !== null) {
      deleteWire(selectedWireIndex);
      return;
    }

    if (selectedComponentId) {
      deleteComponent(selectedComponentId);
    }
  });

  runSimulationButton.addEventListener("click", runSimulation);

  stopSimulationButton.addEventListener("click", () => {
    stopSimulation();
    writeConsole("Simulación detenida.");
    setStatus("Simulación detenida.");
  });

  clearCircuitButton.addEventListener("click", clearCircuit);

  exampleBlink13Button.addEventListener("click", () => {
    loadBlink13Example();
    writeConsole("Ejemplo cargado: LED parpadeante en pin 13.");
    setStatus("Ejemplo cargado.", "ok");
  });

  exampleBlink8Button.addEventListener("click", () => {
    loadBlink8Example();
    writeConsole("Ejemplo cargado: LED parpadeante en pin 8.");
    setStatus("Ejemplo cargado.", "ok");
  });
}

initializeEvents();
updateEmptyHint();
updateWireLayerSize();
setStatus("Listo. Haz clic en un pin, coloca puntos de ruta con clic en el área y termina conectando en otro pin.");