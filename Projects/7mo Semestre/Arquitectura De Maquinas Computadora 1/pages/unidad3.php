<?php
$pageTitle = "Unidad III | Programación del Microprocesador";
$currentPage = "unidad3";
require_once __DIR__ . "/../includes/header.php";
require_once __DIR__ . "/../includes/navbar.php";
?>

<main>
    <section class="page-hero">
        <span class="badge">Unidad III</span>
        <h1>Programación del microprocesador</h1>
        <p>
            En esta unidad aprenderás los fundamentos de la familia ix86 y la programación
            en lenguaje ensamblador, usando conceptos como registros, segmentos,
            instrucciones, interrupciones, macros y procedimientos.
        </p>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos de la unidad</span>
            <h2>¿Qué aprenderás en esta unidad?</h2>
            <p>
                Esta unidad conecta la arquitectura del microprocesador con la programación
                en bajo nivel. El objetivo es comprender cómo se escriben instrucciones
                que el procesador puede ejecutar directamente.
            </p>
        </div>

        <div class="unit-index">
            <article class="unit-index-card">
                <span class="badge">Contenido 3.1</span>
                <h3>Arquitectura de la familia ix86</h3>
                <ul>
                    <li>Diagrama de bloques.</li>
                    <li>Modelos de memoria.</li>
                    <li>Registros principales.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Contenido 3.2</span>
                <h3>Ensamblador de la familia ix86</h3>
                <ul>
                    <li>Segmentos y formato de sentencias.</li>
                    <li>Direccionamiento e instrucciones.</li>
                    <li>Entrada, salida e interrupciones.</li>
                </ul>
            </article>

            <article class="unit-index-card">
                <span class="badge">Práctica</span>
                <h3>EMU8086</h3>
                <ul>
                    <li>Programas básicos en ensamblador.</li>
                    <li>Uso de registros.</li>
                    <li>Uso de procedimientos y macros.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 3.1</span>
            <h2>Arquitectura de la familia ix86</h2>
            <p>
                La familia ix86 incluye procesadores compatibles con la arquitectura
                x86, como el 8086. Estos procesadores trabajan con registros, memoria,
                buses e instrucciones de bajo nivel.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card lesson-card">
                <div class="lesson-number">Idea central</div>
                <h2>¿Qué significa ix86?</h2>
                <p>
                    ix86 es una forma de referirse a la familia de procesadores x86,
                    iniciada con procesadores como el Intel 8086. Esta familia fue muy
                    importante en la historia de las computadoras personales.
                </p>
                <p>
                    En esta unidad se usa como base porque permite aprender cómo trabaja
                    un microprocesador desde un nivel cercano al hardware.
                </p>
            </article>

            <article class="content-card lesson-card">
                <div class="lesson-number">Relación con EMU8086</div>
                <h2>¿Por qué usamos EMU8086?</h2>
                <p>
                    EMU8086 permite simular programas escritos para el procesador 8086.
                    Con esta herramienta se pueden observar registros, memoria, instrucciones
                    y resultados sin tener una máquina real con ese procesador.
                </p>

                <div class="note">
                    <strong>En resumen:</strong> EMU8086 ayuda a practicar ensamblador
                    de forma visual y segura.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 3.1.1</span>
            <h2>Diagrama de bloques de la familia ix86</h2>
            <p>
                Un diagrama de bloques ayuda a representar las partes internas principales
                del procesador y cómo se comunican entre sí.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card icon-card">
                <div class="icon-circle">UC</div>
                <h3>Unidad de control</h3>
                <p>
                    Interpreta las instrucciones del programa y coordina las señales
                    necesarias para ejecutarlas.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">ALU</div>
                <h3>Unidad aritmética lógica</h3>
                <p>
                    Realiza operaciones matemáticas y lógicas, como suma, resta,
                    comparación y operaciones booleanas.
                </p>
            </article>

            <article class="card icon-card">
                <div class="icon-circle">REG</div>
                <h3>Registros</h3>
                <p>
                    Guardan datos temporales dentro del procesador. Son más rápidos
                    que la memoria principal.
                </p>
            </article>
        </div>

        <div class="diagram big-diagram">
            <div>Memoria</div>
            <span>↔</span>
            <div>Unidad de control</div>
            <span>↔</span>
            <div>Registros</div>
            <span>↔</span>
            <div>ALU</div>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 3.1.2</span>
            <h2>Modelos de memoria</h2>
            <p>
                En la arquitectura 8086, la memoria se organiza mediante segmentos.
                Esto permite dividir un programa en áreas como código, datos y pila.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Qué es un segmento?</h2>
                <p>
                    Un segmento es una parte de la memoria usada para un propósito
                    específico. En ensamblador, los segmentos ayudan a organizar
                    el programa.
                </p>

                <ul class="styled-list">
                    <li><strong>Segmento de código:</strong> contiene instrucciones.</li>
                    <li><strong>Segmento de datos:</strong> contiene variables.</li>
                    <li><strong>Segmento de pila:</strong> guarda datos temporales y retornos.</li>
                </ul>
            </article>

            <article class="content-card">
                <h2>Modelo básico en EMU8086</h2>
                <p>
                    Un programa sencillo suele declarar un modelo de memoria pequeño,
                    una pila, una sección de datos y una sección de código.
                </p>

                <pre><code>.model small
