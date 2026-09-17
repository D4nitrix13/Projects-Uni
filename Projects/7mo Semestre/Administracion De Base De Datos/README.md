# setup.sh

Script de bootstrap para el proyecto **Panda Estampados / Kitsune** (PHP + PostgreSQL + Docker).

Levanta el entorno completo de desarrollo con un solo comando: configura permisos con `sudo`, crea `.env`, construye imágenes, levanta contenedores y carga el esquema SQL.

---

## Requisitos

- **Docker** con `docker compose` (v2+)
- **sudo** sin contraseña, o willingness de tipear la contraseña cuando el script la pida
- Permiso de ejecución: `chmod +x setup.sh`

> El script usa `sudo` para asignar owners correctos a los volúmenes (`999:999` para Postgres, `33:33` para PHP/Apache, `5050:5050` para pgAdmin). Si sudo no está disponible, **el script falla con error claro** en lugar de fallar silenciosamente más tarde con `permission denied` en el WAL archive.

---

## Comandos

```bash
./setup.sh up        # Levantar contenedores (rápido, no toca datos ni schema)
./setup.sh down      # Detener y eliminar contenedores + volúmenes
./setup.sh stop      # Detener sin eliminar
./setup.sh start     # Iniciar contenedores detenidos
./setup.sh restart   # Reiniciar (re-aplica permisos a volúmenes)
./setup.sh build     # Reconstruir imagen de la app con caché
./setup.sh logs      # Ver logs en vivo de todos los servicios
./setup.sh status    # Ver estado de los contenedores
./setup.sh fresh     # ⚠️  BORRA TODO y reconstruye desde cero (incluye schema)
./setup.sh           # Muestra la ayuda
```

### ¿Cuándo usar `up` vs `fresh`?

| Comando  | ¿Borra datos? | ¿Carga schema SQL? | ¿Cuándo usarlo?                              |
|----------|---------------|--------------------|----------------------------------------------|
| `up`     | No            | No                 | Día a día, reanudar desarrollo                |
| `fresh`  | **Sí**        | **Sí**             | Primera vez, o cuando cambia `sql/*.sql`      |

---

## Qué hace cada comando

### `./setup.sh up` — el flujo normal

1. **`ensure_env_file`** — si no existe `.env`, lo copia desde `.env.example`.
2. **`ensure_volume_permissions`** — crea `database/`, `storage/`, `backups/`, `uploads/` con los owners correctos (vía `sudo`).
3. **`docker compose up -d`** — arranca los 5 servicios.

Después de un `up`, si las tablas aún no existen en la DB (primera vez), ejecutá `./setup.sh fresh` para cargarlas, o aplicá los `sql/*.sql` manualmente.

### `./setup.sh fresh` — reset completo

1. `docker compose down --remove-orphans -v`
2. `sudo rm -rf storage/ backups/ database/`
3. `ensure_volume_permissions` — recrea el árbol con owners correctos
4. Levanta Postgres solo y corre `composer install` en el contenedor app
5. Genera los JSON de configuración inicial en `storage/system/`
6. Levanta todo
7. Carga los archivos SQL en orden: `01_data.sql` → `06_reportes_functions.sql`

---

## Servicios disponibles

Una vez levantado:

| Servicio       | URL                       | Credenciales              |
|----------------|---------------------------|---------------------------|
| App (PHP)      | http://localhost:8080     | —                         |
| pgAdmin        | http://localhost:5050     | admin@admin.com / admin   |
| Mailpit (web)  | http://localhost:8026     | —                         |
| PostgreSQL     | localhost:5432            | postgres / root           |
| Mailpit (SMTP) | localhost:1026            | —                         |

> Los puertos de Mailpit son **8026** (UI) y **1026** (SMTP) para evitar colisión con otros stacks de desarrollo que típicamente usan 8025/1025.

---

## Migraciones de base de datos

Este proyecto **no usa una herramienta de migraciones versionada** (Phinx, Doctrine, Laravel Migrations, etc.). El esquema se carga como archivos SQL estáticos numerados:

