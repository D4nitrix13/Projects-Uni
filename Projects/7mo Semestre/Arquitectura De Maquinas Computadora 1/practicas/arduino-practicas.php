<?php
$pageTitle = "Prácticas Interactivas Arduino";
$currentPage = "arduino";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
  <section class="page-hero">
    <span class="badge">Prácticas interactivas</span>
    <h1>Prácticas de Arduino con Tinkercad</h1>
    <p>
      Escribe código Arduino, revisa si cumple con la estructura esperada
      y consulta la solución recomendada al final de cada ejercicio.
    </p>

    <div class="hero-actions">
      <a href="../tutoriales/arduino-tinkercad.php" class="btn btn-primary">
        Ver tutorial de Arduino
      </a>

      <a href="https://www.tinkercad.com/"
        target="_blank"
        rel="noopener noreferrer"
        class="btn btn-secondary">
        Abrir Tinkercad
      </a>

      <a href="../practicas/emu8086-practicas.php" class="btn btn-secondary">
        Prácticas EMU8086
      </a>
    </div>
  </section>

  <section class="section">
    <div class="section-header">
      <span class="badge">Guía rápida</span>
      <h2>¿Cómo funcionan estas prácticas?</h2>
      <p>
        Cada ejercicio tiene un editor donde puedes escribir el código.
        El sistema revisa si agregaste las partes principales del programa.
        Luego puedes copiarlo en Tinkercad para simularlo.
      </p>
    </div>

    <div class="cards-grid">
      <article class="card icon-card">
        <div class="icon-circle">1</div>
        <h3>Lee el objetivo</h3>
        <p>
          Primero revisa qué debe hacer el circuito y qué código necesitas.
        </p>
      </article>

      <article class="card icon-card">
        <div class="icon-circle">2</div>
        <h3>Escribe tu código</h3>
        <p>
          Usa el editor de cada práctica para escribir el programa Arduino.
        </p>
      </article>

      <article class="card icon-card">
        <div class="icon-circle">3</div>
        <h3>Revisa y corrige</h3>
        <p>
          Presiona revisar código. Si algo falta, la página te dará pistas.
        </p>
      </article>
    </div>

    <div class="note">
      <strong>Importante:</strong> esta revisión ayuda a detectar errores básicos,
      pero la prueba final debes hacerla en Tinkercad iniciando la simulación.
    </div>
  </section>

  <section class="section section-alt">
    <div class="section-header">
      <span class="badge">Práctica 1</span>
      <h2>LED parpadeante</h2>
      <p>
        Escribe un programa que encienda y apague un LED conectado al pin 13
        cada segundo.
      </p>
    </div>

    <div class="interactive-practice" data-practice="arduinoPractice1">
      <div class="practice-layout">
        <article class="content-card">
          <h3>Objetivo</h3>
          <p>
            Practicar salidas digitales usando <code>pinMode()</code>,
            <code>digitalWrite()</code> y <code>delay()</code>.
          </p>

          <h3>Tu programa debe incluir</h3>
          <ul class="styled-list">
            <li>Una variable llamada <code>led</code> con valor <code>13</code>.</li>
            <li>Función <code>setup()</code>.</li>
            <li><code>pinMode(led, OUTPUT);</code></li>
            <li>Función <code>loop()</code>.</li>
            <li><code>digitalWrite(led, HIGH);</code></li>
            <li><code>delay(1000);</code></li>
            <li><code>digitalWrite(led, LOW);</code></li>
          </ul>
        </article>

        <article class="content-card">
          <h3>Editor de código</h3>

          <textarea class="code-editor"
            id="arduinoPractice1Code"
            spellcheck="false"
            placeholder="Escribe aquí tu código Arduino..."></textarea>

          <div class="practice-actions">
            <button type="button" class="btn btn-primary" data-arduino-check="arduinoPractice1">
              Revisar código
            </button>

            <button type="button" class="btn btn-light" data-arduino-fix="arduinoPractice1">
              Corregir sintaxis
            </button>

            <button type="button" class="btn btn-secondary-dark" data-arduino-solution="arduinoPractice1">
              Ver solución
            </button>
          </div>

          <div class="practice-feedback" id="arduinoPractice1Feedback">
            Escribe tu código y presiona revisar.
          </div>
        </article>
      </div>

      <div class="solution-box" id="arduinoPractice1Solution">
        <h3>Solución recomendada</h3>
        <pre><code>int led = 13;

void setup() {
  pinMode(led, OUTPUT);
}