.stack 100h

.data
    mensaje db 'Hola$'

.code
main proc
    mov ax, @data
    mov ds, ax
main endp
end main</code></pre>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 3.1.3</span>
            <h2>Registros del 8086</h2>
            <p>
                Los registros son pequeñas memorias internas del procesador. Se usan
                para guardar datos, direcciones, contadores e información necesaria
                durante la ejecución de un programa.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Nombre</th>
                        <th>Uso principal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AX</td>
                        <td>Acumulador</td>
                        <td>Operaciones aritméticas, entrada/salida y resultados.</td>
                    </tr>
                    <tr>
                        <td>BX</td>
                        <td>Base</td>
                        <td>Direccionamiento y almacenamiento temporal.</td>
                    </tr>
                    <tr>
                        <td>CX</td>
                        <td>Contador</td>
                        <td>Bucles, repeticiones y conteos.</td>
                    </tr>
                    <tr>
                        <td>DX</td>
                        <td>Datos</td>
                        <td>Operaciones de entrada/salida y datos auxiliares.</td>
                    </tr>
                    <tr>
                        <td>CS</td>
                        <td>Segmento de código</td>
                        <td>Indica dónde están las instrucciones del programa.</td>
                    </tr>
                    <tr>
                        <td>DS</td>
                        <td>Segmento de datos</td>
                        <td>Indica dónde están los datos del programa.</td>
                    </tr>
                    <tr>
                        <td>SS</td>
                        <td>Segmento de pila</td>
                        <td>Indica dónde se encuentra la pila.</td>
                    </tr>
                    <tr>
                        <td>IP</td>
                        <td>Puntero de instrucción</td>
                        <td>Señala la siguiente instrucción a ejecutar.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 3.2</span>
            <h2>Ensamblador de la familia ix86</h2>
            <p>
                El lenguaje ensamblador permite escribir instrucciones cercanas al
                lenguaje máquina. Cada instrucción representa una operación que el
                procesador puede ejecutar.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <h2>¿Qué es el ensamblador?</h2>
                <p>
                    Es un lenguaje de bajo nivel que usa instrucciones como
                    <code>MOV</code>, <code>ADD</code>, <code>SUB</code> o
                    <code>JMP</code>. Estas instrucciones se traducen a lenguaje máquina
                    para que el procesador pueda ejecutarlas.
                </p>
            </article>

            <article class="content-card">
                <h2>¿Por qué es importante?</h2>
                <p>
                    Permite comprender cómo se manejan los registros, la memoria,
                    las interrupciones y el flujo de ejecución de un programa.
                </p>

                <div class="example-box">
                    <strong>Ejemplo:</strong> con ensamblador puedes mover datos a un
                    registro, sumar valores o mostrar texto mediante interrupciones.
                </div>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 3.2.1</span>
            <h2>Declaración de segmentos</h2>
            <p>
                Los segmentos organizan el programa en partes. Esto hace más claro
                dónde están las instrucciones, los datos y la pila.
            </p>
        </div>

        <pre><code>.model small
