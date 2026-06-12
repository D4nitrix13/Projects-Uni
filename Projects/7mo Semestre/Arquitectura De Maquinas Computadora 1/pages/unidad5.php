<?php
$pageTitle = "Unidad V | Programadores del Microcontrolador";
$currentPage = "unidad5";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Unidad V</span>
        <h1>Programadores del microcontrolador</h1>
        <p>
            En esta unidad estudiarás el repertorio de instrucciones, los fundamentos
            del lenguaje ensamblador y el uso de herramientas como MPLAB y Proteus
            para programar y simular sistemas con microcontroladores.
        </p>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos de la unidad</span>
            <h2>¿Qué aprenderás en esta unidad?</h2>
            <p>
                Esta unidad se enfoca en cómo se programa un microcontrolador desde
                instrucciones básicas hasta la organización completa de un programa.
            </p>
        </div>

        <div class="unit-index">
            <article class="unit-index-card">
                <span class="badge">Contenido 5.1</span>
                <h3>Repertorio de instrucciones</h3>
                <ul>
                    <li>Transferencia de datos.</li>
                    <li>Instrucciones aritméticas y lógicas.</li>
                    <li>Control de flujo.</li>
                    <li>Instrucciones de bits.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 5.2</span>
                <h3>Fundamentos del ensamblador</h3>
                <ul>
                    <li>Expresiones, operaciones y operadores.</li>
                    <li>Directivas.</li>
                    <li>Macroinstrucciones.</li>
                    <li>Subrutinas.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Herramientas</span>
                <h3>MPLAB y Proteus</h3>
                <ul>
                    <li>Organización de programas.</li>
                    <li>Programación de microcontroladores.</li>
                    <li>Simulación de circuitos electrónicos.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.1</span>
            <h2>Repertorio de instrucciones</h2>
            <p>
                El repertorio de instrucciones es el conjunto de órdenes que un
                microcontrolador puede ejecutar. Cada instrucción realiza una tarea
                específica, como mover datos, sumar, comparar, saltar o modificar bits.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card lesson-card">
                <div class="lesson-number">Idea central</div>
                <h2>¿Qué es una instrucción?</h2>
                <p>
                    Una instrucción es una orden escrita en lenguaje ensamblador o
                    lenguaje máquina que le indica al microcontrolador qué operación
                    debe realizar.
                </p>
                <p>
                    Por ejemplo, una instrucción puede copiar un dato a un registro,
                    sumar dos valores, revisar una condición o saltar a otra parte
                    del programa.
                </p>
            </article>

            <article class="content-card lesson-card">
                <div class="lesson-number">Ejemplo simple</div>
                <h2>¿Por qué son importantes?</h2>
                <p>
                    Las instrucciones son la base de cualquier programa. Sin ellas,
                    el microcontrolador no sabría qué hacer con los datos que recibe
                    ni cómo controlar los dispositivos conectados.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> programar un microcontrolador consiste
                    en darle instrucciones ordenadas para que controle una tarea.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.1.1</span>
            <h2>Instrucciones de transferencia de datos</h2>
            <p>
                Estas instrucciones sirven para mover información entre registros,
                memoria, puertos de entrada/salida o variables.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>¿Qué hacen?</h3>
                <p>
                    Copian datos de un lugar a otro. No siempre modifican el dato original;
                    muchas veces solo lo trasladan o lo cargan en un registro.
                </p>
            </article>

            <article class="card">
                <h3>Ejemplo conceptual</h3>
                <p>
                    Cargar un valor desde memoria hacia un registro para luego realizar
                    una operación con ese valor.
                </p>
            </article>

            <article class="card">
                <h3>Uso común</h3>
                <p>
                    Preparar datos antes de hacer cálculos, leer entradas o enviar
                    resultados hacia una salida.
                </p>
            </article>
        </div>

        <pre><code>; Ejemplo genérico en ensamblador
