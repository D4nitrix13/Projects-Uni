const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

if (menuToggle && navLinks) {
    menuToggle.addEventListener("click", function () {
        navLinks.classList.toggle("show");
    });
}

function setupQuiz(config) {
    const quiz = document.getElementById(config.quizId);
    const checkButton = document.getElementById(config.checkButtonId);
    const resetButton = document.getElementById(config.resetButtonId);
    const resultBox = document.getElementById(config.resultBoxId);

    if (!quiz || !checkButton || !resultBox) {
        return;
    }

    checkButton.addEventListener("click", function () {
        let score = 0;
        let total = Object.keys(config.correctAnswers).length;
        let answered = 0;

        Object.keys(config.correctAnswers).forEach(function (questionName) {
            const selected = quiz.querySelector(`input[name="${questionName}"]:checked`);
            const questionCard = quiz
                .querySelector(`input[name="${questionName}"]`)
                ?.closest(".quiz-question");

            if (questionCard) {
                questionCard.classList.remove("correct", "incorrect");
            }

            if (selected) {
                answered++;

                if (selected.value === config.correctAnswers[questionName]) {
                    score++;

                    if (questionCard) {
                        questionCard.classList.add("correct");
                    }
                } else {
                    if (questionCard) {
                        questionCard.classList.add("incorrect");
                    }
                }
            } else {
                if (questionCard) {
                    questionCard.classList.add("incorrect");
                }
            }
        });

        let message = "";

        if (score >= 9) {
            message = "Excelente. Dominaste muy bien esta unidad.";
        } else if (score >= 7) {
            message = "Muy bien. Comprendiste la mayoría de conceptos.";
        } else if (score >= 5) {
            message = "Vas bien, pero deberías repasar algunos temas.";
        } else {
            message = "Necesitas repasar la unidad antes de continuar.";
        }

        resultBox.innerHTML = `
            <strong>Puntuación:</strong> ${score}/${total} puntos.<br>
            <strong>Preguntas respondidas:</strong> ${answered}/${total}.<br>
            ${message}
        `;

        resultBox.classList.add("show");

        const minimumScore = 7;
        const quizStorageKey = `quiz_score_${config.quizId}`;

        localStorage.setItem(quizStorageKey, score.toString());

        updateLockedNextUnits();

        if (score >= minimumScore) {
            resultBox.innerHTML += `
                <br><strong>Estado:</strong> Aprobado. Ya puedes avanzar a la siguiente sección.
            `;
        } else {
            resultBox.innerHTML += `
                <br><strong>Estado:</strong> Necesitas al menos ${minimumScore}/${total} para avanzar. Repasa la unidad e inténtalo de nuevo.
            `;
        }
    });

    if (resetButton) {
        resetButton.addEventListener("click", function () {
            const questionCards = quiz.querySelectorAll(".quiz-question");

            questionCards.forEach(function (card) {
                card.classList.remove("correct", "incorrect");
            });

            resultBox.innerHTML = "Responde el cuestionario para ver tu resultado.";
            resultBox.classList.remove("show");
        });
    }
}

setupQuiz({
    quizId: "unidad1Quiz",
    checkButtonId: "checkUnidad1Quiz",
    resetButtonId: "resetUnidad1Quiz",
    resultBoxId: "unidad1QuizResult",
    correctAnswers: {
        q1: "b",
        q2: "a",
        q3: "b",
        q4: "a",
        q5: "a",
        q6: "a",
        q7: "a",
        q8: "a",
        q9: "a",
        q10: "b"
    }
});

setupQuiz({
    quizId: "unidad2Quiz",
    checkButtonId: "checkUnidad2Quiz",
    resetButtonId: "resetUnidad2Quiz",
    resultBoxId: "unidad2QuizResult",
    correctAnswers: {
        q1: "a",
        q2: "b",
        q3: "a",
        q4: "a",
        q5: "a",
        q6: "a",
        q7: "a",
        q8: "a",
        q9: "a",
        q10: "a"
    }
});

