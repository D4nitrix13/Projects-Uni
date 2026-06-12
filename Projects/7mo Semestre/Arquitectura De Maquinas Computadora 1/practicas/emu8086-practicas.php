<?php
$pageTitle = "Prácticas Interactivas EMU8086";
$currentPage = "emu8086";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Prácticas interactivas</span>
        <h1>Prácticas de programación en EMU8086</h1>
        <p>
            Escribe el código ensamblador, revisa si cumple con la estructura esperada
            y consulta la solución al final de cada ejercicio.
        </p>

        <div class="hero-actions">
            <a href="../tutoriales/emu8086.php" class="btn btn-primary">
                Ver tutorial de EMU8086
            </a>

            <a href="../assets/downloads/emu8086.zip" download class="btn btn-secondary">
                Descargar EMU8086
            </a>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Guía rápida</span>
            <h2>¿Cómo funcionan estas prácticas?</h2>
            <p>
                Cada ejercicio tiene un editor donde puedes escribir código. El sistema
                revisa si agregaste las partes principales del programa. No reemplaza
                al compilador de EMU8086, pero te ayuda a detectar errores comunes.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">1</div>
                <h3>Lee el objetivo</h3>
                <p>
                    Primero revisa qué debe hacer el programa.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">2</div>
                <h3>Escribe tu código</h3>
                <p>
                    Usa el editor de la práctica para escribir el programa en ensamblador.
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
            <strong>Importante:</strong> después de practicar aquí, copia el código
            en EMU8086 y ejecútalo para verificarlo con el emulador real.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Práctica 1</span>
            <h2>Mostrar un mensaje en pantalla</h2>
            <p>
                Escribe un programa que muestre el mensaje:
                <strong>Bienvenido a EMU8086</strong>.
            </p>
        </div>

        <div class="interactive-practice" data-practice="practice1">
            <div class="practice-layout">
                <article class="content-card">
                    <h3>Objetivo</h3>
                    <p>
                        Crear un programa en ensamblador que declare una cadena de texto
                        y la muestre usando la interrupción <code>INT 21h</code>.
                    </p>

                    <h3>Tu programa debe incluir</h3>
                    <ul class="styled-list">
                        <li><code>.model small</code></li>
                        <li><code>.stack 100h</code></li>
                        <li>Un segmento <code>.data</code></li>
                        <li>Una variable llamada <code>mensaje</code></li>
                        <li>El texto terminado con <code>$</code></li>
                        <li><code>mov ah, 09h</code></li>
                        <li><code>lea dx, mensaje</code></li>
                        <li><code>int 21h</code></li>
                        <li>Salida del programa con <code>mov ah, 4Ch</code></li>
                    </ul>
                </article>

                <article class="content-card">
                    <h3>Editor de código</h3>

                    <textarea class="code-editor" id="practice1Code" spellcheck="false" placeholder="Escribe aquí tu código ensamblador..."></textarea>

                    <div class="practice-actions">
                        <button type="button" class="btn btn-primary" data-check="practice1">
                            Revisar código
                        </button>

                        <button type="button" class="btn btn-light" data-fix="practice1">
                            Corregir sintaxis
                        </button>

                        <button type="button" class="btn btn-secondary-dark" data-solution="practice1">
                            Ver solución
                        </button>
                    </div>

                    <div class="practice-feedback" id="practice1Feedback">
                        Escribe tu código y presiona revisar.
                    </div>
                </article>
            </div>

            <div class="solution-box" id="practice1Solution">
                <h3>Solución recomendada</h3>
                <pre><code>.model small
.stack 100h

.data
    mensaje db 'Bienvenido a EMU8086$'

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
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Práctica 2</span>
            <h2>Suma de dos números</h2>
            <p>
                Escribe un programa que sume <strong>5 + 3</strong> usando registros.
                El resultado debe quedar en <code>AL</code>.
            </p>
        </div>

        <div class="interactive-practice" data-practice="practice2">
            <div class="practice-layout">
                <article class="content-card">
                    <h3>Objetivo</h3>
                    <p>
                        Practicar el uso de registros y la instrucción <code>ADD</code>.
                    </p>

                    <h3>Tu programa debe incluir</h3>
                    <ul class="styled-list">
                        <li><code>.model small</code></li>
                        <li><code>.stack 100h</code></li>
                        <li><code>mov al, 5</code></li>
                        <li><code>mov bl, 3</code></li>
                        <li><code>add al, bl</code></li>
                        <li>Finalización con <code>mov ah, 4Ch</code></li>
                        <li><code>int 21h</code></li>
                    </ul>
                </article>

                <article class="content-card">
                    <h3>Editor de código</h3>

                    <textarea class="code-editor" id="practice2Code" spellcheck="false" placeholder="Escribe aquí tu código ensamblador..."></textarea>

                    <div class="practice-actions">
                        <button type="button" class="btn btn-primary" data-check="practice2">
                            Revisar código
                        </button>

                        <button type="button" class="btn btn-light" data-fix="practice2">
                            Corregir sintaxis
                        </button>

                        <button type="button" class="btn btn-secondary-dark" data-solution="practice2">
                            Ver solución
                        </button>
                    </div>

                    <div class="practice-feedback" id="practice2Feedback">
                        Escribe tu código y presiona revisar.
                    </div>
                </article>
            </div>

            <div class="solution-box" id="practice2Solution">
                <h3>Solución recomendada</h3>
                <pre><code>.model small
