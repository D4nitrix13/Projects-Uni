# Proyecto Final AMC

## Web Educativa de Arquitectura de Computadoras

Proyecto educativo desarrollado en **PHP, HTML, CSS y JavaScript** para explicar temas fundamentales de Arquitectura de Computadoras, microprocesadores, microcontroladores, programación en ensamblador con **EMU8086** y simulación de circuitos con **Arduino en Tinkercad**.

El sistema incluye autenticación por número de carnet, seguimiento de progreso mediante archivos JSON, cuestionarios por unidad, bloqueo de unidades según avance, tutoriales y prácticas interactivas.

---

## Contenido del proyecto

- Unidad I: Introducción a los microprocesadores y microcontroladores.
- Unidad II: Arquitectura del microprocesador.
- Unidad III: Programación del microprocesador.
- Unidad IV: Arquitectura de los microcontroladores.
- Unidad V: Programadores del microcontrolador.
- Tutorial de instalación y uso de EMU8086.
- Tutorial de Arduino con Tinkercad.
- Prácticas interactivas de EMU8086.
- Prácticas interactivas de Arduino.
- Sistema de inicio de sesión por carnet universitario.
- Sistema de progreso guardado en JSON.
- Bloqueo de unidades según aprobación.

---

## Tecnologías utilizadas

- PHP
- HTML5
- CSS3
- JavaScript
- JSON para almacenamiento local de progreso
- Servidor embebido de PHP

---

## Requisitos

Para ejecutar el proyecto se necesita tener instalado:

- PHP 8 o superior
- Un navegador web moderno
- Opcional: Visual Studio Code, Zed, Sublime Text o cualquier editor de código

---

## Instalación de PHP según sistema operativo

## Linux: Arch Linux / CachyOS

En Arch Linux, CachyOS o distribuciones basadas en Arch, se puede instalar PHP usando `pacman`.

```bash
sudo pacman -Syu
sudo pacman -S php
````

Verificar instalación:

```bash
php -v
```

Si también querés instalar herramientas útiles de desarrollo:

```bash
sudo pacman -S git unzip zip
```

Si preferís usar `yay`:

```bash
yay -S php
```

En CachyOS normalmente `pacman` es suficiente y recomendado para paquetes oficiales.

---

## Linux: Ubuntu / Debian

```bash
sudo apt update
sudo apt install php php-cli unzip git -y
```

Verificar instalación:

```bash
php -v
```

---

## Windows

En Windows hay dos opciones sencillas.

### Opción 1: Instalar PHP manualmente

1. Descargar PHP desde:

```text
https://windows.php.net/download/
```

1. Extraer PHP en una carpeta, por ejemplo:

```text
C:\php
```

1. Agregar `C:\php` al `PATH` del sistema.

2. Abrir PowerShell o CMD y verificar:

```powershell
php -v
```

### Opción 2: Usar XAMPP

1. Descargar XAMPP desde:

```text
https://www.apachefriends.org/
```

1. Instalar XAMPP.
2. Usar la terminal incluida o agregar PHP al `PATH`.
3. Verificar:

```powershell
php -v
```

Para este proyecto no es obligatorio usar Apache de XAMPP, porque se puede ejecutar con el servidor embebido de PHP.

---

## macOS

En macOS se recomienda instalar PHP con Homebrew.

Instalar Homebrew si no lo tenés:

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
```

Instalar PHP:

```bash
brew install php
```

Verificar instalación:

```bash
php -v
```

---

## Cómo ejecutar el proyecto

Desde la carpeta principal del proyecto:

```bash
cd arquitectura-maquinas
php -S localhost:8000
```

Luego abrir en el navegador:

```text
http://localhost:8000
```

---

## Acceso al sistema

El sistema solicita un número de carnet universitario.

Ejemplo válido:

```text
2023-0823I
```

Formato esperado:

```text
AAAA-NNNNL
```

Donde:

- `AAAA` representa el año.
- `NNNN` representa cuatro números.
- `L` representa una letra final.

Ejemplo:

```text
2023-0718I
```

