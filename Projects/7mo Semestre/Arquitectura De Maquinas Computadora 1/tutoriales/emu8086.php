<?php
$pageTitle = "Tutorial EMU8086";
$currentPage = "emu8086";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Tutorial</span>
        <h1>Instalación y uso de EMU8086</h1>
        <p>
            En esta guía aprenderás a descargar, instalar y utilizar EMU8086,
            un emulador que permite escribir, compilar y ejecutar programas
            en lenguaje ensamblador para el microprocesador 8086.
        </p>

        <div class="hero-actions">
            <a href="../assets/downloads/emu8086.zip"
                download
                class="btn btn-primary">
                Descargar EMU8086
            </a>

            <a href="../practicas/emu8086-practicas.php" class="btn btn-secondary">
                Ver prácticas
            </a>

            <a href="arduino-tinkercad.php" class="btn btn-secondary">
                Tutorial de Arduino
            </a>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Introducción</span>
            <h2>¿Qué es EMU8086?</h2>
            <p>
                EMU8086 es un entorno de programación y emulación para el procesador
                Intel 8086. Permite escribir código en lenguaje ensamblador, compilarlo,
                ejecutarlo paso a paso y observar el comportamiento de registros,
                memoria e interrupciones.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Para qué sirve?</h2>
                <p>
                    Sirve para practicar programación en ensamblador sin necesidad
                    de tener una computadora antigua con procesador 8086. El programa
                    simula el comportamiento del microprocesador y facilita el aprendizaje.
                </p>

                <ul class="styled-list">
                    <li>Escribir programas en lenguaje ensamblador.</li>
                    <li>Compilar código para el 8086.</li>
                    <li>Ejecutar programas paso a paso.</li>
                    <li>Observar registros como AX, BX, CX y DX.</li>
                    <li>Comprender interrupciones como <code>INT 21h</code>.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>¿Por qué lo usamos?</h2>
                <p>
                    Porque permite relacionar la teoría de arquitectura del microprocesador
                    con la práctica. Al ejecutar un programa, se puede ver cómo cambian
                    los registros, cómo se mueve la información y cómo responde el sistema.
                </p>

                <div class="note">
                    <strong>Idea clave:</strong> EMU8086 ayuda a entender cómo trabaja
                    internamente un programa de bajo nivel.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Descarga</span>
            <h2>Descargar EMU8086</h2>
            <p>
                Puedes descargar el instalador directamente desde el archivo local
                incluido en este proyecto.
            </p>
        </div>

        <div class="cards-grid two-columns">
            <article class="card featured-card">
                <h3>Archivo disponible en el servidor</h3>
                <p>
                    Esta opción descarga el archivo comprimido directamente desde
                    la carpeta local del proyecto.
                </p>

                <a href="../assets/downloads/emu8086.zip"
                    download
                    class="btn btn-primary">
                    Descargar archivo ZIP
                </a>
            </article>

            <article class="card featured-card">
                <h3>Ruta del archivo</h3>
                <p>
                    El archivo de instalación está almacenado dentro del proyecto para
                    que los estudiantes puedan descargarlo sin depender de enlaces externos.
                </p>

                <div class="note">
                    <strong>Ruta:</strong>
                    <code>assets/downloads/emu8086.zip</code>
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Instalación</span>
            <h2>Pasos para instalar EMU8086</h2>
            <p>
                Después de descargar el archivo ZIP desde esta página, sigue estos
                pasos para instalar el programa en tu computadora.
            </p>
        </div>

        <div class="timeline">
            <article class="timeline-item">
                <span>1</span>
                <div>
                    <h3>Descargar el archivo ZIP</h3>
                    <p>
                        Haz clic en el botón <strong>Descargar EMU8086</strong> o
                        <strong>Descargar archivo ZIP</strong>. El navegador descargará
                        el archivo comprimido desde el servidor del proyecto.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>2</span>
                <div>
                    <h3>Extraer el archivo</h3>
                    <p>
                        Busca el archivo descargado, haz clic derecho sobre él y selecciona
                        la opción para extraerlo. Puedes usar herramientas como WinRAR,
                        7-Zip o el extractor integrado del sistema.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>3</span>
                <div>
                    <h3>Abrir la carpeta extraída</h3>
                    <p>
                        Entra a la carpeta que se creó después de extraer el archivo.
                        Dentro debería estar el instalador o ejecutable de EMU8086.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>4</span>
                <div>
                    <h3>Ejecutar el instalador</h3>
                    <p>
                        Haz doble clic sobre el instalador de EMU8086 y sigue los pasos
                        que aparecen en pantalla.
                    </p>
                </div>
            </article>

            <article class="timeline-item">
                <span>5</span>
                <div>
                    <h3>Finalizar instalación</h3>
                    <p>
                        Cuando termine la instalación, busca EMU8086 en el menú de inicio
                        o en el acceso directo creado en el escritorio.
                    </p>
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Uso básico</span>
            <h2>Cómo crear tu primer programa</h2>
            <p>
                Una vez instalado EMU8086, puedes crear un archivo nuevo y escribir
                tu primer programa en ensamblador.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>Paso 1</h3>
                <p>
                    Abre EMU8086 desde el acceso directo o desde el menú de inicio.
                </p>
            </article>

            <article class="card">
                <h3>Paso 2</h3>
                <p>
                    Selecciona la opción para crear un nuevo archivo de código fuente.
                </p>
            </article>

            <article class="card">
                <h3>Paso 3</h3>
                <p>
                    Escribe el código ensamblador dentro del editor principal.
                </p>
            </article>

            <article class="card">
                <h3>Paso 4</h3>
                <p>
                    Compila el programa para verificar que no tenga errores de sintaxis.
                </p>
            </article>

            <article class="card">
                <h3>Paso 5</h3>
                <p>
                    Ejecuta el programa y observa el resultado en pantalla.
                </p>
            </article>

            <article class="card">
                <h3>Paso 6</h3>
                <p>
                    Usa la ejecución paso a paso para ver cómo cambian los registros.
                </p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Primer programa</span>
            <h2>Hola mundo en EMU8086</h2>
            <p>
                Este programa muestra un mensaje en pantalla usando la interrupción
                <code>INT 21h</code>.
            </p>
        </div>

        <pre><code>.model small