setupQuiz({
    quizId: "unidad3Quiz",
    checkButtonId: "checkUnidad3Quiz",
    resetButtonId: "resetUnidad3Quiz",
    resultBoxId: "unidad3QuizResult",
    correctAnswers: {
        q1: "a",
        q2: "a",
        q3: "a",
        q4: "a",
        q5: "a",
        q6: "a",
        q7: "a",
        q8: "a",
        q9: "a",
        q10: "a"
    }
});

setupQuiz({
    quizId: "unidad4Quiz",
    checkButtonId: "checkUnidad4Quiz",
    resetButtonId: "resetUnidad4Quiz",
    resultBoxId: "unidad4QuizResult",
    correctAnswers: {
        q1: "a",
        q2: "a",
        q3: "a",
        q4: "a",
        q5: "a",
        q6: "a",
        q7: "a",
        q8: "a",
        q9: "a",
        q10: "a"
    }
});

setupQuiz({
    quizId: "unidad5Quiz",
    checkButtonId: "checkUnidad5Quiz",
    resetButtonId: "resetUnidad5Quiz",
    resultBoxId: "unidad5QuizResult",
    correctAnswers: {
        q1: "a",
        q2: "a",
        q3: "a",
        q4: "a",
        q5: "a",
        q6: "a",
        q7: "a",
        q8: "a",
        q9: "a",
        q10: "a"
    }
});