MOV AX, 5      ; Carga el valor 5 en AX
MOV BX, AX     ; Copia el valor de AX hacia BX</code></pre>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.1.2</span>
            <h2>Instrucciones aritméticas y lógicas</h2>
            <p>
                Estas instrucciones permiten realizar operaciones matemáticas y
                decisiones lógicas dentro del microcontrolador.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Función</th>
                        <th>Ejemplo de instrucción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Aritmética</td>
                        <td>Permite sumar, restar, incrementar o decrementar valores.</td>
                        <td><code>ADD</code>, <code>SUB</code>, <code>INC</code>, <code>DEC</code></td>
                    </tr>
                    <tr>
                        <td>Lógica</td>
                        <td>Permite trabajar con condiciones y operaciones binarias.</td>
                        <td><code>AND</code>, <code>OR</code>, <code>XOR</code>, <code>NOT</code></td>
                    </tr>
                    <tr>
                        <td>Comparación</td>
                        <td>Permite comparar valores para tomar decisiones.</td>
                        <td><code>CMP</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <pre><code>MOV AX, 8
MOV BX, 2

ADD AX, BX    ; AX = AX + BX
SUB AX, 1     ; AX = AX - 1</code></pre>

        <div class="note">
            <strong>Idea clave:</strong> las instrucciones aritméticas trabajan con números;
            las lógicas trabajan con condiciones y bits.
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.1.3</span>
            <h2>Control de flujo de programa</h2>
            <p>
                El control de flujo permite cambiar el orden normal de ejecución
                de un programa. Gracias a esto se pueden crear decisiones, ciclos
                y saltos.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 5.1.3.1</span>
                <h2>Salto incondicional</h2>
                <p>
                    Un salto incondicional cambia la ejecución del programa sin evaluar
                    ninguna condición. Es decir, el programa salta directamente a otra
                    parte del código.
                </p>

                <pre><code>JMP inicio

inicio:
    ; instrucciones del programa</code></pre>

                <div class="example-box">
                    <strong>Ejemplo:</strong> se puede usar para repetir una sección
                    o moverse a una etiqueta específica del programa.
                </div>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 5.1.3.2</span>
                <h2>Salto condicionado</h2>
                <p>
                    Un salto condicionado solo ocurre si se cumple una condición.
                    Normalmente se usa después de comparar dos valores.
                </p>

                <pre><code>CMP AX, BX
JE iguales
JG mayor
JL menor</code></pre>

                <div class="example-box">
                    <strong>Ejemplo:</strong> si dos valores son iguales, el programa
                    puede saltar a una sección llamada <code>iguales</code>.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.1.4</span>
            <h2>Instrucciones de bits</h2>
            <p>
                Las instrucciones de bits permiten modificar, revisar o desplazar bits
                individuales. Son muy importantes en microcontroladores porque muchos
                periféricos se controlan activando o desactivando bits.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>Activar bits</h3>
                <p>
                    Sirve para poner un bit en 1. Esto puede encender una salida,
                    activar un puerto o habilitar una función.
                </p>
            </article>

            <article class="card">
                <h3>Limpiar bits</h3>
                <p>
                    Sirve para poner un bit en 0. Esto puede apagar una salida
                    o desactivar una función interna.
                </p>
            </article>

            <article class="card">
                <h3>Comprobar bits</h3>
                <p>
                    Sirve para saber si una entrada está activa, si ocurrió un evento
                    o si una bandera del sistema cambió de estado.
                </p>
            </article>
        </div>

        <div class="concept-box">
            <h3>Ejemplo práctico</h3>
            <p>
                En un microcontrolador, un bit puede representar el estado de un LED:
                si el bit vale 1, el LED se enciende; si vale 0, el LED se apaga.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.2</span>
            <h2>Fundamentos del lenguaje ensamblador</h2>
            <p>
                El lenguaje ensamblador permite escribir instrucciones cercanas al
                hardware. Aunque puede parecer más difícil que un lenguaje de alto nivel,
                ayuda a entender cómo trabaja realmente el microcontrolador.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Qué es el lenguaje ensamblador?</h2>
                <p>
                    Es un lenguaje de bajo nivel que usa palabras o símbolos para
                    representar instrucciones que el procesador o microcontrolador
                    puede ejecutar.
                </p>

                <p>
                    En lugar de escribir directamente números binarios, se usan instrucciones
                    más legibles como <code>MOV</code>, <code>ADD</code>, <code>SUB</code>,
                    <code>JMP</code> o <code>CALL</code>.
                </p>
            </article>

            <article class="content-card">
                <h2>¿Por qué se estudia?</h2>
                <p>
                    Porque permite comprender registros, memoria, instrucciones, bits,
                    saltos, subrutinas y la forma en que un programa controla directamente
                    el hardware.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> el ensamblador conecta la programación
                    con el funcionamiento real del microcontrolador.
                </div>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.2.1</span>
            <h2>Expresiones, operaciones y operadores</h2>
            <p>
                En ensamblador se pueden usar expresiones y operadores para calcular
                valores, definir constantes, trabajar con direcciones o combinar datos.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>Expresiones</h3>
                <p>
                    Son combinaciones de valores, símbolos, constantes u operadores.
                    Se usan para definir valores o direcciones.
                </p>
                <pre><code>valor EQU 10 + 5</code></pre>
            </article>

            <article class="card">
                <h3>Operaciones</h3>
                <p>
                    Pueden ser aritméticas, lógicas o de comparación, dependiendo
                    del objetivo del programa.
                </p>
                <pre><code>ADD AX, 2
