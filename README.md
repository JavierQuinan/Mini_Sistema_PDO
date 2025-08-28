# Mini Sistema CRUD (PHP + PDO)

Pequeño sistema CRUD de **Items** con backend en **PHP + PDO** (API JSON) y frontend en **HTML + CSS + JS** sin frameworks.  
Diseñado para ser **simple, entendible y extensible**.

> **Stack:** PHP 8+, MySQL/MariaDB, PDO, HTML/CSS/JS vanilla.

---

## 📦 Características

- CRUD completo: **crear, listar, actualizar, eliminar**.
- API JSON con **errores siempre en JSON** (sin HTML inesperado).
- **PDO** con *prepared statements* y placeholders **nombrados**.
- Frontend minimalista con **tabla editable**, **modal de actualización** y estilos modernos.
- Listo para correr con `php -S` (server embebido de PHP).

---

## 🗂️ Estructura del proyecto

```
Mini-PDO/
  config.php               # (privado, se ignora en git) credenciales reales
  config.example.php       # (público) plantilla de configuración
  Database.php             # Singleton PDO + helpers (select/exec/tx)
  ItemModel.php            # Lógica de dominio (listar/obtener/crear/actualizar/eliminar)
  public/
    index.html             # UI (form, tabla, modal, CSS y JS)
    api/
      items.php            # Endpoints JSON
```

---

## 🔧 Requisitos

- PHP 8.0+ con extensión **pdo_mysql** habilitada.
- MySQL/MariaDB.
- Navegador moderno.

Verifica `pdo_mysql`:
```bash
php -m | grep pdo_mysql
# en Windows PowerShell:
# php -m | findstr /I pdo_mysql
```

---

## 🛠️ Instalación

1) **Base de datos**
```sql
CREATE DATABASE minisistema_pdo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE minisistema_pdo;

CREATE TABLE items (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(120) NOT NULL,
  precio DECIMAL(10,2) NOT NULL DEFAULT 0,
  creado_en TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
```

2) **Configurar credenciales**

Copia `config.example.php` a `config.php` y ajusta tus datos reales.

```php
<?php
declare(strict_types=1);

const DB_DSN  = 'mysql:host=127.0.0.1;port=3306;dbname=minisistema_pdo;charset=utf8mb4';
const DB_USER = 'TU_USUARIO';
const DB_PASS = 'TU_PASSWORD';

const APP_DEBUG = true; // en producción: false

function json_out($data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  exit;
}
```

3) **Ignorar `config.php` en git**
```gitignore
config.php
vendor/
node_modules/
*.log
.DS_Store
Thumbs.db
.idea/
.vscode/
public/uploads/
```

4) **Levantar el servidor**
```bash
php -S 127.0.0.1:8080 -t public
# Abrir http://127.0.0.1:8080/
```

> Nota: La API está en `public/api/items.php`, y el frontend la consume como `api/items.php`.

---

## 🔌 Endpoints de la API

Base: `/api/items.php`

- **Listar**
  ```
  GET  ?action=listar&limit=50&offset=0
  ```
- **Obtener**
  ```
  GET  ?action=obtener&id=:id
  ```
- **Crear**
  ```
  POST ?action=crear
  Body JSON: { "nombre": "Aceite", "precio": 10.5 }
  ```
- **Actualizar**
  ```
  POST ?action=actualizar&id=:id
  Body JSON (parcial o completo): { "nombre": "Aceite 5W30", "precio": 12.00 }
  ```
- **Eliminar**
  ```
  POST ?action=eliminar&id=:id
  ```

### Ejemplos con `curl`

```bash
# Listar
curl "http://127.0.0.1:8080/api/items.php?action=listar"

# Crear
curl -X POST "http://127.0.0.1:8080/api/items.php?action=crear"   -H "Content-Type: application/json"   -d '{"nombre":"Filtro de aceite","precio":7.90}'

# Actualizar
curl -X POST "http://127.0.0.1:8080/api/items.php?action=actualizar&id=1"   -H "Content-Type: application/json"   -d '{"precio":8.50}'

# Eliminar
curl -X POST "http://127.0.0.1:8080/api/items.php?action=eliminar&id=1"
```

---

## 🛡️ Seguridad y buenas prácticas

- **Prepared statements** con PDO y `ATTR_EMULATE_PREPARES=false` → evita inyecciones SQL.
- **Errores como JSON**: el endpoint captura *warnings/notices* y responde con `{ ok:false, error: ... }`.
- Validaciones del lado **servidor** (nombre requerido, precio ≥ 0).
- **No** publiques `config.php`. Usa `config.example.php` en el repo.

---

## 🖥️ Frontend (index.html)

- Formulario para crear items.
- Tabla con filas editables (guardado **on blur**).
- **Modal** para actualizar con campos precargados.
- Botón **Eliminar** con confirmación.
- CSS moderno con soporte *dark mode* (via `prefers-color-scheme`).

---

## 🧪 Troubleshooting

- **`Unexpected token <`** en el frontend:
  - Estás recibiendo HTML (error/404) en vez de JSON.
  - Revisa que sirves con `-t public` y que la API esté en `public/api`.
  - Abre en el navegador: `http://127.0.0.1:8080/api/items.php?action=listar`  
    Debe devolver JSON.

- **`could not find driver`**:
  - Habilita `pdo_mysql` en `php.ini` y reinicia.

- **`Access denied` o `Unknown database`**:
  - Verifica usuario/clave o nombre de la base en `config.php`.

- **Includes rotos** (`require_once`):
  - Si moviste `items.php` a `public/api`, usa rutas relativas correctas:
    ```php
    require_once __DIR__ . '/../../ItemModel.php';
    ```

---

## 🗺️ Roadmap (ideas)

- Filtro por nombre y **búsqueda live**.
- **Paginación** y ordenamiento por columnas.
- Campos extra (estado/categoría) y **soft delete**.
- **Autenticación** y **roles** (admin/técnico).
- Tests con **PHPUnit**.

---

## ❓ FAQ

**¿Por qué PDO en vez de MySQLi?**  
- Portabilidad multi-motor (MySQL, PostgreSQL, SQLite, etc.).  
- Placeholders **nombrados** y API ergonómica.  
- Excepciones consistentes con `ERRMODE_EXCEPTION`.  
- Misma seguridad si usas preparados correctamente; PDO **facilita** hacerlo bien.

---

## 🧑‍💻 Autor

- **Francisco Javier Quinteros Andrade** – [@JavierQuinan](https://github.com/JavierQuinan)

---

## 📝 Licencia

Este proyecto está bajo la licencia **MIT**. Siéntete libre de usarlo, mejorarlo y compartirlo.