El sistema no utiliza contraseña. Solo valida el formato del carnet y guarda el progreso asociado a ese carnet.

---

## Sistema de progreso

El progreso de los estudiantes se guarda en:

```text
storage/progreso/estudiantes.json
```

Ejemplo de estructura:

```json
{
    "2023-0718I": {
        "carnet": "2023-0718I",
        "creado_en": "2026-05-21 01:49:02",
        "ultimo_acceso": "2026-05-21 01:55:54",
        "modulos_aprobados": {
            "unidad1Quiz": {
                "quiz_id": "unidad1Quiz",
                "modulo": "Unidad I: Introducción a los microprocesadores y microcontroladores",
                "puntaje": 7,
                "aprobado_en": "2026-05-21 01:49:02",
                "actualizado_en": "2026-05-21 01:55:54"
            }
        },
        "puntajes": {
            "unidad1Quiz": 7
        }
    }
}
```

---

## Reglas de desbloqueo de unidades

Las unidades se desbloquean en orden.

```text
Unidad I   Disponible desde el inicio
Unidad II  Requiere aprobar Unidad I
Unidad III Requiere aprobar Unidad II
Unidad IV  Requiere aprobar Unidad III
Unidad V   Requiere aprobar Unidad IV
```

La nota mínima para aprobar una unidad es:

```text
7/10
```

Si un estudiante intenta entrar manualmente a una unidad bloqueada, el sistema debe redirigirlo a la unidad anterior correspondiente.

---

## EMU8086

El archivo ZIP de EMU8086 debe estar dentro del proyecto en la ruta:

```text
assets/downloads/emu8086.zip
```

La página del tutorial permite descargarlo directamente desde el servidor local del proyecto.

---

## Estructura del proyecto

```text
arquitectura-maquinas/
├── index.php
├── login.php
├── logout.php
├── README.md
├── api/
│   └── progreso.php
├── includes/
│   ├── footer.php
│   ├── header.php
│   ├── navbar.php
│   ├── progreso.php
│   └── session.php
├── pages/
│   ├── unidad1.php
│   ├── unidad2.php
│   ├── unidad3.php
│   ├── unidad4.php
│   └── unidad5.php
├── tutoriales/
│   ├── emu8086.php
│   └── arduino-tinkercad.php
├── practicas/
│   ├── emu8086-practicas.php
│   └── arduino-practicas.php
├── storage/
│   └── progreso/
│       └── estudiantes.json
└── assets/
    ├── css/
    │   └── styles.css
    ├── js/
    │   ├── main.js
    │   └── progreso.js
    ├── downloads/
    │   └── emu8086.zip
    └── img/
```

---

## Permisos recomendados en Linux

Si el sistema no puede escribir en `storage/progreso/estudiantes.json`, dar permisos de escritura:

```bash
chmod -R 775 storage
```

Si sigue fallando, verificar propietario:

```bash
ls -la storage/progreso
```

En un entorno local con el servidor embebido de PHP, normalmente basta con que el usuario actual tenga permisos de escritura.

---

## Validar JSON de progreso

Para comprobar que el archivo JSON no tiene errores:

```bash
php -r "json_decode(file_get_contents('storage/progreso/estudiantes.json')); echo json_last_error_msg(), PHP_EOL;"
```

Debe mostrar:

```text
No error
```

---

## Comandos útiles

Ejecutar servidor:

```bash
php -S localhost:8000
```

Verificar archivo de EMU8086:

```bash
ls -lh assets/downloads/emu8086.zip
```

Ver progreso de estudiantes:

```bash
cat storage/progreso/estudiantes.json
```

---

## Flujo recomendado para estudiantes

1. Ingresar con carnet universitario.
2. Leer la Unidad I.
3. Resolver el cuestionario.
4. Aprobar con mínimo 7/10.
5. Desbloquear la siguiente unidad.
6. Repetir el proceso hasta completar las cinco unidades.
7. Revisar los tutoriales de EMU8086 y Arduino.
8. Realizar las prácticas interactivas.

---

## Autor

Proyecto Final AMC
Web educativa de Arquitectura de Computadoras.