CMP AX, BX</code></pre>
            </article>

            <article class="card">
                <h3>Operadores</h3>
                <p>
                    Permiten realizar cálculos o acceder a direcciones y tamaños
                    de datos.
                </p>
                <pre><code>OFFSET mensaje
PTR variable</code></pre>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.2.2</span>
            <h2>Directivas</h2>
            <p>
                Las directivas son instrucciones para el ensamblador, no para el
                microcontrolador. Sirven para organizar el programa, reservar memoria
                o indicar cómo debe interpretarse el código.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Directiva</th>
                        <th>Uso</th>
                        <th>Ejemplo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>.data</code></td>
                        <td>Define la sección de datos.</td>
                        <td><code>.data</code></td>
                    </tr>
                    <tr>
                        <td><code>.code</code></td>
                        <td>Define la sección de instrucciones.</td>
                        <td><code>.code</code></td>
                    </tr>
                    <tr>
                        <td><code>DB</code></td>
                        <td>Reserva un byte.</td>
                        <td><code>numero DB 5</code></td>
                    </tr>
                    <tr>
                        <td><code>DW</code></td>
                        <td>Reserva una palabra.</td>
                        <td><code>valor DW 1000</code></td>
                    </tr>
                    <tr>
                        <td><code>EQU</code></td>
                        <td>Define una constante.</td>
                        <td><code>limite EQU 10</code></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="note">
            <strong>Idea clave:</strong> las directivas ayudan a estructurar el programa,
            pero no siempre se convierten en instrucciones ejecutables.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.2.3</span>
            <h2>Macroinstrucciones</h2>
            <p>
                Una macroinstrucción es un bloque de código que puede reutilizarse.
                Cuando se usa una macro, el ensamblador copia sus instrucciones en
                el lugar donde fue llamada.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Para qué sirven?</h2>
                <p>
                    Sirven para evitar repetir código y hacer que el programa sea más
                    organizado. Son útiles cuando una misma secuencia de instrucciones
                    se usa varias veces.
                </p>

                <ul class="styled-list">
                    <li>Reducen repetición de código.</li>
                    <li>Facilitan lectura del programa.</li>
                    <li>Permiten agrupar instrucciones comunes.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Ejemplo de macro</h2>

                <pre><code>mostrar macro texto
    mov ah, 09h
    lea dx, texto
    int 21h