const emuPractices = {
    practice1: {
        textareaId: "practice1Code",
        feedbackId: "practice1Feedback",
        solutionId: "practice1Solution",
        solution: `.model small
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
end main`,
        checks: [
            {
                label: "Declaración del modelo de memoria",
                test: code => code.includes(".model small"),
                hint: "Agrega .model small al inicio del programa."
            },
            {
                label: "Declaración de pila",
                test: code => code.includes(".stack 100h"),
                hint: "Agrega .stack 100h."
            },
            {
                label: "Segmento de datos",
                test: code => code.includes(".data"),
                hint: "Agrega la sección .data para declarar variables."
            },
            {
                label: "Variable mensaje",
                test: code => /mensaje\s+db/.test(code),
                hint: "Declara una variable llamada mensaje usando DB."
            },
            {
                label: "Cadena terminada con $",
                test: code => code.includes("$"),
                hint: "Las cadenas para AH=09h deben terminar con el símbolo $."
            },
            {
                label: "Carga del segmento de datos",
                test: code => code.includes("mov ax, @data") && code.includes("mov ds, ax"),
                hint: "Carga @data en AX y luego AX en DS."
            },
            {
                label: "Función para mostrar cadena",
                test: code => code.includes("mov ah, 09h"),
                hint: "Usa mov ah, 09h para mostrar una cadena."
            },
            {
                label: "Dirección del mensaje",
                test: code => code.includes("lea dx, mensaje"),
                hint: "Usa lea dx, mensaje para apuntar al texto."
            },
            {
                label: "Interrupción de DOS",
                test: code => code.includes("int 21h"),
                hint: "Usa int 21h para ejecutar el servicio."
            },
            {
                label: "Finalización del programa",
                test: code => code.includes("mov ah, 4ch"),
                hint: "Usa mov ah, 4Ch para finalizar el programa."
            }
        ]
    },

    practice2: {
        textareaId: "practice2Code",
        feedbackId: "practice2Feedback",
        solutionId: "practice2Solution",
        solution: `.model small
.stack 100h

.code
main proc
    mov al, 5
    mov bl, 3
    add al, bl

    mov ah, 4Ch
    int 21h
main endp
end main`,
        checks: [
            {
                label: "Modelo de memoria",
                test: code => code.includes(".model small"),
                hint: "Agrega .model small."
            },
            {
                label: "Declaración de pila",
                test: code => code.includes(".stack 100h"),
                hint: "Agrega .stack 100h."
            },
            {
                label: "Carga del primer número",
                test: code => code.includes("mov al, 5"),
                hint: "Carga el valor 5 en AL con mov al, 5."
            },
            {
                label: "Carga del segundo número",
                test: code => code.includes("mov bl, 3"),
                hint: "Carga el valor 3 en BL con mov bl, 3."
            },
            {
                label: "Suma de registros",
                test: code => code.includes("add al, bl"),
                hint: "Suma BL en AL usando add al, bl."
            },
            {
                label: "Finalización",
                test: code => code.includes("mov ah, 4ch") && code.includes("int 21h"),
                hint: "Finaliza con mov ah, 4Ch e int 21h."
            }
        ]
    },

    practice3: {
        textareaId: "practice3Code",
        feedbackId: "practice3Feedback",
        solutionId: "practice3Solution",
        solution: `.model small
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
end main`,
        checks: [
            {
                label: "Segmento de datos",
                test: code => code.includes(".data"),
                hint: "Agrega .data para declarar los mensajes."
            },
            {
                label: "Mensaje mayor",
                test: code => /mayor\s+db/.test(code) && code.includes("$"),
                hint: "Declara mayor db 'AX es mayor$'."
            },
            {
                label: "Carga de DS",
                test: code => code.includes("mov ax, @data") && code.includes("mov ds, ax"),
                hint: "Carga correctamente el segmento de datos."
            },
            {
                label: "Valores a comparar",
                test: code => code.includes("mov ax, 8") && code.includes("mov bx, 5"),
                hint: "Carga AX con 8 y BX con 5."
            },
            {
                label: "Comparación",
                test: code => code.includes("cmp ax, bx"),
                hint: "Compara AX y BX usando cmp ax, bx."
            },
            {
                label: "Salto condicionado",
                test: code => code.includes("jg etiqueta_mayor"),
                hint: "Usa jg etiqueta_mayor para saltar si AX es mayor."
            },
            {
                label: "Etiqueta mayor",
                test: code => code.includes("etiqueta_mayor:"),
                hint: "Crea la etiqueta etiqueta_mayor:."
            },
            {
                label: "Mostrar mensaje",
                test: code => code.includes("mov ah, 09h") && code.includes("int 21h"),
                hint: "Muestra el mensaje con AH=09h e INT 21h."
            },
            {
                label: "Finalización",
                test: code => code.includes("mov ah, 4ch") && code.includes("int 21h"),
                hint: "Finaliza con mov ah, 4Ch e int 21h."
            }
        ]
    },

    practice4: {
        textareaId: "practice4Code",
        feedbackId: "practice4Feedback",
        solutionId: "practice4Solution",
        solution: `.model small
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
end main`,
        checks: [
            {
                label: "Modelo de memoria",
                test: code => code.includes(".model small"),
                hint: "Agrega .model small."
            },
            {
                label: "Registro contador",
                test: code => code.includes("mov cx, 5"),
                hint: "Usa mov cx, 5 para definir cinco repeticiones."
            },
            {
                label: "Etiqueta repetir",
                test: code => code.includes("repetir:"),
                hint: "Crea una etiqueta llamada repetir:."
            },
            {
                label: "Instrucción dentro del ciclo",
                test: code => code.includes("nop") || code.includes("inc") || code.includes("dec") || code.includes("add") || code.includes("sub"),
                hint: "Agrega al menos una instrucción dentro del ciclo, por ejemplo nop."
            },
            {
                label: "Uso de LOOP",
                test: code => code.includes("loop repetir"),
                hint: "Usa loop repetir para volver a la etiqueta."
            },
            {
                label: "Finalización",
                test: code => code.includes("mov ah, 4ch") && code.includes("int 21h"),
                hint: "Finaliza con mov ah, 4Ch e int 21h."
            }
        ]
    }
};

