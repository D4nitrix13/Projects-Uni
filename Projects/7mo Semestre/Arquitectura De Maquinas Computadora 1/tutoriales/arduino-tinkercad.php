<?php
$pageTitle = "Tutorial Arduino y Tinkercad";
$currentPage = "arduino";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Tutorial</span>
        <h1>Uso de Tinkercad para simular Arduino</h1>
        <p>
            Aprende a crear circuitos con Arduino UNO, programarlos y simularlos
            directamente desde el navegador usando Tinkercad Circuits.
        </p>

        <div class="hero-actions">
            <a href="https://www.tinkercad.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="btn btn-primary">
                Abrir Tinkercad
            </a>

            <a href="../practicas/arduino-practicas.php" class="btn btn-secondary">
                Ver prácticas de Arduino
            </a>

            <a href="emu8086.php" class="btn btn-secondary">
                Volver a EMU8086
            </a>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Introducción</span>
            <h2>¿Qué es Arduino?</h2>
            <p>
                Arduino es una plataforma de hardware y software utilizada para crear
                proyectos electrónicos. Permite programar placas con microcontroladores
                para controlar LEDs, sensores, motores, botones, pantallas y otros componentes.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>Arduino UNO</h2>
                <p>
                    Arduino UNO es una de las placas más usadas para aprender electrónica
                    y programación de microcontroladores. Tiene pines digitales, entradas
                    analógicas, alimentación, puerto USB y un microcontrolador principal.
                </p>

                <ul class="styled-list">
                    <li>Pines digitales para entradas y salidas.</li>
                    <li>Entradas analógicas para sensores.</li>
                    <li>Puerto USB para programación.</li>
                    <li>Microcontrolador integrado.</li>
                    <li>Compatibilidad con muchos componentes electrónicos.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>¿Qué es Tinkercad Circuits?</h2>
                <p>
                    Tinkercad Circuits es una herramienta web de Autodesk que permite
                    crear y simular circuitos electrónicos. También permite escribir
                    código para Arduino y probarlo sin tener componentes físicos.
                </p>

                <div class="note">
                    <strong>Idea clave:</strong> Tinkercad permite practicar electrónica
                    y programación antes de construir el circuito real.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Pasos</span>
            <h2>Cómo usar Tinkercad Circuits</h2>
            <p>
                Sigue estos pasos para crear tu primer circuito con Arduino UNO.
            </p>
        </div>

        <div class="timeline">
            <article class="timeline-item">
                <span>1</span>
                <div>
                    <h3>Entrar a Tinkercad</h3>
                    <p>
                        Abre la página oficial de Tinkercad e inicia sesión con una cuenta.
                        Luego entra a la sección de circuitos.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>2</span>
                <div>
                    <h3>Crear un nuevo circuito</h3>
                    <p>
                        Selecciona la opción para crear un circuito nuevo. Se abrirá
                        un espacio de trabajo donde podrás arrastrar componentes.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>3</span>
                <div>
                    <h3>Agregar Arduino UNO</h3>
                    <p>
                        Busca la placa Arduino UNO en la lista de componentes y arrástrala
                        al área de trabajo.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>4</span>
                <div>
                    <h3>Conectar componentes</h3>
                    <p>
                        Agrega LEDs, resistencias, botones o sensores según la práctica.
                        Usa cables virtuales para conectar los componentes a la placa.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>5</span>
                <div>
                    <h3>Escribir código</h3>
                    <p>
                        Abre el editor de código, cambia a modo texto y escribe
                        el programa de Arduino.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>6</span>
                <div>
                    <h3>Iniciar simulación</h3>
                    <p>
                        Haz clic en iniciar simulación para observar cómo se comporta
                        el circuito.
                    </p>
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Estructura</span>
            <h2>Estructura básica de un programa Arduino</h2>
            <p>
                Todo programa de Arduino tiene dos funciones principales:
                <code>setup()</code> y <code>loop()</code>.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>setup()</h2>
                <p>
                    Se ejecuta una sola vez cuando inicia el programa. Se usa para
                    configurar pines, comunicación serial, sensores y valores iniciales.
                </p>

                <pre><code>void setup() {
  pinMode(13, OUTPUT);
}</code></pre>
            </article>

            <article class="content-card">
                <h2>loop()</h2>
                <p>
                    Se ejecuta continuamente mientras la placa está encendida.
                    Aquí se colocan las instrucciones principales del programa.
                </p>

                <pre><code>void loop() {
  digitalWrite(13, HIGH);
  delay(1000);
  digitalWrite(13, LOW);
  delay(1000);
}</code></pre>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Circuito básico</span>
            <h2>LED parpadeante</h2>
            <p>
                Este ejemplo enciende y apaga un LED conectado al pin 13 del Arduino UNO.
            </p>
        </div>

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

        <div class="note">
            <strong>Explicación:</strong> <code>pinMode()</code> configura el pin,
            <code>digitalWrite()</code> cambia su estado y <code>delay()</code>
            pausa el programa por una cantidad de milisegundos.
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Componentes</span>
            <h2>Componentes básicos para practicar</h2>
            <p>
                Estos componentes son suficientes para empezar a simular proyectos
                sencillos con Arduino en Tinkercad.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">LED</div>
                <h3>LED</h3>
                <p>
                    Sirve para mostrar una salida visual. Se puede encender o apagar
                    desde un pin digital.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">R</div>
                <h3>Resistencia</h3>
                <p>
                    Limita la corriente eléctrica y protege componentes como los LEDs.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">BTN</div>
                <h3>Botón</h3>
                <p>
                    Permite enviar una señal de entrada cuando el usuario lo presiona.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">A0</div>
                <h3>Sensor analógico</h3>
                <p>
                    Envía valores variables que Arduino puede leer con
                    <code>analogRead()</code>.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">SER</div>
                <h3>Monitor serial</h3>
                <p>
                    Permite ver datos enviados desde Arduino usando
                    <code>Serial.println()</code>.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">PWM</div>
                <h3>Salida PWM</h3>
                <p>
                    Permite simular valores intermedios, por ejemplo controlar el brillo
                    de un LED.
                </p>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Errores comunes</span>
            <h2>Problemas frecuentes en Tinkercad con Arduino</h2>
            <p>
                Estos errores aparecen con frecuencia al comenzar a simular circuitos.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Problema</th>
                        <th>Causa posible</th>
                        <th>Solución recomendada</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>El LED no enciende</td>
                        <td>El pin está mal configurado o mal conectado.</td>
                        <td>Verifica <code>pinMode()</code>, <code>digitalWrite()</code> y las conexiones.</td>
                    </tr>
                    <tr>
                        <td>El código no compila</td>
                        <td>Faltan llaves, punto y coma o nombres correctos.</td>
                        <td>Revisa que cada instrucción termine con <code>;</code> y que las llaves estén cerradas.</td>
                    </tr>
                    <tr>
                        <td>El botón se comporta raro</td>
                        <td>La entrada puede quedar flotante.</td>
                        <td>Usa una resistencia pull-down o configura correctamente la entrada.</td>
                    </tr>
                    <tr>
                        <td>No se ven datos seriales</td>
                        <td>No se inició la comunicación serial.</td>
                        <td>Agrega <code>Serial.begin(9600);</code> dentro de <code>setup()</code>.</td>
                    </tr>
                    <tr>
                        <td>La simulación no inicia</td>
                        <td>Hay un error en el circuito o en el código.</td>
                        <td>Revisa conexiones, componentes y mensajes de error del editor.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Recursos externos</span>
            <h2>Recursos externos recomendados</h2>
            <p>
                Estos recursos te pueden ayudar a reforzar el uso de Arduino,
                Tinkercad Circuits, programación básica y simulación de circuitos.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card featured-card">
                <h3>Tinkercad oficial</h3>
                <p>
                    Página principal para entrar a Tinkercad y acceder a la sección
                    de circuitos.
                </p>

                <a href="https://www.tinkercad.com/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Abrir Tinkercad
                </a>
            </article>

            <article class="card featured-card">
                <h3>Guía oficial de Arduino UNO</h3>
                <p>
                    Guía de Arduino para comenzar con la placa Arduino UNO y entender
                    su uso básico.
                </p>

                <a href="https://www.arduino.cc/en/Guide/ArduinoUno/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Abrir guía oficial
                </a>
            </article>

            <article class="card featured-card">
                <h3>Documentación de referencia Arduino</h3>
                <p>
                    Referencia oficial del lenguaje Arduino: funciones, sintaxis,
                    constantes y estructuras.
                </p>

                <a href="https://docs.arduino.cc/language-reference/"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver referencia
                </a>
            </article>

            <article class="card featured-card">
                <h3>Guía de Tinkercad Circuits</h3>
                <p>
                    Tutorial escrito para aprender a crear circuitos y usar simulación
                    con Tinkercad.
                </p>

                <a href="https://makeabilitylab.github.io/physcomp/arduino/tinkercad.html"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver guía
                </a>
            </article>

            <article class="card featured-card">
                <h3>YouTube: botón con Arduino</h3>
                <p>
                    Tutorial directo para controlar un LED con un pulsador usando Arduino
                    en Tinkercad.
                </p>

                <a href="https://www.youtube.com/watch?v=u4yk7gpNoKw"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver video
                </a>
            </article>

            <article class="card featured-card">
                <h3>YouTube: sensor ultrasónico y LED</h3>
                <p>
                    Ejemplo práctico de Tinkercad con Arduino, sensor ultrasónico
                    y LED.
                </p>

                <a href="https://www.youtube.com/watch?v=fnsf7Cbh-uQ"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver ejemplo
                </a>
            </article>
        </div>

        <div class="note">
            <strong>Recomendación:</strong> empieza con LED parpadeante, luego usa botón
            y después sensores. Así avanzas de lo más simple a lo más completo.
        </div>
    </section>

    <section class="section section-alt">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente paso</span>
                <h2>Continúa con prácticas de Arduino o vuelve a EMU8086</h2>
                <p>
                    Después de aprender a usar Tinkercad, puedes resolver prácticas
                    de Arduino o volver al tutorial de EMU8086 para reforzar ensamblador.
                </p>
            </div>

            <div class="hero-actions">
                <a href="../practicas/arduino-practicas.php" class="btn btn-primary">
                    Ver prácticas de Arduino
                </a>

                <a href="emu8086.php" class="btn btn-secondary">
                    Volver a EMU8086
                </a>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>