endm</code></pre>

                <div class="example-box">
                    <strong>Diferencia:</strong> una macro se expande en el código,
                    mientras que una subrutina se llama durante la ejecución.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.2.4</span>
            <h2>Subrutinas</h2>
            <p>
                Una subrutina es una parte del programa que realiza una tarea específica
                y puede ser llamada desde diferentes lugares.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Cómo funcionan?</h2>
                <p>
                    El programa principal llama a la subrutina con una instrucción
                    como <code>CALL</code>. Al terminar, la subrutina regresa al punto
                    donde fue llamada usando <code>RET</code>.
                </p>

                <ul class="styled-list">
                    <li>Organizan mejor el programa.</li>
                    <li>Evitan repetir instrucciones.</li>
                    <li>Separan tareas específicas.</li>
                    <li>Facilitan depurar errores.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Ejemplo de subrutina</h2>

                <pre><code>saludar proc
    mov ah, 09h
    lea dx, mensaje
    int 21h
    ret
saludar endp</code></pre>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 5.2.5</span>
            <h2>Organización de un programa en lenguaje ensamblador</h2>
            <p>
                Un programa en ensamblador debe tener una estructura clara para que
                el ensamblador pueda interpretar correctamente datos, instrucciones
                y finalización del programa.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>Estructura general</h2>
                <ul class="styled-list">
                    <li>Declaración del modelo de memoria.</li>
                    <li>Declaración de pila.</li>
                    <li>Sección de datos.</li>
                    <li>Sección de código.</li>
                    <li>Procedimiento principal.</li>
                    <li>Finalización del programa.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Ejemplo completo</h2>

                <pre><code>.model small
.stack 100h

