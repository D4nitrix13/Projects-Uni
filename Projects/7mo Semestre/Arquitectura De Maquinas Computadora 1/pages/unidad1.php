<?php
$pageTitle = "Unidad I | Introducción a los Microprocesadores y Microcontroladores";
$currentPage = "unidad1";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Unidad I</span>
        <h1>Introducción a los microprocesadores y microcontroladores</h1>
        <p>
            En esta guía aprenderás, de forma sencilla, cómo se organiza una computadora,
            qué papel cumple el procesador, cómo funciona la memoria y cuál es la diferencia
            entre un microprocesador y un microcontrolador.
        </p>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos de la unidad</span>
            <h2>¿Qué aprenderás en esta unidad?</h2>
            <p>
                Esta unidad es el punto de partida para comprender cómo trabaja una computadora
                por dentro. Los temas se presentan de forma ordenada, usando la numeración
                original del documento como referencia.
            </p>
        </div>

        <div class="unit-index">
            <article class="unit-index-card">
                <span class="badge">Contenido 1.1</span>
                <h3>Arquitectura y organización</h3>
                <ul>
                    <li>Arquitectura y organización de computadora.</li>
                    <li>Arquitectura.</li>
                    <li>Organización.</li>
                    <li>Estructura.</li>
                    <li>Función.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 1.1.2</span>
                <h3>Estructura de la computadora</h3>
                <ul>
                    <li>Procesamiento.</li>
                    <li>Sistema de memoria.</li>
                    <li>Sistema de entrada y salida.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 1.2</span>
                <h3>Microprocesador y microcontrolador</h3>
                <ul>
                    <li>Definición de microprocesador.</li>
                    <li>Definición de microcontrolador.</li>
                    <li>Diferencias entre ambos.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 1.1</span>
            <h2>Conceptos de arquitectura y organización de computadoras</h2>
            <p>
                Una computadora está formada por varios componentes que trabajan juntos.
                Para estudiarla mejor, se usan dos conceptos importantes:
                <strong>arquitectura</strong> y <strong>organización</strong>.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card lesson-card">
                <div class="lesson-number">Contenido 1.1.1</div>
                <h2>Arquitectura y organización de computadora</h2>
                <p>
                    Una computadora no es solamente una pantalla, teclado o gabinete.
                    Internamente está formada por componentes que procesan datos,
                    almacenan información y permiten la comunicación con dispositivos externos.
                </p>
                <p>
                    Para entender mejor su funcionamiento se estudian dos ideas:
                    la arquitectura, que representa el diseño lógico, y la organización,
                    que representa la forma en que ese diseño se implementa físicamente.
                </p>
            </article>

            <article class="content-card lesson-card">
                <div class="lesson-number">Idea clave</div>
                <h2>Diferencia sencilla</h2>
                <p>
                    Puedes imaginar una computadora como una casa. La arquitectura sería
                    el plano general de la casa. La organización sería la forma real en que
                    se construyó: cables, materiales, conexiones y distribución interna.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> la arquitectura indica qué puede hacer
                    el sistema; la organización explica cómo lo hace internamente.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 1.1.1.1</span>
            <h2>Arquitectura</h2>
            <p>
                La arquitectura de computadoras estudia el diseño lógico del sistema
                y las características que son visibles para el programador.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>¿Qué estudia?</h3>
                <p>
                    Estudia el conjunto de instrucciones, registros, tipos de datos,
                    modos de direccionamiento y la forma en que el procesador interpreta
                    las órdenes.
                </p>
            </article>

            <article class="card">
                <h3>Ejemplo práctico</h3>
                <p>
                    Cuando se dice que una computadora es de 32 o 64 bits, se está
                    hablando de una característica relacionada con su arquitectura.
                </p>
            </article>

            <article class="card">
                <h3>¿Por qué es importante?</h3>
                <p>
                    Permite entender cómo el software se comunica con el hardware
                    y por qué ciertos programas funcionan solamente en determinadas máquinas.
                </p>
            </article>
        </div>

        <div class="concept-box">
            <h3>Definición corta</h3>
            <p>
                La arquitectura de computadoras es el diseño lógico del sistema,
                es decir, lo que el programador necesita conocer para escribir
                instrucciones que la máquina pueda ejecutar.
            </p>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 1.1.1.2</span>
            <h2>Organización</h2>
            <p>
                La organización de computadoras describe cómo están implementados
                y conectados internamente los componentes del sistema.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>¿Qué analiza?</h3>
                <p>
                    Analiza buses, señales eléctricas, memoria, unidad de control,
                    ALU, registros internos y conexiones físicas entre componentes.
                </p>
            </article>

            <article class="card">
                <h3>Ejemplo práctico</h3>
                <p>
                    Dos computadoras pueden tener la misma arquitectura, pero diferente
                    organización interna, como distinta velocidad de memoria o diferente
                    cantidad de memoria caché.
                </p>
            </article>

            <article class="card">
                <h3>¿Por qué es importante?</h3>
                <p>
                    Ayuda a comprender el rendimiento, consumo de energía, velocidad
                    y eficiencia del sistema.
                </p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos 1.1.1.2.1 y 1.1.1.2.2</span>
            <h2>Estructura y función</h2>
            <p>
                Para comprender la organización de una computadora se deben estudiar
                dos aspectos: cómo están conectadas sus partes y qué trabajo realiza cada una.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>Estructura</h2>
                <p>
                    La estructura se refiere a la forma en que los componentes de la
                    computadora están conectados entre sí. Por ejemplo, la CPU se comunica
                    con la memoria y con los dispositivos de entrada y salida mediante buses.
                </p>

                <ul class="styled-list">
                    <li>CPU o procesador.</li>
                    <li>Memoria principal.</li>
                    <li>Dispositivos de entrada.</li>
                    <li>Dispositivos de salida.</li>
                    <li>Buses de comunicación.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Función</h2>
                <p>
                    La función describe lo que hace cada componente. Cada parte tiene
                    una tarea específica dentro del sistema.
                </p>

                <ul class="styled-list">
                    <li>La CPU procesa instrucciones.</li>
                    <li>La memoria guarda datos e instrucciones.</li>
                    <li>Los buses transportan información.</li>
                    <li>Los dispositivos de entrada reciben datos.</li>
                    <li>Los dispositivos de salida muestran resultados.</li>
                </ul>
            </article>
        </div>

        <div class="diagram big-diagram">
            <div>Entrada</div>
            <span>→</span>
            <div>Procesamiento</div>
            <span>→</span>
            <div>Memoria</div>
            <span>→</span>
            <div>Salida</div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 1.1.2</span>
            <h2>Estructura de la computadora</h2>
            <p>
                Una computadora funciona porque varios sistemas trabajan juntos:
                el sistema de procesamiento, el sistema de memoria y el sistema
                de entrada y salida.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">CPU</div>
                <span class="badge">Contenido 1.1.2.1</span>
                <h3>Procesamiento</h3>
                <p>
                    El procesamiento es realizado principalmente por la CPU.
                    Esta interpreta instrucciones, realiza operaciones aritméticas
                    y lógicas, y coordina el funcionamiento del sistema.
                </p>
                <p>
                    Dentro de la CPU se encuentran elementos importantes como la ALU,
                    la unidad de control y los registros.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">RAM</div>
                <span class="badge">Contenido 1.1.2.3</span>
                <h3>Sistema de memoria</h3>
                <p>
                    El sistema de memoria almacena los datos y programas que la computadora
                    necesita para trabajar. Puede ser temporal, como la RAM, o permanente,
                    como la ROM y el almacenamiento interno.
                </p>
                <p>
                    La memoria permite que la CPU tenga acceso rápido a la información
                    necesaria para ejecutar instrucciones.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">E/S</div>
                <span class="badge">Contenido 1.1.2.3</span>
                <h3>Sistema de entrada y salida</h3>
                <p>
                    El sistema de entrada y salida permite que la computadora se comunique
                    con el exterior. Incluye dispositivos como teclado, mouse, pantalla,
                    impresora, sensores, puertos USB y otros periféricos.
                </p>
                <p>
                    Sin entrada y salida, la computadora no podría recibir datos ni mostrar
                    resultados al usuario.
                </p>
            </article>
        </div>

        <div class="note">
            <strong>Idea clave:</strong> una computadora recibe datos, los procesa,
            los puede almacenar y finalmente entrega un resultado.
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 1.2</span>
            <h2>Diferencia entre microprocesador y microcontrolador</h2>
            <p>
                Ambos son circuitos electrónicos capaces de procesar información,
                pero no están diseñados para el mismo tipo de trabajo.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 1.2.1</span>
                <h2>Microprocesador</h2>
                <p>
                    Un microprocesador es un circuito integrado que contiene principalmente
                    la unidad central de procesamiento, conocida como CPU. Su función
                    principal es ejecutar instrucciones y realizar operaciones con datos.
                </p>
                <p>
                    Normalmente necesita otros componentes externos para funcionar como
                    sistema completo, por ejemplo memoria RAM, almacenamiento, puertos
                    y periféricos.
                </p>

                <div class="example-box">
                    <strong>Ejemplos:</strong> Intel Core, AMD Ryzen, Intel Pentium
                    y algunos procesadores ARM usados en dispositivos modernos.
                </div>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 1.2.2</span>
                <h2>Microcontrolador</h2>
                <p>
                    Un microcontrolador es un sistema completo integrado en un solo chip.
                    Incluye CPU, memoria y periféricos básicos de entrada y salida.
                </p>
                <p>
                    Está diseñado para controlar tareas específicas. Por eso se usa mucho
                    en sistemas embebidos, automatización, robótica, sensores y dispositivos
                    electrónicos.
                </p>

                <div class="example-box">
                    <strong>Ejemplos:</strong> Arduino UNO con ATmega328P, PIC, ESP32,
                    STM32 y microcontroladores AVR.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 1.2.3</span>
            <h2>Diferencias principales</h2>
            <p>
                Esta tabla resume de forma simple cuándo se usa cada uno y qué los diferencia.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Aspecto</th>
                        <th>Microprocesador</th>
                        <th>Microcontrolador</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Integración</td>
                        <td>Contiene principalmente la CPU.</td>
                        <td>Integra CPU, memoria y periféricos en un solo chip.</td>
                    </tr>
                    <tr>
                        <td>Componentes externos</td>
                        <td>Necesita memoria, puertos y periféricos externos.</td>
                        <td>Puede funcionar con pocos componentes adicionales.</td>
                    </tr>
                    <tr>
                        <td>Uso principal</td>
                        <td>Computadoras, laptops, servidores y sistemas de alto rendimiento.</td>
                        <td>Sistemas embebidos, sensores, robots y control electrónico.</td>
                    </tr>
                    <tr>
                        <td>Consumo de energía</td>
                        <td>Generalmente consume más energía.</td>
                        <td>Generalmente consume menos energía.</td>
                    </tr>
                    <tr>
                        <td>Costo del sistema</td>
                        <td>Puede ser más costoso porque requiere más componentes.</td>
                        <td>Suele ser más económico para tareas específicas.</td>
                    </tr>
                    <tr>
                        <td>Ejemplo de uso</td>
                        <td>Una computadora personal.</td>
                        <td>Un Arduino controlando un LED o un sensor.</td>
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
                Antes de pasar a la siguiente unidad, asegurate de recordar estas ideas.
            </p>
        </div>

        <div class="summary-grid">
            <article class="summary-item">
                <span>01</span>
                <p>La arquitectura explica el diseño lógico de la computadora.</p>
            </article>

            <article class="summary-item">
                <span>02</span>
                <p>La organización explica cómo se conectan y funcionan físicamente los componentes.</p>
            </article>

            <article class="summary-item">
                <span>03</span>
                <p>La computadora trabaja con entrada, procesamiento, memoria y salida.</p>
            </article>

            <article class="summary-item">
                <span>04</span>
                <p>La CPU es la encargada principal de procesar instrucciones y datos.</p>
            </article>

            <article class="summary-item">
                <span>05</span>
                <p>El microprocesador necesita otros componentes externos para formar un sistema completo.</p>
            </article>

            <article class="summary-item">
                <span>06</span>
                <p>El microcontrolador integra varios elementos en un solo chip y se usa para tareas específicas.</p>
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

        <form class="quiz" id="unidad1Quiz">
            <article class="quiz-question">
                <h3>1. ¿Qué estudia principalmente la arquitectura de computadoras?</h3>

                <label>
                    <input type="radio" name="q1" value="a">
                    La marca comercial de la computadora.
                </label>

                <label>
                    <input type="radio" name="q1" value="b">
                    El diseño lógico visible para el programador.
                </label>

                <label>
                    <input type="radio" name="q1" value="c">
                    El color y tamaño físico del gabinete.
                </label>
            </article>

            <article class="quiz-question">
                <h3>2. ¿Qué describe la organización de computadoras?</h3>

                <label>
                    <input type="radio" name="q2" value="a">
                    La forma en que se implementan y conectan los componentes internos.
                </label>

                <label>
                    <input type="radio" name="q2" value="b">
                    Solamente los programas instalados.
                </label>

                <label>
                    <input type="radio" name="q2" value="c">
                    El diseño gráfico del sistema operativo.
                </label>
            </article>

            <article class="quiz-question">
                <h3>3. ¿Cuál es la función principal de la CPU?</h3>

                <label>
                    <input type="radio" name="q3" value="a">
                    Imprimir documentos.
                </label>

                <label>
                    <input type="radio" name="q3" value="b">
                    Ejecutar instrucciones y procesar datos.
                </label>

                <label>
                    <input type="radio" name="q3" value="c">
                    Almacenar archivos permanentemente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>4. ¿Qué sistema permite guardar datos e instrucciones?</h3>

                <label>
                    <input type="radio" name="q4" value="a">
                    Sistema de memoria.
                </label>

                <label>
                    <input type="radio" name="q4" value="b">
                    Sistema de ventilación.
                </label>

                <label>
                    <input type="radio" name="q4" value="c">
                    Sistema de sonido.
                </label>
            </article>

            <article class="quiz-question">
                <h3>5. ¿Qué permite el sistema de entrada y salida?</h3>

                <label>
                    <input type="radio" name="q5" value="a">
                    Que la computadora se comunique con dispositivos externos.
                </label>

                <label>
                    <input type="radio" name="q5" value="b">
                    Que la computadora aumente su peso.
                </label>

                <label>
                    <input type="radio" name="q5" value="c">
                    Que la memoria RAM sea permanente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>6. ¿Qué es un microprocesador?</h3>

                <label>
                    <input type="radio" name="q6" value="a">
                    Un circuito que contiene principalmente la CPU.
                </label>

                <label>
                    <input type="radio" name="q6" value="b">
                    Un monitor pequeño.
                </label>

                <label>
                    <input type="radio" name="q6" value="c">
                    Un tipo de cable USB.
                </label>
            </article>

            <article class="quiz-question">
                <h3>7. ¿Qué caracteriza a un microcontrolador?</h3>

                <label>
                    <input type="radio" name="q7" value="a">
                    Integra CPU, memoria y periféricos en un solo chip.
                </label>

                <label>
                    <input type="radio" name="q7" value="b">
                    Solo funciona como pantalla.
                </label>

                <label>
                    <input type="radio" name="q7" value="c">
                    No puede ejecutar instrucciones.
                </label>
            </article>

            <article class="quiz-question">
                <h3>8. ¿Cuál opción es un ejemplo común de microcontrolador?</h3>

                <label>
                    <input type="radio" name="q8" value="a">
                    Arduino UNO.
                </label>

                <label>
                    <input type="radio" name="q8" value="b">
                    Teclado mecánico.
                </label>

                <label>
                    <input type="radio" name="q8" value="c">
                    Monitor LCD.
                </label>
            </article>

            <article class="quiz-question">
                <h3>9. ¿Cuál consume normalmente menos energía?</h3>

                <label>
                    <input type="radio" name="q9" value="a">
                    Microcontrolador.
                </label>

                <label>
                    <input type="radio" name="q9" value="b">
                    Servidor de alto rendimiento.
                </label>

                <label>
                    <input type="radio" name="q9" value="c">
                    Computadora de escritorio completa.
                </label>
            </article>

            <article class="quiz-question">
                <h3>10. ¿Cuál es la mejor diferencia general entre microprocesador y microcontrolador?</h3>

                <label>
                    <input type="radio" name="q10" value="a">
                    El microprocesador es solo para sonido y el microcontrolador solo para video.
                </label>

                <label>
                    <input type="radio" name="q10" value="b">
                    El microprocesador requiere más componentes externos; el microcontrolador integra varios elementos en un chip.
                </label>

                <label>
                    <input type="radio" name="q10" value="c">
                    No existe ninguna diferencia.
                </label>
            </article>

            <div class="quiz-actions">
                <button type="button" class="btn btn-primary" id="checkUnidad1Quiz">
                    Calcular puntuación
                </button>

                <button type="reset" class="btn btn-light" id="resetUnidad1Quiz">
                    Reiniciar
                </button>
            </div>

            <div class="quiz-result" id="unidad1QuizResult">
                Responde el cuestionario para ver tu resultado.
            </div>
        </form>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente</span>
                <h2>Continúa con la Unidad II</h2>
                <p>
                    Ahora que conoces los conceptos básicos, puedes estudiar la arquitectura
                    del microprocesador y su conexión con memoria y periféricos.
                </p>
            </div>

            <a href="unidad2.php"
                class="btn btn-primary locked-next-unit"
                data-required-quiz="unidad1Quiz"
                data-min-score="7">
                Ir a Unidad II
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>