.stack 100h

.code
main proc
    mov al, 5
    mov bl, 3
    add al, bl

    mov ah, 4Ch
    int 21h
main endp
end main</code></pre>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Práctica 3</span>
            <h2>Comparación y salto condicionado</h2>
            <p>
                Escribe un programa que compare <code>AX</code> y <code>BX</code>.
                Si <code>AX</code> es mayor, debe mostrar el mensaje:
                <strong>AX es mayor</strong>.
            </p>
        </div>

        <div class="interactive-practice" data-practice="practice3">
            <div class="practice-layout">
                <article class="content-card">
                    <h3>Objetivo</h3>
                    <p>
                        Practicar comparación de registros usando <code>CMP</code>
                        y salto condicionado usando <code>JG</code>.
                    </p>

                    <h3>Tu programa debe incluir</h3>
                    <ul class="styled-list">
                        <li>Una variable <code>mayor</code> terminada en <code>$</code></li>
                        <li>Inicialización de <code>DS</code></li>
                        <li><code>mov ax, 8</code></li>
                        <li><code>mov bx, 5</code></li>
                        <li><code>cmp ax, bx</code></li>
                        <li><code>jg etiqueta_mayor</code></li>
                        <li>Mostrar mensaje con <code>mov ah, 09h</code></li>
                        <li>Finalizar con <code>mov ah, 4Ch</code> e <code>int 21h</code></li>
                    </ul>
                </article>

                <article class="content-card">
                    <h3>Editor de código</h3>

                    <textarea class="code-editor" id="practice3Code" spellcheck="false" placeholder="Escribe aquí tu código ensamblador..."></textarea>

                    <div class="practice-actions">
                        <button type="button" class="btn btn-primary" data-check="practice3">
                            Revisar código
                        </button>

                        <button type="button" class="btn btn-light" data-fix="practice3">
                            Corregir sintaxis
                        </button>

                        <button type="button" class="btn btn-secondary-dark" data-solution="practice3">
                            Ver solución
                        </button>
                    </div>

                    <div class="practice-feedback" id="practice3Feedback">
                        Escribe tu código y presiona revisar.
                    </div>
                </article>
            </div>

            <div class="solution-box" id="practice3Solution">
                <h3>Solución recomendada</h3>
                <pre><code>.model small
.stack 100h

.data
    mayor db 'AX es mayor$'
    menor db 'AX no es mayor$'

.code
main proc
    mov ax, @data
    mov ds, ax

    mov ax, 8
    mov bx, 5

    cmp ax, bx
    jg etiqueta_mayor

    mov ah, 09h
    lea dx, menor
    int 21h
    jmp finalizar

etiqueta_mayor:
    mov ah, 09h
    lea dx, mayor
    int 21h

finalizar:
    mov ah, 4Ch
    int 21h
main endp
end main</code></pre>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Práctica 4</span>
            <h2>Ciclo con LOOP</h2>
            <p>
                Escribe un programa que use el registro <code>CX</code> como contador
                y repita una sección del programa usando <code>LOOP</code>.
            </p>
        </div>

        <div class="interactive-practice" data-practice="practice4">
            <div class="practice-layout">
                <article class="content-card">
                    <h3>Objetivo</h3>
                    <p>
                        Comprender cómo funcionan los ciclos en ensamblador usando
                        <code>CX</code> y la instrucción <code>LOOP</code>.
                    </p>

                    <h3>Tu programa debe incluir</h3>
                    <ul class="styled-list">
                        <li><code>mov cx, 5</code></li>
                        <li>Una etiqueta llamada <code>repetir</code></li>
                        <li>Una instrucción dentro del ciclo</li>
                        <li><code>loop repetir</code></li>
                        <li>Finalización con <code>int 21h</code></li>
                    </ul>
                </article>

                <article class="content-card">
                    <h3>Editor de código</h3>

                    <textarea class="code-editor" id="practice4Code" spellcheck="false" placeholder="Escribe aquí tu código ensamblador..."></textarea>

                    <div class="practice-actions">
                        <button type="button" class="btn btn-primary" data-check="practice4">
                            Revisar código
                        </button>

                        <button type="button" class="btn btn-light" data-fix="practice4">
                            Corregir sintaxis
                        </button>

                        <button type="button" class="btn btn-secondary-dark" data-solution="practice4">
                            Ver solución
                        </button>
                    </div>

                    <div class="practice-feedback" id="practice4Feedback">
                        Escribe tu código y presiona revisar.
                    </div>
                </article>
            </div>

            <div class="solution-box" id="practice4Solution">
                <h3>Solución recomendada</h3>
                <pre><code>.model small
.stack 100h

.code
main proc
    mov cx, 5

repetir:
    nop
    loop repetir

    mov ah, 4Ch
    int 21h
main endp
end main</code></pre>
            </div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente paso</span>
                <h2>Prueba tus códigos en EMU8086</h2>
                <p>
                    Después de resolver las prácticas, copia cada solución en EMU8086,
                    compila el programa y ejecútalo paso a paso para observar registros,
                    memoria e interrupciones.
                </p>
            </div>

            <a href="../tutoriales/emu8086.php" class="btn btn-primary">
                Volver al tutorial
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>