void loop() {
  digitalWrite(led, HIGH);
  delay(1000);

  digitalWrite(led, LOW);
  delay(1000);
}</code></pre>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="section-header">
      <span class="badge">Práctica 2</span>
      <h2>Controlar un LED con botón</h2>
      <p>
        Escribe un programa que encienda un LED cuando se presione un botón.
      </p>
    </div>

    <div class="interactive-practice" data-practice="arduinoPractice2">
      <div class="practice-layout">
        <article class="content-card">
          <h3>Objetivo</h3>
          <p>
            Practicar entradas digitales usando <code>digitalRead()</code>
            y condiciones con <code>if</code>.
          </p>

          <h3>Tu programa debe incluir</h3>
          <ul class="styled-list">
            <li>Variable <code>boton</code> con valor <code>2</code>.</li>
            <li>Variable <code>led</code> con valor <code>13</code>.</li>
            <li>Variable <code>estadoBoton</code>.</li>
            <li><code>pinMode(boton, INPUT);</code></li>
            <li><code>pinMode(led, OUTPUT);</code></li>
            <li><code>digitalRead(boton);</code></li>
            <li>Condición <code>if</code>.</li>
            <li><code>digitalWrite(led, HIGH);</code></li>
            <li><code>digitalWrite(led, LOW);</code></li>
          </ul>
        </article>

        <article class="content-card">
          <h3>Editor de código</h3>

          <textarea class="code-editor"
            id="arduinoPractice2Code"
            spellcheck="false"
            placeholder="Escribe aquí tu código Arduino..."></textarea>

          <div class="practice-actions">
            <button type="button" class="btn btn-primary" data-arduino-check="arduinoPractice2">
              Revisar código
            </button>

            <button type="button" class="btn btn-light" data-arduino-fix="arduinoPractice2">
              Corregir sintaxis
            </button>

            <button type="button" class="btn btn-secondary-dark" data-arduino-solution="arduinoPractice2">
              Ver solución
            </button>
          </div>

          <div class="practice-feedback" id="arduinoPractice2Feedback">
            Escribe tu código y presiona revisar.
          </div>
        </article>
      </div>

      <div class="solution-box" id="arduinoPractice2Solution">
        <h3>Solución recomendada</h3>
        <pre><code>int boton = 2;
int led = 13;
int estadoBoton = 0;

void setup() {
  pinMode(boton, INPUT);
  pinMode(led, OUTPUT);
}

void loop() {
  estadoBoton = digitalRead(boton);

  if (estadoBoton == HIGH) {
    digitalWrite(led, HIGH);
  } else {
    digitalWrite(led, LOW);
  }
}</code></pre>
      </div>
    </div>
  </section>

  <section class="section section-alt">
    <div class="section-header">
      <span class="badge">Práctica 3</span>
      <h2>Lectura de una entrada analógica</h2>
      <p>
        Escribe un programa que lea un sensor conectado al pin <code>A0</code>
        y muestre el valor en el monitor serial.
      </p>
    </div>

    <div class="interactive-practice" data-practice="arduinoPractice3">
      <div class="practice-layout">
        <article class="content-card">
          <h3>Objetivo</h3>
          <p>
            Practicar lectura analógica usando <code>analogRead()</code>
            y salida por monitor serial con <code>Serial.println()</code>.
          </p>

          <h3>Tu programa debe incluir</h3>
          <ul class="styled-list">
            <li>Variable <code>sensor</code> con valor <code>A0</code>.</li>
            <li>Variable <code>valor</code>.</li>
            <li><code>Serial.begin(9600);</code></li>
            <li><code>analogRead(sensor);</code></li>
            <li><code>Serial.println(valor);</code></li>
            <li><code>delay(500);</code></li>
          </ul>
        </article>

        <article class="content-card">
          <h3>Editor de código</h3>

          <textarea class="code-editor"
            id="arduinoPractice3Code"
            spellcheck="false"
            placeholder="Escribe aquí tu código Arduino..."></textarea>

          <div class="practice-actions">
            <button type="button" class="btn btn-primary" data-arduino-check="arduinoPractice3">
              Revisar código
            </button>

            <button type="button" class="btn btn-light" data-arduino-fix="arduinoPractice3">
              Corregir sintaxis
            </button>

            <button type="button" class="btn btn-secondary-dark" data-arduino-solution="arduinoPractice3">
              Ver solución
            </button>
          </div>

          <div class="practice-feedback" id="arduinoPractice3Feedback">
            Escribe tu código y presiona revisar.
          </div>
        </article>
      </div>

      <div class="solution-box" id="arduinoPractice3Solution">
        <h3>Solución recomendada</h3>
        <pre><code>int sensor = A0;
int valor = 0;

void setup() {
  Serial.begin(9600);
}

