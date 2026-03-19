// Obtener el input del rango y el elemento span
const anguloInput = document.getElementById('angulo');
const anguloValue = document.getElementById('angulo-value');

// Función para actualizar el valor del ángulo
function actualizarAngulo() {
    anguloValue.textContent = anguloInput.value;
}

// Escuchar el evento 'input' para que se actualice cuando el usuario mueva el rango
anguloInput.addEventListener('input', actualizarAngulo);