.stack 100h

.data
    numero db 5

.code
main proc
    mov ax, @data
    mov ds, ax

    mov ah, 4Ch
    int 21h
main endp
end main</code></pre>

        <div class="note">
            <strong>Idea clave:</strong> antes de usar variables del segmento de datos,
            normalmente se carga <code>@data</code> en <code>AX</code> y luego en
            <code>DS</code>.
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenido 3.2.2</span>
            <h2>Modos de direccionamiento</h2>
            <p>
                Los modos de direccionamiento indican cómo una instrucción localiza
                los datos que va a utilizar.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Modo</th>
                        <th>Descripción</th>
                        <th>Ejemplo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Inmediato</td>
                        <td>El valor está directamente en la instrucción.</td>
                        <td><code>MOV AX, 5</code></td>
                    </tr>
                    <tr>
                        <td>Registro</td>
                        <td>El dato está en un registro.</td>
                        <td><code>MOV AX, BX</code></td>
                    </tr>
                    <tr>
                        <td>Directo</td>
                        <td>El dato está en una variable de memoria.</td>
                        <td><code>MOV AL, numero</code></td>
                    </tr>
                    <tr>
                        <td>Indirecto</td>
                        <td>La dirección del dato está en un registro.</td>
                        <td><code>MOV AL, [BX]</code></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 3.2.3</span>
            <h2>Estructuras de control de flujo</h2>
            <p>
                Permiten cambiar el orden en que se ejecutan las instrucciones.
                Se usan para tomar decisiones, repetir instrucciones o saltar a
                otra parte del programa.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <h3>Saltos</h3>
                <p>
                    Permiten pasar a otra etiqueta del programa. Ejemplo:
                    <code>JMP inicio</code>.
                </p>
            </article>

            <article class="card">
                <h3>Comparaciones</h3>
                <p>
                    La instrucción <code>CMP</code> compara dos valores para luego
                    decidir qué salto ejecutar.
                </p>
            </article>

            <article class="card">
                <h3>Bucles</h3>
                <p>
                    Permiten repetir instrucciones varias veces. Normalmente se usa
                    el registro <code>CX</code> como contador.
                </p>
            </article>
        </div>

        <pre><code>mov ax, 8
mov bx, 5

cmp ax, bx
jg mayor