void loop() {
  valor = analogRead(sensor);
  Serial.println(valor);
  delay(500);
}</code></pre>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="section-header">
      <span class="badge">Práctica 4</span>
      <h2>Controlar brillo de LED con potenciómetro</h2>
      <p>
        Escribe un programa que lea un potenciómetro en <code>A0</code>
        y controle el brillo de un LED conectado al pin <code>9</code>.
      </p>
    </div>

    <div class="interactive-practice" data-practice="arduinoPractice4">
      <div class="practice-layout">
        <article class="content-card">
          <h3>Objetivo</h3>
          <p>
            Practicar entrada analógica, conversión de valores con
            <code>map()</code> y salida PWM con <code>analogWrite()</code>.
          </p>

          <h3>Tu programa debe incluir</h3>
          <ul class="styled-list">
            <li>Variable <code>potenciometro</code> con valor <code>A0</code>.</li>
            <li>Variable <code>led</code> con valor <code>9</code>.</li>
            <li><code>pinMode(led, OUTPUT);</code></li>
            <li><code>analogRead(potenciometro);</code></li>
            <li><code>map(valor, 0, 1023, 0, 255);</code></li>
            <li><code>analogWrite(led, brillo);</code></li>
          </ul>
        </article>

        <article class="content-card">
          <h3>Editor de código</h3>

          <textarea class="code-editor"
            id="arduinoPractice4Code"
            spellcheck="false"
            placeholder="Escribe aquí tu código Arduino..."></textarea>

          <div class="practice-actions">
            <button type="button" class="btn btn-primary" data-arduino-check="arduinoPractice4">
              Revisar código
            </button>

            <button type="button" class="btn btn-light" data-arduino-fix="arduinoPractice4">
              Corregir sintaxis
            </button>

            <button type="button" class="btn btn-secondary-dark" data-arduino-solution="arduinoPractice4">
              Ver solución
            </button>
          </div>

          <div class="practice-feedback" id="arduinoPractice4Feedback">
            Escribe tu código y presiona revisar.
          </div>
        </article>
      </div>

      <div class="solution-box" id="arduinoPractice4Solution">
        <h3>Solución recomendada</h3>
        <pre><code>int potenciometro = A0;
int led = 9;
int valor = 0;
int brillo = 0;

void setup() {
  pinMode(led, OUTPUT);
}

void loop() {
  valor = analogRead(potenciometro);
  brillo = map(valor, 0, 1023, 0, 255);
  analogWrite(led, brillo);
}</code></pre>
      </div>
    </div>
  </section>

  <section class="section section-alt">
    <div class="next-unit-card">
      <div>
        <span class="badge">Siguiente paso</span>
        <h2>Prueba tus códigos en Tinkercad</h2>
        <p>
          Después de resolver las prácticas, copia el código en Tinkercad,
          arma el circuito correspondiente e inicia la simulación.
        </p>
      </div>

      <div class="hero-actions">
        <a href="https://www.tinkercad.com/"
          target="_blank"
          rel="noopener noreferrer"
          class="btn btn-primary">
          Abrir Tinkercad
        </a>

        <a href="../tutoriales/arduino-tinkercad.php" class="btn btn-secondary">
          Volver al tutorial
        </a>
      </div>
    </div>
  </section>
</main>

