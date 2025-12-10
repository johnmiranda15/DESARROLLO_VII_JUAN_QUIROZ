<!-- Copilot instructions for contributors and AI coding agents -->
# Instrucciones rápidas para AI/Copilot en este repositorio

Breve: Proyecto PHP (POO) monolítico con frontend estático en `public/`. Usa una configuración simple por `.env`, conexión PDO, y migraciones SQL planas.

- **Punto de entrada (web):** `index.php` en la raíz del proyecto actúa como la página principal del panel.
- **Rutas y vistas:** Las vistas están en `views/` y se incluyen desde `index.php` u otros ficheros con la constante `VIEWS_PATH`.
- **Código servidor:** Código PHP orientado a objetos en `src/` (ej.: `src/Database.php`, `src/peliculas/PeliculasManager.php`, `src/tasks/TaskManager.php`).
- **BD:** Variables en `.env` cargadas por `config.php` y expuestas como constantes (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).

Flujo y herramientas importantes
- **Migraciones:** SQL crudo en `database/migrations/*.sql`. Para aplicar migraciones locales ejecutar desde la raíz:

```bash
php run-migrations.php
```

- **Conexión a BD:** `src/Database.php` usa un Singleton PDO. Preferir usar `Database::getInstance()->getConnection()` en managers.
- **Assets / JS:** `public/assets/js/plugins.js` contiene los plugins (Slick, Owl, etc). `public/assets/js/main.js` inicializa sliders y comportamientos. Importante: jQuery → `plugins.js` → `main.js` (orden de carga).

Patrones y convenciones del proyecto (específicos)
- Clases de acceso a datos nombradas `*Manager.php` y devuelven arrays asociativos (PDO::FETCH_ASSOC) o IDs; ej `PeliculasManager::createMovie()` devuelve `lastInsertId()`.
- Uso de `__DIR__` para rutas relativas en scripts CLI (ej.: `run-migrations.php`, `config.php`). Evitar suposiciones de CWD distintas.
- Las migraciones se marcan en tabla `migrations` creada por `MigrationManager.php` (no use de frameworks ni composer).
- Las vistas no usan un framework de templates; encontrarás includes PHP simples. Usa `VIEWS_PATH` para referenciar.

Errores y verificaciones comunes a chequear automáticamente
- Asegurarse de que `.env` exista y contenga `BASE_URL` — `config.php` falla si no existe `.env`.
- Evitar múltiples inclusiones de jQuery: si aparece `Uncaught TypeError: $(...).slick is not a function` revisar que `plugins.js` carga después de jQuery y antes de `main.js`.
- Revisar permisos/encoding de archivos `.sql` si `run-migrations.php` lanza errores al leer o ejecutar SQL.

Cómo iterar cambios (desarrollo local)
- Levantar XAMPP / Apache y apuntar a `http://localhost/<BASE_URL>` o usar la constante `BASE_URL` definida en `.env`.
- Para debugging PHP activar `display_errors` (ya habilitado en `index.php` durante desarrollo).
- Para cambios JS/CSS editar `public/assets/*` y recargar con cache limpio (Ctrl+F5).

Dónde mirar primero (archivos de referencia)
- `config.php` → carga `.env` y define constantes
- `src/Database.php` → patrón de conexión DB
- `database/MigrationManager.php` y `run-migrations.php` → migraciones
- `index.php` → template principal y orden de scripts
- `public/assets/js/plugins.js` y `public/assets/js/main.js` → inicialización de sliders y comportamiento frontend

Notas para la IA: concisa y práctica
- Cuando propongas cambios, evita introducir dependencias externas sin avisar (no hay `composer.json` ni gestión de paquetes PHP en este repo).
- Para fixes JS, valida en consola del navegador (errores y 404 en Network) y verifica el orden de carga de scripts en `index.php`.
- Para cambios en base de datos, documenta cualquier modificación de esquema con nuevos archivos SQL en `database/migrations/` y actualiza/ejecuta `php run-migrations.php`.

Solicito retroalimentación: ¿quieres que añada comandos de ejemplo para Windows/XAMPP, o que documente cómo desplegar en otro entorno?