mayor:
    ; AX es mayor que BX</code></pre>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenidos 3.2.4 al 3.2.8</span>
            <h2>Elementos básicos de una sentencia</h2>
            <p>
                Una sentencia en ensamblador puede contener etiquetas, instrucciones,
                operandos, constantes, operadores y tipos de datos.
            </p>
        </div>

        <div class="cards-grid">
            <article class="card">
                <span class="badge">Contenido 3.2.4</span>
                <h3>Formato de sentencia</h3>
                <p>
                    Una sentencia puede tener etiqueta, instrucción, operandos y comentario.
                </p>
                <pre><code>inicio:
    mov ax, 5 ; carga 5 en AX</code></pre>
            </article>

            <article class="card">
                <span class="badge">Contenido 3.2.5</span>
                <h3>Palabras reservadas</h3>
                <p>
                    Son palabras propias del lenguaje ensamblador y no deben usarse
                    como nombres de variables.
                </p>
                <p>
                    Ejemplos: <code>MOV</code>, <code>ADD</code>, <code>PROC</code>,
                    <code>END</code>, <code>SEGMENT</code>.
                </p>
            </article>

            <article class="card">
                <span class="badge">Contenido 3.2.6</span>
                <h3>Constantes</h3>
                <p>
                    Son valores fijos que no cambian durante la ejecución del programa.
                </p>
                <pre><code>valor equ 10</code></pre>
            </article>

            <article class="card">
                <span class="badge">Contenido 3.2.7</span>
                <h3>Operadores</h3>
                <p>
                    Permiten realizar operaciones o calcular direcciones.
                </p>
                <p>
                    Ejemplos: <code>+</code>, <code>-</code>, <code>OFFSET</code>,
                    <code>PTR</code>.
                </p>
            </article>

            <article class="card">
                <span class="badge">Contenido 3.2.8</span>
                <h3>Tipos de datos</h3>
                <p>
                    Definen el tamaño de los datos almacenados en memoria.
                </p>
                <p>
                    Ejemplos: <code>DB</code> para byte, <code>DW</code> para word,
                    <code>DD</code> para doble palabra.
                </p>
            </article>

            <article class="card">
                <span class="badge">Ejemplo</span>
                <h3>Declaración de datos</h3>
                <pre><code>.data
    letra db 'A'
    numero db 25
    valor dw 1000</code></pre>
            </article>
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenido 3.2.9</span>
            <h2>Conjunto de instrucciones</h2>
            <p>
                El conjunto de instrucciones son las órdenes que el procesador puede
                ejecutar. Cada instrucción realiza una acción concreta.
            </p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Instrucción</th>
                        <th>Función</th>
                        <th>Ejemplo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>MOV</td>
                        <td>Copia datos de un lugar a otro.</td>
                        <td><code>MOV AX, BX</code></td>
                    </tr>
                    <tr>
                        <td>ADD</td>
                        <td>Suma valores.</td>
                        <td><code>ADD AX, 5</code></td>
                    </tr>
                    <tr>
                        <td>SUB</td>
                        <td>Resta valores.</td>
                        <td><code>SUB AX, 2</code></td>
                    </tr>
                    <tr>
                        <td>CMP</td>
                        <td>Compara valores.</td>
                        <td><code>CMP AX, BX</code></td>
                    </tr>
                    <tr>
                        <td>JMP</td>
                        <td>Realiza un salto incondicional.</td>
                        <td><code>JMP inicio</code></td>
                    </tr>
                    <tr>
                        <td>LOOP</td>
                        <td>Repite instrucciones usando CX como contador.</td>
                        <td><code>LOOP repetir</code></td>
                    </tr>
                    <tr>
                        <td>INT</td>
                        <td>Ejecuta una interrupción.</td>
                        <td><code>INT 21h</code></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Contenidos 3.2.10 y 3.2.11</span>
            <h2>Entrada, salida e interrupciones</h2>
            <p>
                En ensamblador, muchas operaciones de entrada y salida se realizan
                usando interrupciones. Una de las más utilizadas en EMU8086 es
                <code>INT 21h</code>.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 3.2.10</span>
                <h2>Control de dispositivos de entrada / salida</h2>
                <p>
                    La entrada y salida permite que el programa interactúe con el usuario
                    o con dispositivos. Por ejemplo, mostrar texto en pantalla o leer
                    una tecla.
                </p>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 3.2.11</span>
                <h2>Interrupciones</h2>
                <p>
                    Una interrupción es una llamada especial que permite solicitar
                    un servicio del sistema. En EMU8086, <code>INT 21h</code> se usa
                    para funciones básicas como mostrar texto o terminar un programa.
                </p>
            </article>
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
            <strong>Explicación:</strong> <code>AH = 09h</code> indica mostrar una cadena
            de texto, <code>DX</code> apunta al mensaje y <code>INT 21h</code> ejecuta
            el servicio.
        </div>
    </section>

    <section class="section">
        <div class="section-header">
            <span class="badge">Contenidos 3.2.12 y 3.2.13</span>
            <h2>Macros y procedimientos</h2>
            <p>
                Las macros y los procedimientos permiten organizar mejor el código
                y evitar repetir instrucciones muchas veces.
            </p>
        </div>

        <div class="content-layout">
            <article class="content-card">
                <span class="badge">Contenido 3.2.12</span>
                <h2>Macros</h2>
                <p>
                    Una macro es un bloque de instrucciones que se expande en el código
                    cuando se usa. Sirve para reutilizar instrucciones simples.
                </p>

                <pre><code>mostrar macro mensaje
    mov ah, 09h
    lea dx, mensaje
    int 21h