function normalizeAssemblyCode(code) {
    return code
        .replace(/\r/g, "")
        .replace(/[ \t]+/g, " ")
        .replace(/\s+,/g, ",")
        .replace(/,\s+/g, ", ")
        .trim()
        .toLowerCase();
}

function checkPractice(practiceKey) {
    const practice = emuPractices[practiceKey];

    if (!practice) {
        return;
    }

    const textarea = document.getElementById(practice.textareaId);
    const feedback = document.getElementById(practice.feedbackId);

    if (!textarea || !feedback) {
        return;
    }

    const originalCode = textarea.value.trim();
    const normalizedCode = normalizeAssemblyCode(originalCode);

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

    practice.checks.forEach(function (check) {
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
            <p>Ahora cópialo en EMU8086 para compilarlo y ejecutarlo.</p>
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

function showPracticeSolution(practiceKey) {
    const practice = emuPractices[practiceKey];

    if (!practice) {
        return;
    }

    const solutionBox = document.getElementById(practice.solutionId);

    if (!solutionBox) {
        return;
    }

    solutionBox.classList.toggle("show");
}

function fixPracticeSyntax(practiceKey) {
    const practice = emuPractices[practiceKey];

    if (!practice) {
        return;
    }

    const textarea = document.getElementById(practice.textareaId);
    const feedback = document.getElementById(practice.feedbackId);

    if (!textarea || !feedback) {
        return;
    }

    textarea.value = practice.solution;
    textarea.dispatchEvent(new Event("input"));

    feedback.className = "practice-feedback success";
    feedback.innerHTML = `
        <strong>Se insertó una versión corregida.</strong><br>
        Puedes copiar este código en EMU8086 y ejecutarlo.
    `;
}

document.querySelectorAll("[data-check]").forEach(function (button) {
    button.addEventListener("click", function () {
        checkPractice(button.dataset.check);
    });
});

document.querySelectorAll("[data-solution]").forEach(function (button) {
    button.addEventListener("click", function () {
        showPracticeSolution(button.dataset.solution);
    });
});

document.querySelectorAll("[data-fix]").forEach(function (button) {
    button.addEventListener("click", function () {
        fixPracticeSyntax(button.dataset.fix);
    });
});

const dropdownDetails = document.querySelectorAll(".dropdown-details");

dropdownDetails.forEach(function (details) {
    details.addEventListener("toggle", function () {
        if (details.open) {
            dropdownDetails.forEach(function (otherDetails) {
                if (otherDetails !== details) {
                    otherDetails.removeAttribute("open");
                }
            });
        }
    });
});

document.addEventListener("click", function (event) {
    const clickedInsideDropdown = event.target.closest(".nav-dropdown");

    if (!clickedInsideDropdown) {
        dropdownDetails.forEach(function (details) {
            details.removeAttribute("open");
        });
    }
});

function updateLockedNextUnits() {
    const lockedLinks = document.querySelectorAll(".locked-next-unit");

    lockedLinks.forEach(function (link) {
        const requiredQuiz = link.dataset.requiredQuiz;
        const minScore = Number(link.dataset.minScore || 7);

        if (!requiredQuiz) {
            return;
        }

        const savedScore = Number(localStorage.getItem(`quiz_score_${requiredQuiz}`) || 0);
        let message = link.parentElement.querySelector(".lock-message");

        if (!message) {
            message = document.createElement("div");
            message.className = "lock-message";
            link.parentElement.appendChild(message);
        }

        if (savedScore >= minScore) {
            link.classList.add("unlocked");
            message.classList.add("success");
            message.innerHTML = `Unidad aprobada con ${savedScore}/10. Puedes continuar.`;
        } else {
            link.classList.remove("unlocked");
            message.classList.remove("success");
            message.innerHTML = `Debes obtener al menos ${minScore}/10 en el cuestionario para desbloquear esta opción.`;
        }
    });
}

/* =========================================================
   Syntax Highlighting: EMU8086 / Arduino
   Corregido: evita que se muestren tokens o <span> como texto
   ========================================================= */

const highlightedEditors = [];

function escapeHtmlSyntax(value) {
    return value
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;");
}

function detectCodeLanguage(code) {
    const lowerCode = code.toLowerCase();

    const arduinoSignals = [
        "void setup",
        "void loop",
        "pinmode",
        "digitalwrite",
        "digitalread",
        "analogread",
        "analogwrite",
        "serial.begin",
        "serial.println"
    ];

    const asmSignals = [
        ".model",
        ".stack",
        ".data",
        ".code",
        "main proc",
        "int 21h",
        "mov ax",
        "mov ah",
        "lea dx"
    ];

    const arduinoScore = arduinoSignals.filter(signal => lowerCode.includes(signal)).length;
    const asmScore = asmSignals.filter(signal => lowerCode.includes(signal)).length;

    if (arduinoScore > asmScore) {
        return "arduino";
    }

    if (asmScore > 0) {
        return "emu8086";
    }

    return "codigo";
}

function indexToLetters(index) {
    let letters = "";
    let current = index;

    do {
        letters = String.fromCharCode(65 + (current % 26)) + letters;
        current = Math.floor(current / 26) - 1;
    } while (current >= 0);

    return letters;
}

function createSyntaxTokenizer() {
    const tokens = [];

    function addToken(html) {
        const token = `§§SYNTAX_PLACEHOLDER_${indexToLetters(tokens.length)}§§`;
        tokens.push({
            token,
            html
        });

        return token;
    }

    function restore(code) {
        let restoredCode = code;

        tokens.forEach(function (item) {
            restoredCode = restoredCode.split(item.token).join(item.html);
        });

        return restoredCode;
    }

    return {
        addToken,
        restore
    };
}

function highlightWithTokenRegex(code, regex, className, tokenizer) {
    return code.replace(regex, function (match) {
        return tokenizer.addToken(`<span class="${className}">${match}</span>`);
    });
}

function highlightAsmCode(rawCode) {
    let code = escapeHtmlSyntax(rawCode);
    const tokenizer = createSyntaxTokenizer();

    code = highlightWithTokenRegex(code, /;.*$/gm, "syntax-comment", tokenizer);
    code = highlightWithTokenRegex(code, /'[^']*'/g, "syntax-string", tokenizer);
    code = highlightWithTokenRegex(code, /"[^"]*"/g, "syntax-string", tokenizer);

    code = highlightWithTokenRegex(
        code,
        /^([a-zA-Z_][\w]*:)/gm,
        "syntax-label",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(\.model|\.stack|\.data|\.code|db|dw|dd|equ|proc|endp|end|segment|ends|macro|endm)\b/gi,
        "syntax-directive",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(mov|lea|add|sub|inc|dec|mul|div|cmp|jmp|je|jne|jg|jl|jge|jle|loop|int|call|ret|push|pop|nop|and|or|xor|not|shl|shr)\b/gi,
        "syntax-keyword",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(ax|ah|al|bx|bh|bl|cx|ch|cl|dx|dh|dl|sp|bp|si|di|cs|ds|ss|es|ip)\b/gi,
        "syntax-register",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(@data|offset|ptr|byte|word|small|large|medium|tiny|high|low)\b/gi,
        "syntax-constant",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(\d+[a-f]?\w*h|\d+)\b/gi,
        "syntax-number",
        tokenizer
    );

    return tokenizer.restore(code);
}

function highlightArduinoCode(rawCode) {
    let code = escapeHtmlSyntax(rawCode);
    const tokenizer = createSyntaxTokenizer();

    code = highlightWithTokenRegex(code, /\/\/.*$/gm, "syntax-comment", tokenizer);
    code = highlightWithTokenRegex(code, /\/\*[\s\S]*?\*\//g, "syntax-comment", tokenizer);
    code = highlightWithTokenRegex(code, /'[^']*'/g, "syntax-string", tokenizer);
    code = highlightWithTokenRegex(code, /"[^"]*"/g, "syntax-string", tokenizer);

    code = highlightWithTokenRegex(
        code,
        /\b(void|int|float|double|char|byte|bool|boolean|long|short|unsigned|const|String)\b/g,
        "syntax-type",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(if|else|for|while|do|switch|case|break|continue|return)\b/g,
        "syntax-keyword",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(setup|loop|pinMode|digitalWrite|digitalRead|analogRead|analogWrite|delay|map)\b/g,
        "syntax-function",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(Serial|begin|println|print|HIGH|LOW|INPUT|OUTPUT|INPUT_PULLUP|A0|A1|A2|A3|A4|A5)\b/g,
        "syntax-constant",
        tokenizer
    );

    code = highlightWithTokenRegex(
        code,
        /\b(\d+)\b/g,
        "syntax-number",
        tokenizer
    );

    return tokenizer.restore(code);
}

function highlightCodeByLanguage(code, language) {
    if (language === "arduino") {
        return highlightArduinoCode(code);
    }

    if (language === "emu8086") {
        return highlightAsmCode(code);
    }

    return escapeHtmlSyntax(code);
}

function applyHighlightToStaticBlocks() {
    const codeBlocks = document.querySelectorAll("pre code");

    codeBlocks.forEach(function (codeBlock) {
        const parentPre = codeBlock.closest("pre");

        if (!parentPre || parentPre.dataset.highlightApplied === "true") {
            return;
        }

        const rawCode = codeBlock.textContent;
        const language = detectCodeLanguage(rawCode);
        const highlightedCode = highlightCodeByLanguage(rawCode, language);

        codeBlock.innerHTML = highlightedCode;
        parentPre.classList.add("syntax-highlighted");
        parentPre.dataset.language = language;
        parentPre.dataset.highlightApplied = "true";
    });
}

function createHighlightedEditor(textarea) {
    if (textarea.dataset.highlightEditorApplied === "true") {
        return;
    }

    const shell = document.createElement("div");
    shell.className = "code-editor-shell";

    const highlightLayer = document.createElement("pre");
    highlightLayer.className = "code-highlight-layer";

    const currentParent = textarea.parentNode;

    currentParent.insertBefore(shell, textarea);
    shell.appendChild(highlightLayer);
    shell.appendChild(textarea);

    function updateEditorHighlight() {
        const rawCode = textarea.value;
        const language = detectCodeLanguage(rawCode);
        const highlightedCode = highlightCodeByLanguage(rawCode, language);

        shell.dataset.language = language;
        highlightLayer.innerHTML = highlightedCode + "\n";
    }

    textarea.addEventListener("input", updateEditorHighlight);

    textarea.addEventListener("scroll", function () {
        highlightLayer.scrollTop = textarea.scrollTop;
        highlightLayer.scrollLeft = textarea.scrollLeft;
    });

    textarea.dataset.highlightEditorApplied = "true";

    highlightedEditors.push({
        textarea,
        updateEditorHighlight
    });

    updateEditorHighlight();
}

function applyHighlightToEditors() {
    const editors = document.querySelectorAll("textarea.code-editor");

    editors.forEach(function (textarea) {
        createHighlightedEditor(textarea);
    });
}

function refreshHighlightedEditors() {
    highlightedEditors.forEach(function (editor) {
        editor.updateEditorHighlight();
    });
}

document.addEventListener("click", function (event) {
    const clickedFixButton = event.target.closest("[data-fix], [data-arduino-fix]");

    if (clickedFixButton) {
        setTimeout(refreshHighlightedEditors, 0);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    applyHighlightToStaticBlocks();
    applyHighlightToEditors();
    updateLockedNextUnits();
});

applyHighlightToStaticBlocks();
applyHighlightToEditors();
updateLockedNextUnits();
