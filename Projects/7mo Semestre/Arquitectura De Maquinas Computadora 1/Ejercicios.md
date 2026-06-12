# Práctica 1: Mostrar un mensaje en pantalla

```asm
.model small
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
end main
```

---

## Práctica 2: Suma de dos números

```asm
.model small
.stack 100h

.code
main proc
    mov al, 5
    mov bl, 3
    add al, bl

    mov ah, 4Ch
    int 21h
main endp
end main
```

El resultado queda en:

```asm
AL = 8
```

---

## Práctica 3: Comparación y salto condicionado

```asm
.model small
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
end main
```

Como `AX = 8` y `BX = 5`, debe mostrar:

```text
AX es mayor
```

---

## Práctica 4: Ciclo con LOOP

```asm
.model small
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
end main
```

Este programa repite la etiqueta `repetir` 5 veces. La instrucción `nop` no hace ninguna operación, pero sirve para demostrar el ciclo.