.data
    mensaje db 'Programa organizado$'

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
            </article>
        </div>

        <div class="concept-box">
            <h3>Consejo práctico</h3>
            <p>
                Un programa bien organizado es más fácil de leer, corregir, explicar
                y reutilizar. Por eso conviene separar datos, código y subrutinas.
            </p>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 5.2.6</span>
            <h2>Los sistemas informáticos MPLAB y Proteus</h2>
            <p>
                MPLAB y Proteus son herramientas utilizadas para programar, analizar
                y simular proyectos con microcontroladores.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>MPLAB</h2>
                <p>
                    MPLAB es un entorno de desarrollo utilizado principalmente para
                    programar microcontroladores PIC. Permite escribir código, compilar,
                    depurar y preparar el programa que será cargado al microcontrolador.
                </p>

                <ul class="styled-list">
                    <li>Permite escribir programas.</li>
                    <li>Permite compilar código.</li>
                    <li>Ayuda a depurar errores.</li>
                    <li>Se usa mucho con microcontroladores PIC.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Proteus</h2>
                <p>
                    Proteus es una herramienta de simulación electrónica. Permite crear
                    circuitos virtuales y probar cómo se comporta un microcontrolador
                    antes de construir el circuito físicamente.
                </p>

                <ul class="styled-list">
                    <li>Permite dibujar circuitos.</li>
                    <li>Simula microcontroladores y componentes.</li>
                    <li>Ayuda a probar diseños antes de armarlos.</li>
                    <li>Permite detectar errores de conexión o lógica.</li>
                </ul>
            </article>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Herramienta</th>
                        <th>Función principal</th>
                        <th>Uso en microcontroladores</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MPLAB</td>
                        <td>Desarrollo y compilación de programas.</td>
                        <td>Escribir, compilar y depurar código para microcontroladores.</td>
                    </tr>
                    <tr>
                        <td>Proteus</td>
                        <td>Simulación electrónica.</td>
                        <td>Probar circuitos con microcontroladores de forma virtual.</td>
                    </tr>
                    <tr>
                        <td>Uso combinado</td>
                        <td>Programar y simular.</td>
                        <td>Crear el código en MPLAB y probar el circuito en Proteus.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="note">
            <strong>Idea clave:</strong> MPLAB se usa más para programar; Proteus se usa
            más para simular circuitos.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Comparación</span>
            <h2>Macroinstrucciones vs subrutinas</h2>
            <p>
                Aunque ambas ayudan a reutilizar código, no funcionan exactamente igual.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Aspecto</th>
                        <th>Macroinstrucción</th>
                        <th>Subrutina</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Funcionamiento</td>
                        <td>El código se copia donde se usa la macro.</td>
                        <td>El programa salta a una rutina y luego regresa.</td>
                    </tr>
                    <tr>
                        <td>Instrucciones comunes</td>
                        <td><code>MACRO</code> y <code>ENDM</code>.</td>
                        <td><code>CALL</code> y <code>RET</code>.</td>
                    </tr>
                    <tr>
                        <td>Ventaja</td>
                        <td>Puede ser rápida para bloques pequeños.</td>
                        <td>Reduce repetición real del código en memoria.</td>
                    </tr>
                    <tr>
                        <td>Uso recomendado</td>
                        <td>Acciones simples y repetidas.</td>
                        <td>Tareas más completas y organizadas.</td>
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
                Antes de finalizar el contenido de las unidades, asegurate de recordar
                estas ideas principales.
            </p>
        </div>

        <div class="summary-grid">
            <article class="summary-item">
                <span>01</span>
                <p>El repertorio de instrucciones define qué operaciones puede ejecutar un microcontrolador.</p>
            </article>

            <article class="summary-item">
                <span>02</span>
                <p>Las instrucciones de transferencia mueven datos entre registros, memoria o puertos.</p>
            </article>

            <article class="summary-item">
                <span>03</span>
                <p>Las instrucciones aritméticas y lógicas permiten calcular y comparar valores.</p>
            </article>

            <article class="summary-item">
                <span>04</span>
                <p>Los saltos permiten cambiar el flujo normal del programa.</p>
            </article>

            <article class="summary-item">
                <span>05</span>
                <p>Las macros y subrutinas ayudan a reutilizar y organizar código.</p>
            </article>

            <article class="summary-item">
                <span>06</span>
                <p>MPLAB ayuda a programar microcontroladores y Proteus ayuda a simular circuitos.</p>
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

        <form class="quiz" id="unidad5Quiz">
            <article class="quiz-question">
                <h3>1. ¿Qué es el repertorio de instrucciones?</h3>

                <label>
                    <input type="radio" name="q1" value="a">
                    El conjunto de órdenes que puede ejecutar un microcontrolador.
                </label>

                <label>
                    <input type="radio" name="q1" value="b">
                    Una lista de colores del circuito.
                </label>

                <label>
                    <input type="radio" name="q1" value="c">
                    Un tipo de pantalla.
                </label>
            </article>

            <article class="quiz-question">
                <h3>2. ¿Para qué sirven las instrucciones de transferencia de datos?</h3>

                <label>
                    <input type="radio" name="q2" value="a">
                    Para mover información entre registros, memoria o puertos.
                </label>

                <label>
                    <input type="radio" name="q2" value="b">
                    Para pintar el circuito.
                </label>

                <label>
                    <input type="radio" name="q2" value="c">
                    Para apagar permanentemente el microcontrolador.
                </label>
            </article>

            <article class="quiz-question">
                <h3>3. ¿Qué tipo de instrucciones permiten sumar o restar valores?</h3>

                <label>
                    <input type="radio" name="q3" value="a">
                    Instrucciones aritméticas.
                </label>

                <label>
                    <input type="radio" name="q3" value="b">
                    Instrucciones de dibujo.
                </label>

                <label>
                    <input type="radio" name="q3" value="c">
                    Instrucciones de sonido únicamente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>4. ¿Qué hace un salto incondicional?</h3>

                <label>
                    <input type="radio" name="q4" value="a">
                    Cambia la ejecución del programa sin evaluar una condición.
                </label>

                <label>
                    <input type="radio" name="q4" value="b">
                    Solo funciona si se presiona una tecla.
                </label>

                <label>
                    <input type="radio" name="q4" value="c">
                    Borra el programa completo.
                </label>
            </article>

            <article class="quiz-question">
                <h3>5. ¿Qué hace un salto condicionado?</h3>

                <label>
                    <input type="radio" name="q5" value="a">
                    Salta a otra parte del programa solo si se cumple una condición.
                </label>

                <label>
                    <input type="radio" name="q5" value="b">
                    Siempre salta sin revisar nada.
                </label>

                <label>
                    <input type="radio" name="q5" value="c">
                    Sirve para cambiar la fuente del texto.
                </label>
            </article>

            <article class="quiz-question">
                <h3>6. ¿Por qué son importantes las instrucciones de bits?</h3>

                <label>
                    <input type="radio" name="q6" value="a">
                    Porque permiten activar, limpiar o comprobar bits individuales.
                </label>

                <label>
                    <input type="radio" name="q6" value="b">
                    Porque imprimen documentos.
                </label>

                <label>
                    <input type="radio" name="q6" value="c">
                    Porque cambian el tamaño físico del chip.
                </label>
            </article>

            <article class="quiz-question">
                <h3>7. ¿Qué son las directivas?</h3>

                <label>
                    <input type="radio" name="q7" value="a">
                    Indicaciones para el ensamblador que ayudan a organizar el programa.
                </label>

                <label>
                    <input type="radio" name="q7" value="b">
                    Sensores externos.
                </label>

                <label>
                    <input type="radio" name="q7" value="c">
                    Un tipo de batería.
                </label>
            </article>

            <article class="quiz-question">
                <h3>8. ¿Qué es una macroinstrucción?</h3>

                <label>
                    <input type="radio" name="q8" value="a">
                    Un bloque de código reutilizable que se expande donde se usa.
                </label>

                <label>
                    <input type="radio" name="q8" value="b">
                    Un cable de alimentación.
                </label>

                <label>
                    <input type="radio" name="q8" value="c">
                    Una pantalla táctil.
                </label>
            </article>

            <article class="quiz-question">
                <h3>9. ¿Qué es una subrutina?</h3>

                <label>
                    <input type="radio" name="q9" value="a">
                    Una parte del programa que puede llamarse para realizar una tarea específica.
                </label>

                <label>
                    <input type="radio" name="q9" value="b">
                    Un componente de sonido.
                </label>

                <label>
                    <input type="radio" name="q9" value="c">
                    Un archivo de imagen.
                </label>
            </article>

            <article class="quiz-question">
                <h3>10. ¿Cuál es la diferencia principal entre MPLAB y Proteus?</h3>

                <label>
                    <input type="radio" name="q10" value="a">
                    MPLAB se usa para programar; Proteus se usa para simular circuitos.
                </label>

                <label>
                    <input type="radio" name="q10" value="b">
                    MPLAB es un teclado y Proteus una memoria RAM.
                </label>

                <label>
                    <input type="radio" name="q10" value="c">
                    No tienen relación con microcontroladores.
                </label>
            </article>

            <div class="quiz-actions">
                <button type="button" class="btn btn-primary" id="checkUnidad5Quiz">
                    Calcular puntuación
                </button>

                <button type="reset" class="btn btn-light" id="resetUnidad5Quiz">
                    Reiniciar
                </button>
            </div>

            <div class="quiz-result" id="unidad5QuizResult">
                Responde el cuestionario para ver tu resultado.
            </div>
        </form>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Tutoriales</span>
                <h2>Continúa con los tutoriales prácticos</h2>
                <p>
                    Después de estudiar las unidades, puedes continuar con los tutoriales
                    de instalación y uso de EMU8086, Arduino y Tinkercad.
                </p>
            </div>

            <a href="../tutoriales/emu8086.php"
                class="btn btn-primary locked-next-unit"
                data-required-quiz="unidad5Quiz"
                data-min-score="7">
                Ir a tutoriales
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>