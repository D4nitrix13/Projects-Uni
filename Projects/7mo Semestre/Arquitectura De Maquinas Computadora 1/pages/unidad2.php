<?php
$pageTitle = "Unidad II | Arquitectura del Microprocesador";
$currentPage = "unidad2";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Unidad II</span>
        <h1>Arquitectura del microprocesador</h1>
        <p>
            En esta unidad estudiarás cómo está formado un microprocesador,
            cómo se organiza internamente y cómo se conecta con memoria,
            periféricos e interfaces programables.
        </p>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos de la unidad</span>
            <h2>¿Qué aprenderás en esta unidad?</h2>
            <p>
                Esta unidad explica la arquitectura del microprocesador y la forma
                en que se comunica con otros dispositivos dentro de un sistema computacional.
            </p>
        </div>

        <div class="unit-index">
            <article class="unit-index-card">
                <span class="badge">Contenido 2.1</span>
                <h3>Arquitectura del microprocesador</h3>
                <ul>
                    <li>Arquitectura Von Neumann.</li>
                    <li>Diagrama de bloques.</li>
                    <li>Organización externa del microprocesador.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 2.2</span>
                <h3>Conexión con dispositivos</h3>
                <ul>
                    <li>Conexión con memoria.</li>
                    <li>Conexión con periféricos.</li>
                    <li>Interfaz programable 8255.</li>
                    <li>Interrupciones programables 8259.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Objetivo</span>
                <h3>Comprender el sistema completo</h3>
                <ul>
                    <li>Cómo trabaja internamente la CPU.</li>
                    <li>Cómo circulan los datos.</li>
                    <li>Cómo se comunican los componentes.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 2.1</span>
            <h2>Arquitectura del microprocesador</h2>
            <p>
                El microprocesador es el componente encargado de ejecutar instrucciones,
                procesar datos y coordinar las operaciones principales del sistema.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card lesson-card">
                <div class="lesson-number">Idea central</div>
                <h2>¿Qué es la arquitectura del microprocesador?</h2>
                <p>
                    La arquitectura del microprocesador describe cómo está diseñado
                    lógicamente el procesador para ejecutar instrucciones. Incluye
                    sus registros, buses internos, unidad de control, ALU y la forma
                    en que se comunica con la memoria.
                </p>
                <p>
                    Gracias a esta arquitectura, el microprocesador puede leer instrucciones,
                    interpretarlas, realizar operaciones y entregar resultados.
                </p>
            </article>

            <article class="content-card lesson-card">
                <div class="lesson-number">Ejemplo sencillo</div>
                <h2>¿Cómo trabaja?</h2>
                <p>
                    Puedes imaginar el microprocesador como el cerebro de la computadora.
                    Recibe instrucciones, decide qué hacer con ellas, realiza cálculos
                    y controla el movimiento de información entre memoria y dispositivos.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> el microprocesador ejecuta instrucciones
                    y coordina el funcionamiento del sistema.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 2.1.1</span>
            <h2>Arquitectura Von Neumann</h2>
            <p>
                La arquitectura Von Neumann es uno de los modelos más importantes
                para comprender el funcionamiento básico de una computadora.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿En qué consiste?</h2>
                <p>
                    En la arquitectura Von Neumann, las instrucciones y los datos
                    se almacenan en la misma memoria. La CPU toma una instrucción
                    desde la memoria, la interpreta y luego la ejecuta.
                </p>
                <p>
                    Este modelo utiliza buses para transportar datos, direcciones
                    y señales de control entre la CPU, la memoria y los dispositivos
                    de entrada y salida.
                </p>

                <div class="example-box">
                    <strong>Corrección importante:</strong> en algunos documentos aparece
                    escrito como “Von Newman”, pero el nombre correcto es
                    <strong>Von Neumann</strong>.
                </div>
            </article>

            <article class="content-card">
                <h2>Elementos principales</h2>
                <ul class="styled-list">
                    <li>CPU o unidad central de procesamiento.</li>
                    <li>Memoria principal.</li>
                    <li>Bus de datos.</li>
                    <li>Bus de direcciones.</li>
                    <li>Bus de control.</li>
                    <li>Dispositivos de entrada y salida.</li>
                </ul>
            </article>
        </div>

        <div class="diagram big-diagram">
            <div>CPU</div>
            <span>↔</span>
            <div>Memoria</div>
            <span>↔</span>
            <div>Entrada / Salida</div>
        </div>

        <div class="note">
            <strong>Idea clave:</strong> en Von Neumann, datos e instrucciones comparten
            la misma memoria.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 2.1.2</span>
            <h2>Diagrama de bloques del microprocesador</h2>
            <p>
                Un diagrama de bloques representa las partes principales del microprocesador
                y muestra cómo se relacionan entre sí.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">UC</div>
                <h3>Unidad de control</h3>
                <p>
                    Dirige las operaciones internas del microprocesador. Se encarga
                    de interpretar instrucciones y enviar señales de control a las
                    demás partes del sistema.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">ALU</div>
                <h3>Unidad aritmética lógica</h3>
                <p>
                    Realiza operaciones matemáticas y lógicas, como sumas, restas,
                    comparaciones y operaciones booleanas.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">REG</div>
                <h3>Registros</h3>
                <p>
                    Son pequeñas memorias internas de alta velocidad. Guardan datos
                    temporales, direcciones e instrucciones durante la ejecución.
                </p>
            </article>
        </div>

        <div class="concept-box">
            <h3>Funcionamiento básico</h3>
            <p>
                La unidad de control busca la instrucción, la interpreta y coordina
                su ejecución. La ALU realiza las operaciones necesarias y los registros
                guardan información temporal durante el proceso.
            </p>
        </div>

        <div class="diagram big-diagram">
            <div>Unidad de control</div>
            <span>→</span>
            <div>Registros</div>
            <span>→</span>
            <div>ALU</div>
            <span>→</span>
            <div>Resultado</div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 2.1.3</span>
            <h2>Organización externa del microprocesador</h2>
            <p>
                La organización externa se refiere a los terminales o pines que permiten
                conectar el microprocesador con otros componentes del sistema.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>Bus de datos</h3>
                <p>
                    Transporta la información que se mueve entre el microprocesador,
                    la memoria y los periféricos. Puede enviar o recibir datos según
                    la operación que se esté realizando.
                </p>
            </article>

            <article class="card">
                <h3>Bus de direcciones</h3>
                <p>
                    Indica la posición de memoria o el dispositivo al que el microprocesador
                    quiere acceder. Es como una dirección que señala dónde está la información.
                </p>
            </article>

            <article class="card">
                <h3>Bus de control</h3>
                <p>
                    Transporta señales que indican qué operación debe realizarse,
                    por ejemplo leer, escribir, esperar, atender una interrupción
                    o sincronizar procesos.
                </p>
            </article>
        </div>

        <div class="concept-box">
            <h3>Ejemplo sencillo</h3>
            <p>
                Si la CPU quiere leer un dato de memoria, primero coloca la dirección
                en el bus de direcciones, luego activa una señal de lectura en el bus
                de control y finalmente recibe el dato por el bus de datos.
            </p>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 2.2</span>
            <h2>Conexión del microprocesador con dispositivos</h2>
            <p>
                El microprocesador no trabaja solo. Necesita comunicarse con memoria,
                periféricos e interfaces para formar un sistema funcional.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 2.2.1</span>
                <h2>Memoria</h2>
                <p>
                    La memoria almacena instrucciones y datos que el microprocesador
                    necesita para ejecutar programas. La CPU accede a la memoria usando
                    buses de dirección, datos y control.
                </p>
                <p>
                    La memoria puede ser RAM, usada para datos temporales, o ROM,
                    usada para almacenar instrucciones permanentes del sistema.
                </p>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 2.2.2</span>
                <h2>Periféricos</h2>
                <p>
                    Los periféricos son dispositivos que permiten la comunicación
                    entre el sistema y el exterior. Pueden ser de entrada, salida
                    o entrada/salida.
                </p>
                <p>
                    Algunos ejemplos son teclado, pantalla, mouse, impresora,
                    sensores, puertos de comunicación y dispositivos de almacenamiento.
                </p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Interfaces programables</span>
            <h2>Control de entrada, salida e interrupciones</h2>
            <p>
                Para manejar dispositivos externos de forma organizada, se utilizan
                circuitos auxiliares como el 8255 y el 8259.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 2.2.3</span>
                <h2>Interfaz programable 8255</h2>
                <p>
                    El Intel 8255 es una interfaz programable de entrada y salida.
                    Permite conectar el microprocesador con dispositivos externos
                    usando puertos paralelos.
                </p>
                <p>
                    Se puede programar para trabajar con diferentes modos de operación,
                    dependiendo de si se necesita leer datos, enviar datos o controlar
                    dispositivos externos.
                </p>

                <div class="example-box">
                    <strong>Ejemplo:</strong> puede usarse para conectar LEDs, interruptores,
                    teclados simples, displays o dispositivos de control paralelo.
                </div>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 2.2.4</span>
                <h2>Interrupciones programables 8259</h2>
                <p>
                    El Intel 8259 es un controlador programable de interrupciones.
                    Su función es ayudar al microprocesador a atender eventos externos
                    sin tener que revisar constantemente cada dispositivo.
                </p>
                <p>
                    Cuando un dispositivo necesita atención, envía una interrupción.
                    El 8259 organiza estas solicitudes y le indica a la CPU cuál debe
                    atender primero.
                </p>

                <div class="example-box">
                    <strong>Ejemplo:</strong> una interrupción puede ocurrir cuando se presiona
                    una tecla, llega un dato por un puerto o un dispositivo necesita atención.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Comparación</span>
            <h2>Resumen de conexiones</h2>
            <p>
                Esta tabla resume cómo se conecta el microprocesador con los principales
                elementos del sistema.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Elemento</th>
                        <th>Función</th>
                        <th>Relación con el microprocesador</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Memoria</td>
                        <td>Guarda datos e instrucciones.</td>
                        <td>La CPU lee y escribe información en ella.</td>
                    </tr>
                    <tr>
                        <td>Periféricos</td>
                        <td>Permiten entrada y salida de información.</td>
                        <td>La CPU se comunica con ellos mediante puertos o interfaces.</td>
                    </tr>
                    <tr>
                        <td>8255</td>
                        <td>Controla entrada y salida paralela.</td>
                        <td>Sirve como puente entre la CPU y dispositivos externos.</td>
                    </tr>
                    <tr>
                        <td>8259</td>
                        <td>Administra interrupciones.</td>
                        <td>Organiza eventos externos que requieren atención de la CPU.</td>
                    </tr>
                    <tr>
                        <td>Buses</td>
                        <td>Transportan datos, direcciones y señales.</td>
                        <td>Permiten la comunicación entre todos los componentes.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Resumen</span>
            <h2>Lo más importante de la unidad</h2>
            <p>
                Antes de avanzar a la programación del microprocesador, recordá estas ideas.
            </p>
        </div>

        <div class="summary-grid">
            <article class="summary-item">
                <span>01</span>
                <p>
                    El microprocesador ejecuta instrucciones y coordina las operaciones
                    principales del sistema.
                </p>
            </article>

            <article class="summary-item">
                <span>02</span>
                <p>
                    La arquitectura Von Neumann usa una misma memoria para datos
                    e instrucciones.
                </p>
            </article>

            <article class="summary-item">
                <span>03</span>
                <p>
                    El diagrama de bloques permite comprender las partes internas
                    del microprocesador.
                </p>
            </article>

            <article class="summary-item">
                <span>04</span>
                <p>
                    Los buses de datos, direcciones y control permiten la comunicación
                    entre CPU, memoria y periféricos.
                </p>
            </article>

            <article class="summary-item">
                <span>05</span>
                <p>
                    El 8255 permite manejar dispositivos de entrada y salida paralela.
                </p>
            </article>

            <article class="summary-item">
                <span>06</span>
                <p>
                    El 8259 administra interrupciones para que la CPU atienda eventos
                    externos de forma ordenada.
                </p>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Cuestionario</span>
            <h2>Comprueba lo aprendido</h2>
            <p>
                Responde las preguntas y presiona el botón para calcular tu puntuación.
                Cada pregunta vale 1 punto.
            </p>
        </div>

        <form class="quiz" id="unidad2Quiz">
            <article class="quiz-question">
                <h3>1. ¿Cuál es la función principal del microprocesador?</h3>

                <label>
                    <input type="radio" name="q1" value="a">
                    Ejecutar instrucciones y procesar datos.
                </label>

                <label>
                    <input type="radio" name="q1" value="b">
                    Imprimir hojas automáticamente.
                </label>

                <label>
                    <input type="radio" name="q1" value="c">
                    Servir únicamente como memoria permanente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>2. ¿Qué caracteriza a la arquitectura Von Neumann?</h3>

                <label>
                    <input type="radio" name="q2" value="a">
                    Usa memorias separadas para datos e instrucciones.
                </label>

                <label>
                    <input type="radio" name="q2" value="b">
                    Usa una misma memoria para datos e instrucciones.
                </label>

                <label>
                    <input type="radio" name="q2" value="c">
                    No utiliza memoria.
                </label>
            </article>

            <article class="quiz-question">
                <h3>3. ¿Qué parte realiza operaciones aritméticas y lógicas?</h3>

                <label>
                    <input type="radio" name="q3" value="a">
                    ALU.
                </label>

                <label>
                    <input type="radio" name="q3" value="b">
                    Monitor.
                </label>

                <label>
                    <input type="radio" name="q3" value="c">
                    Teclado.
                </label>
            </article>

            <article class="quiz-question">
                <h3>4. ¿Qué hace la unidad de control?</h3>

                <label>
                    <input type="radio" name="q4" value="a">
                    Coordina e interpreta instrucciones dentro del procesador.
                </label>

                <label>
                    <input type="radio" name="q4" value="b">
                    Guarda archivos personales.
                </label>

                <label>
                    <input type="radio" name="q4" value="c">
                    Produce energía eléctrica.
                </label>
            </article>

            <article class="quiz-question">
                <h3>5. ¿Para qué sirve el bus de datos?</h3>

                <label>
                    <input type="radio" name="q5" value="a">
                    Para transportar información entre componentes.
                </label>

                <label>
                    <input type="radio" name="q5" value="b">
                    Para enfriar el procesador.
                </label>

                <label>
                    <input type="radio" name="q5" value="c">
                    Para mostrar imágenes en pantalla únicamente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>6. ¿Qué indica el bus de direcciones?</h3>

                <label>
                    <input type="radio" name="q6" value="a">
                    La ubicación de memoria o dispositivo al que se desea acceder.
                </label>

                <label>
                    <input type="radio" name="q6" value="b">
                    La temperatura del procesador.
                </label>

                <label>
                    <input type="radio" name="q6" value="c">
                    El color de la pantalla.
                </label>
            </article>

            <article class="quiz-question">
                <h3>7. ¿Qué función cumple el bus de control?</h3>

                <label>
                    <input type="radio" name="q7" value="a">
                    Transporta señales para coordinar operaciones como lectura o escritura.
                </label>

                <label>
                    <input type="radio" name="q7" value="b">
                    Solo almacena música.
                </label>

                <label>
                    <input type="radio" name="q7" value="c">
                    Reemplaza a la memoria RAM.
                </label>
            </article>

            <article class="quiz-question">
                <h3>8. ¿Qué es el 8255?</h3>

                <label>
                    <input type="radio" name="q8" value="a">
                    Una interfaz programable de entrada y salida paralela.
                </label>

                <label>
                    <input type="radio" name="q8" value="b">
                    Un tipo de pantalla.
                </label>

                <label>
                    <input type="radio" name="q8" value="c">
                    Un lenguaje de programación.
                </label>
            </article>

            <article class="quiz-question">
                <h3>9. ¿Qué es el 8259?</h3>

                <label>
                    <input type="radio" name="q9" value="a">
                    Un controlador programable de interrupciones.
                </label>

                <label>
                    <input type="radio" name="q9" value="b">
                    Un disco duro.
                </label>

                <label>
                    <input type="radio" name="q9" value="c">
                    Una memoria USB.
                </label>
            </article>

            <article class="quiz-question">
                <h3>10. ¿Qué permite una interrupción?</h3>

                <label>
                    <input type="radio" name="q10" value="a">
                    Que un dispositivo externo solicite atención de la CPU.
                </label>

                <label>
                    <input type="radio" name="q10" value="b">
                    Que la computadora se apague sin motivo.
                </label>

                <label>
                    <input type="radio" name="q10" value="c">
                    Que la memoria deje de funcionar permanentemente.
                </label>
            </article>

            <div class="quiz-actions">
                <button type="button" class="btn btn-primary" id="checkUnidad2Quiz">
                    Calcular puntuación
                </button>

                <button type="reset" class="btn btn-light" id="resetUnidad2Quiz">
                    Reiniciar
                </button>
            </div>

            <div class="quiz-result" id="unidad2QuizResult">
                Responde el cuestionario para ver tu resultado.
            </div>
        </form>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente</span>
                <h2>Continúa con la Unidad III</h2>
                <p>
                    Ahora que conoces la arquitectura del microprocesador, puedes estudiar
                    cómo se programa usando lenguaje ensamblador y EMU8086.
                </p>
            </div>

            <a href="unidad3.php"
                class="btn btn-primary locked-next-unit"
                data-required-quiz="unidad2Quiz"
                data-min-score="7">
                Ir a Unidad III
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>