.stack 100h

.data
    mensaje db 'Hola desde EMU8086$'

.code
main proc
    mov ax, @data
    mov ds, ax

    mov ah, 09h
    lea dx, mensaje
    int 21h

    mov ah, 4Ch
    int 21h
main endp
end main</code></pre>

        <div class="note">
            <strong>Explicación:</strong> <code>AH = 09h</code> indica que se desea
            mostrar una cadena de texto. <code>DX</code> apunta al mensaje y
            <code>INT 21h</code> ejecuta el servicio del sistema. El símbolo
            <code>$</code> indica el final del texto.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Conceptos importantes</span>
            <h2>Elementos que debes observar en EMU8086</h2>
            <p>
                Al ejecutar un programa, no solo importa ver el resultado final.
                También es importante observar qué ocurre internamente.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">AX</div>
                <h3>Registros</h3>
                <p>
                    Observa cómo cambian registros como AX, BX, CX, DX, DS e IP
                    durante la ejecución.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">MEM</div>
                <h3>Memoria</h3>
                <p>
                    Revisa cómo se almacenan datos, variables y cadenas de texto
                    dentro de la memoria simulada.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">INT</div>
                <h3>Interrupciones</h3>
                <p>
                    Identifica cómo se usan interrupciones como <code>INT 21h</code>
                    para mostrar texto o finalizar el programa.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">IP</div>
                <h3>Flujo del programa</h3>
                <p>
                    Observa cómo el puntero de instrucción avanza conforme se ejecuta
                    cada línea del programa.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">ERR</div>
                <h3>Errores</h3>
                <p>
                    Si el programa no compila, revisa errores de escritura, etiquetas,
                    segmentos o instrucciones mal escritas.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">RUN</div>
                <h3>Ejecución paso a paso</h3>
                <p>
                    Ejecutar paso a paso permite comprender mejor qué hace cada instrucción.
                </p>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Errores comunes</span>
            <h2>Problemas frecuentes al usar EMU8086</h2>
            <p>
                Estos son algunos errores comunes y cómo puedes solucionarlos.
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
                        <td>No muestra el mensaje</td>
                        <td>Falta el símbolo <code>$</code> al final de la cadena.</td>
                        <td>Agrega <code>$</code> al final del texto.</td>
                    </tr>
                    <tr>
                        <td>Error al usar variables</td>
                        <td>No se cargó correctamente el segmento de datos.</td>
                        <td>Usa <code>mov ax, @data</code> y <code>mov ds, ax</code>.</td>
                    </tr>
                    <tr>
                        <td>Error de sintaxis</td>
                        <td>Una instrucción está mal escrita.</td>
                        <td>Revisa nombres como <code>MOV</code>, <code>LEA</code>, <code>INT</code>.</td>
                    </tr>
                    <tr>
                        <td>El programa no termina</td>
                        <td>Falta la interrupción de salida.</td>
                        <td>Agrega <code>mov ah, 4Ch</code> y <code>int 21h</code>.</td>
                    </tr>
                    <tr>
                        <td>Etiqueta no encontrada</td>
                        <td>Se escribió mal el nombre de una etiqueta.</td>
                        <td>Verifica que el nombre de la etiqueta coincida exactamente.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Recursos externos</span>
            <h2>Recursos externos recomendados</h2>
            <p>
                Estos enlaces pueden ayudarte a estudiar más sobre EMU8086,
                lenguaje ensamblador 8086, interrupciones y ejemplos prácticos.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card featured-card">
                <h3>Documentación de EMU8086</h3>
                <p>
                    Página de ayuda con documentación general del emulador,
                    ensamblador y microprocesador 8086.
                </p>

                <a href="https://surendrajat.github.io/emu8086/documentation/help.html"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Abrir documentación
                </a>
            </article>

            <article class="card featured-card">
                <h3>Tutoriales escritos de EMU8086</h3>
                <p>
                    Colección de tutoriales para aprender ensamblador 8086 desde
                    conceptos básicos hasta macros y funciones comunes.
                </p>

                <a href="https://surendrajat.github.io/emu8086/documentation/tutorials.html"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver tutoriales
                </a>
            </article>

            <article class="card featured-card">
                <h3>Tutorial para principiantes</h3>
                <p>
                    Guía inicial para estudiar la sintaxis de EMU8086 y la estructura
                    básica de un programa ensamblador.
                </p>

                <a href="https://surendrajat.github.io/emu8086/documentation/asm_tutorial_01.html"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Abrir guía inicial
                </a>
            </article>

            <article class="card featured-card">
                <h3>YouTube: introducción a EMU8086</h3>
                <p>
                    Video introductorio sobre cómo usar EMU8086 y observar registros,
                    memoria y ejecución del programa.
                </p>

                <a href="https://www.youtube.com/watch?v=h5NVYiUdAyw"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver video
                </a>
            </article>

            <article class="card featured-card">
                <h3>YouTube: Hola mundo en EMU8086</h3>
                <p>
                    Video en español con ejemplos básicos para mostrar mensajes
                    y comprender la estructura inicial del programa.
                </p>

                <a href="https://www.youtube.com/watch?v=NA2v71g0Gwg"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver tutorial
                </a>
            </article>

            <article class="card featured-card">
                <h3>YouTube: variables en EMU8086</h3>
                <p>
                    Tutorial en español sobre declaración y uso de variables
                    en lenguaje ensamblador con EMU8086.
                </p>

                <a href="https://www.youtube.com/watch?v=OlGm2T4KPso"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Ver video
                </a>
            </article>

            <article class="card featured-card">
                <h3>Referencia de instrucciones 8086</h3>
                <p>
                    Material de referencia para consultar instrucciones del procesador
                    8086 y practicar programas más completos.
                </p>

                <a href="https://content.ctcd.edu/courses/cosc2325/m22/docs/emu8086ins.pdf"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="btn btn-primary">
                    Abrir PDF
                </a>
            </article>
        </div>

        <div class="note">
            <strong>Recomendación:</strong> usa primero los recursos escritos para entender
            la estructura del código y luego mira los videos para reforzar con ejemplos visuales.
        </div>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente paso</span>
                <h2>Continúa con las prácticas y el tutorial de Arduino</h2>
                <p>
                    Después de instalar y probar EMU8086, puedes continuar con ejercicios
                    de ensamblador o pasar al tutorial de Arduino con Tinkercad para
                    practicar simulación de circuitos.
                </p>
            </div>

            <div class="hero-actions">
                <a href="../practicas/emu8086-practicas.php" class="btn btn-primary">
                    Ver prácticas de EMU8086
                </a>

                <a href="arduino-tinkercad.php" class="btn btn-secondary">
                    Ir al tutorial de Arduino
                </a>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>