<script>
  const arduinoPractices = {
    arduinoPractice1: {
      textareaId: "arduinoPractice1Code",
      feedbackId: "arduinoPractice1Feedback",
      solutionId: "arduinoPractice1Solution",
      solution: `int led = 13;

void setup() {
  pinMode(led, OUTPUT);
}

void loop() {
  digitalWrite(led, HIGH);
  delay(1000);

  digitalWrite(led, LOW);
  delay(1000);
}`,
      checks: [{
          label: "Variable led declarada",
          test: code => /int\s+led\s*=\s*13\s*;/.test(code),
          hint: "Declara la variable: int led = 13;"
        },
        {
          label: "Función setup",
          test: code => code.includes("void setup()"),
          hint: "Agrega la función void setup()."
        },
        {
          label: "Configuración del pin como salida",
          test: code => code.includes("pinmode(led, output);"),
          hint: "Configura el pin con pinMode(led, OUTPUT);"
        },
        {
          label: "Función loop",
          test: code => code.includes("void loop()"),
          hint: "Agrega la función void loop()."
        },
        {
          label: "Encendido del LED",
          test: code => code.includes("digitalwrite(led, high);"),
          hint: "Enciende el LED con digitalWrite(led, HIGH);"
        },
        {
          label: "Pausa de un segundo",
          test: code => code.includes("delay(1000);"),
          hint: "Agrega delay(1000); para esperar un segundo."
        },
        {
          label: "Apagado del LED",
          test: code => code.includes("digitalwrite(led, low);"),
          hint: "Apaga el LED con digitalWrite(led, LOW);"
        }
      ]
    },

    arduinoPractice2: {
      textareaId: "arduinoPractice2Code",
      feedbackId: "arduinoPractice2Feedback",
      solutionId: "arduinoPractice2Solution",
      solution: `int boton = 2;
int led = 13;
int estadoBoton = 0;

void setup() {
  pinMode(boton, INPUT);
  pinMode(led, OUTPUT);
}

void loop() {
  estadoBoton = digitalRead(boton);

  if (estadoBoton == HIGH) {
    digitalWrite(led, HIGH);
  } else {
    digitalWrite(led, LOW);
  }
}`,
      checks: [{
          label: "Variable boton declarada",
          test: code => /int\s+boton\s*=\s*2\s*;/.test(code),
          hint: "Declara la variable: int boton = 2;"
        },
        {
          label: "Variable led declarada",
          test: code => /int\s+led\s*=\s*13\s*;/.test(code),
          hint: "Declara la variable: int led = 13;"
        },
        {
          label: "Variable estadoBoton declarada",
          test: code => code.includes("estadoboton"),
          hint: "Declara una variable para guardar el estado del botón."
        },
        {
          label: "Botón configurado como entrada",
          test: code => code.includes("pinmode(boton, input);"),
          hint: "Configura el botón con pinMode(boton, INPUT);"
        },
        {
          label: "LED configurado como salida",
          test: code => code.includes("pinmode(led, output);"),
          hint: "Configura el LED con pinMode(led, OUTPUT);"
        },
        {
          label: "Lectura del botón",
          test: code => code.includes("digitalread(boton);"),
          hint: "Lee el botón con digitalRead(boton);"
        },
        {
          label: "Condición if",
          test: code => code.includes("if"),
          hint: "Agrega una condición if para revisar si el botón está presionado."
        },
        {
          label: "Encendido del LED",
          test: code => code.includes("digitalwrite(led, high);"),
          hint: "Enciende el LED con digitalWrite(led, HIGH);"
        },
        {
          label: "Apagado del LED",
          test: code => code.includes("digitalwrite(led, low);"),
          hint: "Apaga el LED con digitalWrite(led, LOW);"
        }
      ]
    },

    arduinoPractice3: {
      textareaId: "arduinoPractice3Code",
      feedbackId: "arduinoPractice3Feedback",
      solutionId: "arduinoPractice3Solution",
      solution: `int sensor = A0;
int valor = 0;

void setup() {
  Serial.begin(9600);
}

void loop() {
  valor = analogRead(sensor);
  Serial.println(valor);
  delay(500);
}`,
      checks: [{
          label: "Variable sensor declarada",
          test: code => /int\s+sensor\s*=\s*a0\s*;/.test(code),
          hint: "Declara la variable: int sensor = A0;"
        },
        {
          label: "Variable valor declarada",
          test: code => /int\s+valor\s*=\s*0\s*;/.test(code),
          hint: "Declara la variable: int valor = 0;"
        },
        {
          label: "Comunicación serial iniciada",
          test: code => code.includes("serial.begin(9600);"),
          hint: "Inicia el monitor serial con Serial.begin(9600);"
        },
        {
          label: "Lectura analógica",
          test: code => code.includes("analogread(sensor);"),
          hint: "Lee el sensor con analogRead(sensor);"
        },
        {
          label: "Impresión serial",
          test: code => code.includes("serial.println(valor);"),
          hint: "Muestra el valor con Serial.println(valor);"
        },
        {
          label: "Pausa",
          test: code => code.includes("delay(500);"),
          hint: "Agrega delay(500); para pausar la lectura."
        }
      ]
    },

    arduinoPractice4: {
      textareaId: "arduinoPractice4Code",
      feedbackId: "arduinoPractice4Feedback",
      solutionId: "arduinoPractice4Solution",
      solution: `int potenciometro = A0;
int led = 9;
int valor = 0;
int brillo = 0;

void setup() {
  pinMode(led, OUTPUT);
}

void loop() {
  valor = analogRead(potenciometro);
  brillo = map(valor, 0, 1023, 0, 255);
  analogWrite(led, brillo);
}`,
      checks: [{
          label: "Variable potenciometro declarada",
          test: code => /int\s+potenciometro\s*=\s*a0\s*;/.test(code),
          hint: "Declara la variable: int potenciometro = A0;"
        },
        {
          label: "Variable led declarada",
          test: code => /int\s+led\s*=\s*9\s*;/.test(code),
          hint: "Declara la variable: int led = 9;"
        },
        {
          label: "Variable valor declarada",
          test: code => code.includes("valor"),
          hint: "Declara una variable llamada valor."
        },
        {
          label: "Variable brillo declarada",
          test: code => code.includes("brillo"),
          hint: "Declara una variable llamada brillo."
        },
        {
          label: "LED configurado como salida",
          test: code => code.includes("pinmode(led, output);"),
          hint: "Configura el LED con pinMode(led, OUTPUT);"
        },
        {
          label: "Lectura del potenciómetro",
          test: code => code.includes("analogread(potenciometro);"),
          hint: "Lee el potenciómetro con analogRead(potenciometro);"
        },
        {
          label: "Conversión con map",
          test: code => code.includes("map(valor, 0, 1023, 0, 255);"),
          hint: "Convierte el valor con map(valor, 0, 1023, 0, 255);"
        },
        {
          label: "Salida PWM",
          test: code => code.includes("analogwrite(led, brillo);"),
          hint: "Controla el brillo con analogWrite(led, brillo);"
        }
      ]
    }
  };

  function normalizeArduinoCode(code) {
    return code
      .replace(/\r/g, "")
      .replace(/[ \t]+/g, " ")
      .replace(/\s+\(/g, "(")
      .replace(/\(\s+/g, "(")
      .replace(/\s+\)/g, ")")
      .replace(/\s+,/g, ",")
      .replace(/,\s+/g, ", ")
      .replace(/\s+;/g, ";")
      .trim()
      .toLowerCase();
  }

  function checkArduinoPractice(practiceKey) {
    const practice = arduinoPractices[practiceKey];

    if (!practice) {
      return;
    }

    const textarea = document.getElementById(practice.textareaId);
    const feedback = document.getElementById(practice.feedbackId);

    if (!textarea || !feedback) {
      return;
    }

    const originalCode = textarea.value.trim();
    const normalizedCode = normalizeArduinoCode(originalCode);

    if (!originalCode) {
      feedback.className = "practice-feedback error";
      feedback.innerHTML = `
            <strong>No has escrito código todavía.</strong><br>
            Escribe tu solución en el editor y vuelve a presionar revisar.
        `;
      return;
    }

    let passed = [];
    let failed = [];

    practice.checks.forEach(function(check) {
      if (check.test(normalizedCode)) {
        passed.push(check.label);
      } else {
        failed.push(check.hint);
      }
    });

    if (failed.length === 0) {
      feedback.className = "practice-feedback success";
      feedback.innerHTML = `
            <strong>Muy bien. Tu código cumple con los puntos principales.</strong>
            <ul>
                ${passed.map(item => `<li>${item}</li>`).join("")}
            </ul>
            <p>Ahora cópialo en Tinkercad para simularlo.</p>
        `;
      return;
    }

    feedback.className = "practice-feedback warning";
    feedback.innerHTML = `
        <strong>Tu código está incompleto o tiene detalles por corregir.</strong>
        <p>Revisa estas sugerencias:</p>
        <ul>
            ${failed.map(item => `<li>${item}</li>`).join("")}
        </ul>
    `;
  }

  function showArduinoSolution(practiceKey) {
    const practice = arduinoPractices[practiceKey];

    if (!practice) {
      return;
    }

    const solutionBox = document.getElementById(practice.solutionId);

    if (!solutionBox) {
      return;
    }

    solutionBox.classList.toggle("show");
  }

  function fixArduinoSyntax(practiceKey) {
    const practice = arduinoPractices[practiceKey];

    if (!practice) {
      return;
    }

    const textarea = document.getElementById(practice.textareaId);
    const feedback = document.getElementById(practice.feedbackId);

    if (!textarea || !feedback) {
      return;
    }

    textarea.value = practice.solution;

    feedback.className = "practice-feedback success";
    feedback.innerHTML = `
        <strong>Se insertó una versión corregida.</strong><br>
        Puedes copiar este código en Tinkercad y ejecutar la simulación.
    `;
  }

  document.querySelectorAll("[data-arduino-check]").forEach(function(button) {
    button.addEventListener("click", function() {
      checkArduinoPractice(button.dataset.arduinoCheck);
    });
  });

  document.querySelectorAll("[data-arduino-solution]").forEach(function(button) {
    button.addEventListener("click", function() {
      showArduinoSolution(button.dataset.arduinoSolution);
    });
  });

  document.querySelectorAll("[data-arduino-fix]").forEach(function(button) {
    button.addEventListener("click", function() {
      fixArduinoSyntax(button.dataset.arduinoFix);
    });
  });
</script>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>