```
sql/01_data.sql               -- tablas + datos iniciales
sql/02_procedures.sql         -- procedures y funciones base
sql/03_paginacion.sql         -- funciones de paginación
sql/04_ranking_productos.sql  -- ranking de productos
sql/05_plazos.sql             -- tablas de plazos
sql/06_reportes_functions.sql -- funciones de reportes
```

### Cómo se aplican

Solo `./setup.sh fresh` las ejecuta, en orden, con `docker exec psql`:

```bash
docker exec -i pandas_bd psql -U postgres -d pandas_estampados_y_kitsune < sql/01_data.sql
docker exec -i pandas_bd psql -U postgres -d pandas_estampados_y_kitsune < sql/02_procedures.sql
# ... etc
```

### Cómo agregar una migración nueva

1. Creá `sql/07_mi_cambio.sql` con tu DDL/DML (incluí `IF NOT EXISTS` en los `CREATE` para idempotencia).
2. Agregá una línea en `setup.sh` dentro de `cmd_fresh`, sección "7) Cargando esquema y datos":

   ```bash
   echo "Cargando mi cambio..."
   docker exec -i pandas_bd psql \
       -U postgres \
       -d pandas_estampados_y_kitsune \
       < sql/07_mi_cambio.sql
   ```

3. Subí el archivo al repo. El próximo `./setup.sh fresh` (o el manual) la aplica.

> ⚠️ Los `sql/*.sql` no tienen control de versiones: si la tabla ya existe, el `CREATE` falla. Por eso se ejecutan solo en `fresh`, que parte de una DB vacía.

---

## Archivos críticos

| Archivo                  | Función                                                            |
|--------------------------|--------------------------------------------------------------------|
| `setup.sh`               | Este script                                                        |
| `docker/docker-compose.yml` | Define los 5 servicios: app, postgres, pgadmin, mailpit, scheduler |
| `docker/Dockerfile`      | Imagen PHP/Apache con extensiones para Postgres                    |
| `.env.example`           | Plantilla de variables de entorno (DB, SMTP, secrets)              |
| `.env`                   | Tu config local (no commitear, está en `.gitignore`)               |
| `sql/*.sql`              | Esquema y datos — ver sección Migraciones                          |
| `conf/php.ini`           | Overrides de PHP para el contenedor                                |

---

## Troubleshooting

### `Bind for 0.0.0.0:XXXX failed: port is already allocated`

Otro proceso o contenedor está usando ese puerto. Verificá con:

```bash
ss -tln | grep <PUERTO>
docker ps --format "table {{.Names}}\t{{.Ports}}"
```

Los puertos configurados están en `docker/docker-compose.yml`. Para cambiarlos, editá las líneas `ports:` del servicio correspondiente.

### `Permission denied` en WAL archive (`/wal_archive/`)

El directorio `database/wal_archive/` quedó con owner incorrecto. Causas:

- Lo creaste manualmente con tu usuario antes de usar el script.
- Cambiaste de usuario y los dueños no coinciden.

Solución: `./setup.sh restart` (re-aplica los owners vía sudo). Si sigue fallando, manual:

```bash
sudo chown -R 999:999 database/wal_archive
sudo chmod -R 775 database/wal_archive
```

### `Failed to parse dotenv file ... unexpected whitespace`

Un valor en `.env` tiene espacios y no está entrecomillado. Ejemplo mal: `SMTP_FROM_NAME=Panda Estampados y Kitsune`. Ejemplo bien: `SMTP_FROM_NAME="Panda Estampados y Kitsune"`.

### `relation "producto" does not exist`

Las tablas no se cargaron. Esto pasa cuando arrancás con `./setup.sh up` por primera vez (sin haber corrido `fresh` antes). Solución: `./setup.sh fresh`.

### El script aborta con `sudo: a password is required`

Necesitás sudo sin contraseña (NOPASSWD) para tu usuario, o estar en una sesión interactiva donde puedas tipear la contraseña. Sin sudo no podés asignar los owners de los volúmenes.