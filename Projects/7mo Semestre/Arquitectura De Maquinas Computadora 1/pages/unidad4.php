<?php
$pageTitle = "Unidad IV | Arquitectura de los Microcontroladores";
$currentPage = "unidad4";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Unidad IV</span>
        <h1>Arquitectura de los microcontroladores</h1>
        <p>
            En esta unidad aprenderás qué es un microcontrolador, cuáles son sus tipos
            principales y cómo se comparan arquitecturas como Harvard, Von Neumann,
            CISC y RISC.
        </p>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos de la unidad</span>
            <h2>¿Qué aprenderás en esta unidad?</h2>
            <p>
                Esta unidad explica cómo está formado un microcontrolador y por qué
                es tan usado en sistemas embebidos, automatización, sensores, robots
                y dispositivos electrónicos.
            </p>
        </div>

        <div class="unit-index">
            <article class="unit-index-card">
                <span class="badge">Contenido 4.1</span>
                <h3>Arquitectura de microcontroladores</h3>
                <ul>
                    <li>Qué es un microcontrolador.</li>
                    <li>Componentes internos principales.</li>
                    <li>Diferencia con un microprocesador.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 4.1.1</span>
                <h3>Tipos de microcontroladores</h3>
                <ul>
                    <li>Microcontroladores embebidos.</li>
                    <li>Microcontroladores con memoria externa.</li>
                    <li>Usos comunes de cada tipo.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 4.1.2</span>
                <h3>Arquitecturas internas</h3>
                <ul>
                    <li>Harvard vs Von Neumann.</li>
                    <li>CISC vs RISC.</li>
                    <li>Ventajas de cada modelo.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 4.1</span>
            <h2>Arquitectura de los microcontroladores</h2>
            <p>
                Un microcontrolador es un circuito integrado diseñado para controlar
                tareas específicas. A diferencia de un microprocesador, integra varios
                elementos importantes dentro de un solo chip.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card lesson-card">
                <div class="lesson-number">Idea central</div>
                <h2>¿Qué es un microcontrolador?</h2>
                <p>
                    Un microcontrolador es como una pequeña computadora integrada en
                    un solo chip. Tiene una CPU, memoria y periféricos básicos para
                    controlar dispositivos externos.
                </p>
                <p>
                    Se usa cuando se necesita controlar una tarea concreta, por ejemplo
                    encender un LED, leer un sensor, mover un motor o activar una alarma.
                </p>

                <div class="example-box">
                    <strong>Ejemplos:</strong> Arduino UNO, PIC, ESP32, STM32,
                    ATmega328P y microcontroladores AVR.
                </div>
            </article>

            <article class="content-card lesson-card">
                <div class="lesson-number">Uso práctico</div>
                <h2>¿Dónde se utilizan?</h2>
                <p>
                    Los microcontroladores están presentes en muchos dispositivos
                    cotidianos porque son pequeños, económicos y consumen poca energía.
                </p>

                <ul class="styled-list">
                    <li>Electrodomésticos.</li>
                    <li>Controles remotos.</li>
                    <li>Robots educativos.</li>
                    <li>Sistemas de alarma.</li>
                    <li>Sensores inteligentes.</li>
                    <li>Automatización de luces o motores.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Componentes internos</span>
            <h2>Partes principales de un microcontrolador</h2>
            <p>
                Aunque existen muchos modelos, la mayoría de microcontroladores tienen
                componentes comunes que les permiten procesar, almacenar y comunicarse.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">CPU</div>
                <h3>Procesador interno</h3>
                <p>
                    Ejecuta las instrucciones del programa y coordina el funcionamiento
                    del microcontrolador.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">ROM</div>
                <h3>Memoria de programa</h3>
                <p>
                    Guarda el programa que será ejecutado. En muchos microcontroladores
                    esta memoria es de tipo Flash.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">RAM</div>
                <h3>Memoria de datos</h3>
                <p>
                    Almacena datos temporales mientras el programa se está ejecutando.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">E/S</div>
                <h3>Puertos de entrada y salida</h3>
                <p>
                    Permiten conectar LEDs, botones, sensores, motores, pantallas
                    y otros dispositivos.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">ADC</div>
                <h3>Conversor analógico-digital</h3>
                <p>
                    Convierte señales analógicas, como las de algunos sensores,
                    en valores digitales que el microcontrolador puede procesar.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">TIM</div>
                <h3>Temporizadores</h3>
                <p>
                    Ayudan a medir tiempo, generar retardos, controlar pulsos
                    y manejar eventos repetitivos.
                </p>
            </article>
        </div>

        <div class="diagram big-diagram">
            <div>Sensores</div>
            <span>→</span>
            <div>Microcontrolador</div>
            <span>→</span>
            <div>Actuadores</div>
        </div>

        <div class="note">
            <strong>Idea clave:</strong> un microcontrolador recibe señales, las procesa
            y genera una respuesta para controlar algún dispositivo.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 4.1.1</span>
            <h2>Diferentes tipos de microcontroladores</h2>
            <p>
                Los microcontroladores pueden clasificarse según su memoria, capacidad,
                arquitectura, tamaño de palabra y aplicación.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>Clasificación general</h2>
                <p>
                    No todos los microcontroladores tienen las mismas características.
                    Algunos están diseñados para tareas muy simples y otros para sistemas
                    más complejos.
                </p>

                <ul class="styled-list">
                    <li>Microcontroladores de 8 bits.</li>
                    <li>Microcontroladores de 16 bits.</li>
                    <li>Microcontroladores de 32 bits.</li>
                    <li>Microcontroladores de bajo consumo.</li>
                    <li>Microcontroladores con conectividad WiFi o Bluetooth.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Ejemplos comunes</h2>
                <p>
                    Algunos microcontroladores son usados en educación, otros en industria
                    y otros en dispositivos modernos conectados a internet.
                </p>

                <ul class="styled-list">
                    <li><strong>ATmega328P:</strong> usado en Arduino UNO.</li>
                    <li><strong>PIC:</strong> usado en proyectos electrónicos y control.</li>
                    <li><strong>ESP32:</strong> usado en proyectos con WiFi y Bluetooth.</li>
                    <li><strong>STM32:</strong> usado en aplicaciones más avanzadas.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 4.1.1.1</span>
            <h2>Microcontroladores embebidos</h2>
            <p>
                Los microcontroladores embebidos son aquellos integrados dentro de un
                dispositivo para cumplir una función específica.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Qué significa embebido?</h2>
                <p>
                    Un sistema embebido es un sistema electrónico diseñado para realizar
                    una tarea concreta dentro de un equipo mayor. El usuario normalmente
                    no ve el microcontrolador, pero este controla parte del funcionamiento.
                </p>

                <div class="example-box">
                    <strong>Ejemplo:</strong> en una lavadora, un microcontrolador puede
                    controlar el tiempo de lavado, el llenado de agua y el giro del motor.
                </div>
            </article>

            <article class="content-card">
                <h2>Características</h2>
                <ul class="styled-list">
                    <li>Están integrados dentro del producto final.</li>
                    <li>Realizan tareas específicas.</li>
                    <li>Suelen consumir poca energía.</li>
                    <li>Son económicos y compactos.</li>
                    <li>No necesitan un sistema operativo complejo.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 4.1.1.2</span>
            <h2>Microcontrolador con memoria externa</h2>
            <p>
                Algunos microcontroladores pueden trabajar con memoria externa cuando
                la memoria interna no es suficiente para la aplicación.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Cuándo se usa memoria externa?</h2>
                <p>
                    Se utiliza cuando el programa necesita más espacio para instrucciones,
                    datos, gráficos, registros, configuraciones o información que debe
                    almacenarse fuera del chip principal.
                </p>

                <p>
                    Esto permite crear sistemas más grandes, aunque también aumenta
                    la complejidad del diseño electrónico.
                </p>
            </article>

            <article class="content-card">
                <h2>Ventajas y desventajas</h2>

                <div class="table-container mini-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Ventajas</th>
                                <th>Desventajas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mayor capacidad de almacenamiento.</td>
                                <td>Mayor complejidad en conexiones.</td>
                            </tr>
                            <tr>
                                <td>Permite proyectos más grandes.</td>
                                <td>Puede aumentar el costo.</td>
                            </tr>
                            <tr>
                                <td>Más flexibilidad para datos externos.</td>
                                <td>Puede consumir más energía.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>
        </div>

        <div class="diagram big-diagram">
            <div>CPU interna</div>
            <span>↔</span>
            <div>Bus</div>
            <span>↔</span>
            <div>Memoria externa</div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 4.1.2</span>
            <h2>Arquitectura de microcontroladores</h2>
            <p>
                La arquitectura de un microcontrolador describe cómo están organizados
                internamente sus componentes y cómo ejecuta instrucciones.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Qué define la arquitectura?</h2>
                <p>
                    Define cómo se manejan la memoria, los datos, las instrucciones,
                    los registros y los periféricos internos.
                </p>

                <ul class="styled-list">
                    <li>Cómo se separan o comparten datos e instrucciones.</li>
                    <li>Cómo se ejecutan las instrucciones.</li>
                    <li>Qué tipo de conjunto de instrucciones utiliza.</li>
                    <li>Cómo se comunican los periféricos internos.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>¿Por qué importa?</h2>
                <p>
                    La arquitectura influye en la velocidad, consumo de energía,
                    costo, complejidad del programa y eficiencia del microcontrolador.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> la arquitectura determina cómo trabaja
                    el microcontrolador por dentro.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 4.1.2.1</span>
            <h2>Harvard vs Von Neumann</h2>
            <p>
                Estas arquitecturas explican cómo se organiza la memoria para datos
                e instrucciones.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Aspecto</th>
                        <th>Arquitectura Harvard</th>
                        <th>Arquitectura Von Neumann</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Memoria</td>
                        <td>Usa memorias separadas para instrucciones y datos.</td>
                        <td>Usa una sola memoria para instrucciones y datos.</td>
                    </tr>
                    <tr>
                        <td>Velocidad</td>
                        <td>Puede ser más rápida porque accede a datos e instrucciones por separado.</td>
                        <td>Puede ser más simple, pero puede tener cuello de botella.</td>
                    </tr>
                    <tr>
                        <td>Complejidad</td>
                        <td>Requiere una organización interna más especializada.</td>
                        <td>Su diseño es más sencillo.</td>
                    </tr>
                    <tr>
                        <td>Uso común</td>
                        <td>Muy común en microcontroladores.</td>
                        <td>Muy común en computadoras generales.</td>
                    </tr>
                    <tr>
                        <td>Ejemplo didáctico</td>
                        <td>Una libreta para instrucciones y otra para datos.</td>
                        <td>Una sola libreta para instrucciones y datos.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="concept-box">
            <h3>Diferencia sencilla</h3>
            <p>
                Harvard separa el camino de las instrucciones y los datos. Von Neumann
                usa un mismo camino para ambos. Por eso Harvard puede ser más eficiente
                en ciertos microcontroladores.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 4.1.2.2</span>
            <h2>CISC vs RISC</h2>
            <p>
                Esta comparación se refiere al tipo de instrucciones que puede ejecutar
                el procesador o microcontrolador.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>CISC</h2>
                <p>
                    CISC significa Computadora con Conjunto Complejo de Instrucciones.
                    Usa instrucciones más complejas, capaces de realizar varias operaciones
                    en una sola instrucción.
                </p>

                <ul class="styled-list">
                    <li>Instrucciones más largas o complejas.</li>
                    <li>Puede necesitar más ciclos para ejecutar una instrucción.</li>
                    <li>Reduce la cantidad de instrucciones escritas en algunos casos.</li>
                </ul>

                <div class="example-box">
                    <strong>Idea simple:</strong> una instrucción CISC puede hacer mucho,
                    pero puede tardar más.
                </div>
            </article>

            <article class="content-card">
                <h2>RISC</h2>
                <p>
                    RISC significa Computadora con Conjunto Reducido de Instrucciones.
                    Usa instrucciones simples, rápidas y generalmente más fáciles
                    de optimizar.
                </p>

                <ul class="styled-list">
                    <li>Instrucciones simples.</li>
                    <li>Ejecución rápida y eficiente.</li>
                    <li>Muy usado en microcontroladores modernos.</li>
                </ul>

                <div class="example-box">
                    <strong>Idea simple:</strong> una instrucción RISC hace menos,
                    pero normalmente se ejecuta más rápido.
                </div>
            </article>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Aspecto</th>
                        <th>CISC</th>
                        <th>RISC</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Instrucciones</td>
                        <td>Más complejas.</td>
                        <td>Más simples.</td>
                    </tr>
                    <tr>
                        <td>Ejecución</td>
                        <td>Puede requerir más ciclos.</td>
                        <td>Busca ejecutar instrucciones rápidamente.</td>
                    </tr>
                    <tr>
                        <td>Diseño</td>
                        <td>Más complejo.</td>
                        <td>Más simple y eficiente.</td>
                    </tr>
                    <tr>
                        <td>Enfoque</td>
                        <td>Hacer más con menos instrucciones.</td>
                        <td>Usar instrucciones simples y rápidas.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Resumen</span>
            <h2>Lo más importante de la unidad</h2>
            <p>
                Antes de pasar a la Unidad V, asegurate de recordar estas ideas.
            </p>
        </div>

        <div class="summary-grid">
            <article class="summary-item">
                <span>01</span>
                <p>
                    Un microcontrolador integra CPU, memoria y periféricos en un solo chip.
                </p>
            </article>

            <article class="summary-item">
                <span>02</span>
                <p>
                    Los microcontroladores embebidos están dentro de dispositivos
                    que realizan tareas específicas.
                </p>
            </article>

            <article class="summary-item">
                <span>03</span>
                <p>
                    Algunos microcontroladores usan memoria externa para ampliar
                    su capacidad.
                </p>
            </article>

            <article class="summary-item">
                <span>04</span>
                <p>
                    Harvard separa memoria de datos y memoria de instrucciones.
                </p>
            </article>

            <article class="summary-item">
                <span>05</span>
                <p>
                    Von Neumann usa una misma memoria para datos e instrucciones.
                </p>
            </article>

            <article class="summary-item">
                <span>06</span>
                <p>
                    RISC usa instrucciones simples, mientras CISC usa instrucciones
                    más complejas.
                </p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Cuestionario</span>
            <h2>Comprueba lo aprendido</h2>
            <p>
                Responde las preguntas y presiona el botón para calcular tu puntuación.
                Cada pregunta vale 1 punto.
            </p>
        </div>

        <form class="quiz" id="unidad4Quiz">
            <article class="quiz-question">
                <h3>1. ¿Qué es un microcontrolador?</h3>

                <label>
                    <input type="radio" name="q1" value="a">
                    Un sistema integrado en un solo chip con CPU, memoria y periféricos.
                </label>

                <label>
                    <input type="radio" name="q1" value="b">
                    Solamente una pantalla pequeña.
                </label>

                <label>
                    <input type="radio" name="q1" value="c">
                    Un cable de conexión.
                </label>
            </article>

            <article class="quiz-question">
                <h3>2. ¿Dónde se usan comúnmente los microcontroladores embebidos?</h3>

                <label>
                    <input type="radio" name="q2" value="a">
                    En dispositivos que realizan tareas específicas, como electrodomésticos o alarmas.
                </label>

                <label>
                    <input type="radio" name="q2" value="b">
                    Únicamente en hojas de cálculo.
                </label>

                <label>
                    <input type="radio" name="q2" value="c">
                    Solo en impresoras 3D industriales.
                </label>
            </article>

            <article class="quiz-question">
                <h3>3. ¿Para qué sirve la memoria externa en algunos microcontroladores?</h3>

                <label>
                    <input type="radio" name="q3" value="a">
                    Para ampliar la capacidad de almacenamiento o manejo de datos.
                </label>

                <label>
                    <input type="radio" name="q3" value="b">
                    Para cambiar el color del circuito.
                </label>

                <label>
                    <input type="radio" name="q3" value="c">
                    Para eliminar la CPU.
                </label>
            </article>

            <article class="quiz-question">
                <h3>4. ¿Qué característica tiene la arquitectura Harvard?</h3>

                <label>
                    <input type="radio" name="q4" value="a">
                    Usa memorias separadas para datos e instrucciones.
                </label>

                <label>
                    <input type="radio" name="q4" value="b">
                    No usa memoria.
                </label>

                <label>
                    <input type="radio" name="q4" value="c">
                    Solo funciona con pantallas.
                </label>
            </article>

            <article class="quiz-question">
                <h3>5. ¿Qué característica tiene la arquitectura Von Neumann?</h3>

                <label>
                    <input type="radio" name="q5" value="a">
                    Usa una misma memoria para datos e instrucciones.
                </label>

                <label>
                    <input type="radio" name="q5" value="b">
                    Usa una memoria diferente para cada tecla.
                </label>

                <label>
                    <input type="radio" name="q5" value="c">
                    No puede ejecutar instrucciones.
                </label>
            </article>

            <article class="quiz-question">
                <h3>6. ¿Qué significa CISC?</h3>

                <label>
                    <input type="radio" name="q6" value="a">
                    Computadora con Conjunto Complejo de Instrucciones.
                </label>

                <label>
                    <input type="radio" name="q6" value="b">
                    Circuito Interno Sin Control.
                </label>

                <label>
                    <input type="radio" name="q6" value="c">
                    Controlador Integrado Simple de Corriente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>7. ¿Qué significa RISC?</h3>

                <label>
                    <input type="radio" name="q7" value="a">
                    Computadora con Conjunto Reducido de Instrucciones.
                </label>

                <label>
                    <input type="radio" name="q7" value="b">
                    Red Interna de Sensores Compactos.
                </label>

                <label>
                    <input type="radio" name="q7" value="c">
                    Registro Independiente del Sistema Central.
                </label>
            </article>

            <article class="quiz-question">
                <h3>8. ¿Cuál suele usar instrucciones más simples?</h3>

                <label>
                    <input type="radio" name="q8" value="a">
                    RISC.
                </label>

                <label>
                    <input type="radio" name="q8" value="b">
                    CISC.
                </label>

                <label>
                    <input type="radio" name="q8" value="c">
                    Ninguno de los dos ejecuta instrucciones.
                </label>
            </article>

            <article class="quiz-question">
                <h3>9. ¿Cuál es un ejemplo común de microcontrolador?</h3>

                <label>
                    <input type="radio" name="q9" value="a">
                    Arduino UNO.
                </label>

                <label>
                    <input type="radio" name="q9" value="b">
                    Monitor LCD.
                </label>

                <label>
                    <input type="radio" name="q9" value="c">
                    Mouse pad.
                </label>
            </article>

            <article class="quiz-question">
                <h3>10. ¿Cuál es la diferencia simple entre Harvard y Von Neumann?</h3>

                <label>
                    <input type="radio" name="q10" value="a">
                    Harvard separa datos e instrucciones; Von Neumann usa una misma memoria.
                </label>

                <label>
                    <input type="radio" name="q10" value="b">
                    Harvard es un teclado y Von Neumann es un monitor.
                </label>

                <label>
                    <input type="radio" name="q10" value="c">
                    No existe ninguna diferencia.
                </label>
            </article>

            <div class="quiz-actions">
                <button type="button" class="btn btn-primary" id="checkUnidad4Quiz">
                    Calcular puntuación
                </button>

                <button type="reset" class="btn btn-light" id="resetUnidad4Quiz">
                    Reiniciar
                </button>
            </div>

            <div class="quiz-result" id="unidad4QuizResult">
                Responde el cuestionario para ver tu resultado.
            </div>
        </form>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente</span>
                <h2>Continúa con la Unidad V</h2>
                <p>
                    Después de estudiar la arquitectura de los microcontroladores,
                    puedes continuar con la programación y uso práctico de Arduino.
                </p>
            </div>

            <a href="unidad5.php"
                class="btn btn-primary locked-next-unit"
                data-required-quiz="unidad4Quiz"
                data-min-score="7">
                Ir a Unidad V
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>