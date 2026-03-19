/*
 * https://espanol.libretexts.org/Fisica/Libro%3A_F%C3%ADsica_(sin_l%C3%ADmites)/3%3A_Cinem%C3%A1tica_bidimensional/3.3%3A_Movimiento_del_proyectil
 * Programa Name: Catapulta
 */

// Variables de entrada

// Importar el módulo readline
const readline = require('readline');

// Crear una interfaz para la entrada y salida estándar
const io = readline.createInterface({
  input: process.stdin,
  output: process.stdout
});


// Constante de la gravedad en m/s^2
const g = 9.81;


/*
 * Un objeto lanzado en movimiento de proyectil 
 * tendrá un ángulo de lanzamiento inicial en cualquier 
 * lugar de 0 a 90 grados. El alcance de un objeto,
 * dado el ángulo de lanzamiento inicial 
 * y la velocidad inicial se encuentra con:R=v2isin2θig.
 */

// Función para calcular el alcance del proyectil
function calcularAlcance(v, theta) {
  return (v * v * Math.sin(2 * theta * Math.PI / 180)) / g;
}

// Función para calcular la altura máxima alcanzada
function calcularAlturaMaxima(v, theta) {
  return (v * v * Math.sin(theta * Math.PI / 180) * Math.sin(theta * Math.PI / 180)) / (2 * g);
}

// Función para calcular el tiempo de vuelo
function calcularTiempoDeVuelo(v, theta) {
  return (2 * v * Math.sin(theta * Math.PI / 180)) / g;
}

// Función para calcular la velocidad inicial a partir del alcance y el ángulo
function calcularVelocidadInicial(R, theta) {
  return Math.sqrt((R * g) / Math.sin(2 * theta * Math.PI / 180));
}
// Ejemplo de uso
// let angulo = 45; // ángulo en grados
// let velocidadInicial = 20; // velocidad inicial en m/s
// let alcance = calcularAlcance(velocidadInicial, angulo);
// let alturaMaxima = calcularAlturaMaxima(velocidadInicial, angulo);
// let tiempoDeVuelo = calcularTiempoDeVuelo(velocidadInicial, angulo);

/*
// Preguntar al usuario
io.question('Ingrese el ángulo del lanzamiento (Rango 0 - 90): ', (input) => {
  // Convertir la entrada a un número entero
  let angulo = parseInt(input, 10);

  // Validar que el ángulo esté en el rango correcto
  if (isNaN(angulo) || angulo < 0 || angulo > 90) {
    console.log('Por favor, ingrese un número válido entre 0 y 90.');
  } else {
    console.log('El ángulo ingresado es:', angulo);
    // Aquí puedes continuar con la lógica de tu programa
  }

  // Cerrar la interfaz de readline
  io.close();
});
*/

let angulo = 45; // Ángulo en grados
let alcance = 50; // Alcance en Metros
let velocidadInicial = calcularVelocidadInicial(alcance, angulo);

console.log(`Velocidad Inicial: ${velocidadInicial.toFixed(2)} m/s`);
// console.log(`Alcance: ${alcance.toFixed(2)} metros`);
// console.log(`Altura Máxima: ${alturaMaxima.toFixed(2)} metros`);
// console.log(`Tiempo de Vuelo: ${tiempoDeVuelo.toFixed(2)} segundos`);