endm</code></pre>
            </article>

            <article class="content-card">
                <span class="badge">Contenido 3.2.13</span>
                <h2>Procedimientos</h2>
                <p>
                    Un procedimiento es un bloque de código que puede llamarse desde
                    distintas partes del programa usando <code>CALL</code> y puede
                    regresar con <code>RET</code>.
                </p>

                <pre><code>saludar proc
    mov ah, 09h
    lea dx, mensaje
    int 21h
    ret
saludar endp</code></pre>
            </article>
        </div>

        <div class="concept-box">
            <h3>Diferencia simple</h3>
            <p>
                Una macro se copia en el lugar donde se utiliza. Un procedimiento se guarda
                como una rutina y el programa salta a él cuando lo llama.
            </p>
        </div>
    </section>

    <section class="section section-alt">
        <div class="section-header">
            <span class="badge">Resumen</span>
            <h2>Lo más importante de la unidad</h2>
            <p>
                Antes de avanzar a microcontroladores, asegurate de dominar estas ideas.
            </p>
        </div>

        <div class="summary-grid">
            <article class="summary-item">
                <span>01</span>
                <p>La familia ix86 permite estudiar la programación de bajo nivel.</p>
            </article>

            <article class="summary-item">
                <span>02</span>
                <p>Los registros guardan datos temporales dentro del procesador.</p>
            </article>

            <article class="summary-item">
                <span>03</span>
                <p>Los segmentos organizan código, datos y pila en memoria.</p>
            </article>

            <article class="summary-item">
                <span>04</span>
                <p>Los modos de direccionamiento indican cómo se accede a los datos.</p>
            </article>

            <article class="summary-item">
                <span>05</span>
                <p>Las interrupciones permiten solicitar servicios del sistema.</p>
            </article>

            <article class="summary-item">
                <span>06</span>
                <p>Las macros y procedimientos ayudan a reutilizar código.</p>
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

        <form class="quiz" id="unidad3Quiz">
            <article class="quiz-question">
                <h3>1. ¿Qué permite estudiar la familia ix86?</h3>

                <label>
                    <input type="radio" name="q1" value="a">
                    La programación de bajo nivel y el funcionamiento del procesador.
                </label>

                <label>
                    <input type="radio" name="q1" value="b">
                    Solamente diseño gráfico.
                </label>

                <label>
                    <input type="radio" name="q1" value="c">
                    Únicamente edición de imágenes.
                </label>
            </article>

            <article class="quiz-question">
                <h3>2. ¿Qué son los registros?</h3>

                <label>
                    <input type="radio" name="q2" value="a">
                    Pequeñas memorias internas del procesador.
                </label>

                <label>
                    <input type="radio" name="q2" value="b">
                    Archivos guardados en el escritorio.
                </label>

                <label>
                    <input type="radio" name="q2" value="c">
                    Cables externos del monitor.
                </label>
            </article>

            <article class="quiz-question">
                <h3>3. ¿Qué registro suele usarse como contador?</h3>

                <label>
                    <input type="radio" name="q3" value="a">
                    CX.
                </label>

                <label>
                    <input type="radio" name="q3" value="b">
                    Monitor.
                </label>

                <label>
                    <input type="radio" name="q3" value="c">
                    USB.
                </label>
            </article>

            <article class="quiz-question">
                <h3>4. ¿Para qué sirve el segmento de datos?</h3>

                <label>
                    <input type="radio" name="q4" value="a">
                    Para guardar variables y datos del programa.
                </label>

                <label>
                    <input type="radio" name="q4" value="b">
                    Para enfriar el procesador.
                </label>

                <label>
                    <input type="radio" name="q4" value="c">
                    Para cambiar el color de la pantalla.
                </label>
            </article>

            <article class="quiz-question">
                <h3>5. ¿Qué indica un modo de direccionamiento?</h3>

                <label>
                    <input type="radio" name="q5" value="a">
                    Cómo una instrucción localiza sus datos.
                </label>

                <label>
                    <input type="radio" name="q5" value="b">
                    El tamaño físico del teclado.
                </label>

                <label>
                    <input type="radio" name="q5" value="c">
                    La marca del monitor.
                </label>
            </article>

            <article class="quiz-question">
                <h3>6. ¿Qué hace la instrucción MOV?</h3>

                <label>
                    <input type="radio" name="q6" value="a">
                    Copia datos de un lugar a otro.
                </label>

                <label>
                    <input type="radio" name="q6" value="b">
                    Borra el sistema operativo.
                </label>

                <label>
                    <input type="radio" name="q6" value="c">
                    Apaga el monitor.
                </label>
            </article>

            <article class="quiz-question">
                <h3>7. ¿Qué instrucción se usa para comparar valores?</h3>

                <label>
                    <input type="radio" name="q7" value="a">
                    CMP.
                </label>

                <label>
                    <input type="radio" name="q7" value="b">
                    PRINTSCREEN.
                </label>

                <label>
                    <input type="radio" name="q7" value="c">
                    COLOR.
                </label>
            </article>

            <article class="quiz-question">
                <h3>8. ¿Qué permite una interrupción como INT 21h?</h3>

                <label>
                    <input type="radio" name="q8" value="a">
                    Solicitar servicios del sistema, como mostrar texto.
                </label>

                <label>
                    <input type="radio" name="q8" value="b">
                    Instalar memoria RAM física.
                </label>

                <label>
                    <input type="radio" name="q8" value="c">
                    Cambiar el procesador automáticamente.
                </label>
            </article>

            <article class="quiz-question">
                <h3>9. ¿Qué es una macro?</h3>

                <label>
                    <input type="radio" name="q9" value="a">
                    Un bloque de instrucciones reutilizable que se expande al usarse.
                </label>

                <label>
                    <input type="radio" name="q9" value="b">
                    Una parte del monitor.
                </label>

                <label>
                    <input type="radio" name="q9" value="c">
                    Un tipo de cable de red.
                </label>
            </article>

            <article class="quiz-question">
                <h3>10. ¿Qué es un procedimiento?</h3>

                <label>
                    <input type="radio" name="q10" value="a">
                    Una rutina de código que puede llamarse con CALL y regresar con RET.
                </label>

                <label>
                    <input type="radio" name="q10" value="b">
                    Una imagen del programa.
                </label>

                <label>
                    <input type="radio" name="q10" value="c">
                    Una tecla del teclado.
                </label>
            </article>

            <div class="quiz-actions">
                <button type="button" class="btn btn-primary" id="checkUnidad3Quiz">
                    Calcular puntuación
                </button>

                <button type="reset" class="btn btn-light" id="resetUnidad3Quiz">
                    Reiniciar
                </button>
            </div>

            <div class="quiz-result" id="unidad3QuizResult">
                Responde el cuestionario para ver tu resultado.
            </div>
        </form>
    </section>

    <section class="section">
        <div class="next-unit-card">
            <div>
                <span class="badge">Siguiente</span>
                <h2>Continúa con la Unidad IV</h2>
                <p>
                    Después de estudiar programación del microprocesador, puedes continuar
                    con la arquitectura de los microcontroladores.
                </p>
            </div>

            <a href="unidad4.php"
                class="btn btn-primary locked-next-unit"
                data-required-quiz="unidad3Quiz"
                data-min-score="7">
                Ir a Unidad IV
            </a>
        </div>
    </section>
</main>

<?php require_once __DIR__ . "/../includes/footer.php"; ?>