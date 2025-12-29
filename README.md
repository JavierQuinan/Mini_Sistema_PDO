# 🚀 Mini Sistema CRUD (PHP + PDO)

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Sistema CRUD completo de **Items** con backend en **PHP + PDO** (API JSON) y frontend en **HTML + CSS + JS** vanilla.  
Diseñado para ser **simple, seguro, entendible y extensible**.

> **Stack:** PHP 8+, MySQL/MariaDB, PDO, HTML/CSS/JS vanilla.

---

## ✨ Características

- ✅ **CRUD completo**: crear, listar, actualizar, eliminar
- 🔒 **Seguridad**: PDO con *prepared statements*, validaciones mejoradas, sanitización de inputs
- 🌐 **API JSON**: respuestas siempre en formato JSON con manejo de errores robusto
- 🎨 **Frontend moderno**: tabla editable, modal de actualización, diseño responsive
- 📝 **Logging**: sistema de registro de errores para debugging
- 🛡️ **CORS configurado**: listo para integración con frontends externos
- ⚡ **Validaciones**: límites de tamaño, rangos de precio, sanitización XSS

---

## 🗂️ Estructura del proyecto

```
Mini_Sistema_PDO/
├── config.php              # (privado) Configuración real - NO subir a git
├── config.example.php      # (público) Plantilla de configuración
├── Database.php            # Singleton PDO + helpers (select/exec/tx)
├── ItemModel.php           # Lógica de dominio (CRUD completo)
├── .gitignore             # Archivos ignorados por git
├── sql.txt                # Script de creación de BD
├── README.md              # Esta documentación
├── LICENSE                # Licencia MIT
├── logs/                  # Directorio de logs (auto-creado)
└── public/
    ├── index.html         # UI (form, tabla, modal, CSS y JS)
    └── api/
        └── items.php      # Endpoints JSON
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

## 🛡️ Seguridad

- ✅ **PDO con prepared statements** (protección contra SQL injection)
- ✅ **Sanitización de inputs** con `htmlspecialchars()`
- ✅ **Validaciones robustas**: longitud de strings, rangos numéricos
- ✅ **CORS configurado** para peticiones cross-origin
- ✅ **Manejo de errores centralizado** con logging
- ✅ **Headers de seguridad** configurados
- ✅ **Protección XSS** mediante sanitización

---

## 📊 Validaciones implementadas

| Campo    | Validación                                      |
|----------|-------------------------------------------------|
| `nombre` | No vacío, máx 120 caracteres, sanitizado XSS   |
| `precio` | >= 0, máx 999999.99                             |

---

## 🔍 Logging

Los errores se registran automáticamente en `logs/error.log` cuando `APP_DEBUG = true`:

```
[2025-12-28 10:30:45] Error de BD: Connection refused | {"code":"2002"}
[2025-12-28 10:31:12] Validación fallida: El nombre no puede exceder 120 caracteres
```

---

## 🚀 Mejoras implementadas

✨ **Esta versión mejorada incluye:**

1. 🔒 **Sistema de CORS configurable** para integración con frontends
2. 📝 **Logging de errores** con contexto detallado
3. 🛡️ **Sanitización mejorada** contra XSS con `htmlspecialchars()`
4. ✅ **Validaciones extendidas**: límites de caracteres (120) y precio (999999.99)
5. 📦 **Archivo `.gitignore`** para proteger configuración sensible
6. 📋 **Plantilla `config.example.php`** para facilitar setup
7. 🎯 **Manejo de errores diferenciado** (validación, BD, genéricos)
8. 📚 **Documentación mejorada** con badges y estructura clara
9. ⚖️ **Licencia MIT** incluida

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

## � Contribuir

1. Fork el proyecto
2. Crea una rama: `git checkout -b feature/nueva-funcionalidad`
3. Commit tus cambios: `git commit -m 'Agrega nueva funcionalidad'`
4. Push a la rama: `git push origin feature/nueva-funcionalidad`
5. Abre un Pull Request

---

## 📝 Licencia

Este proyecto está bajo la **Licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

## 👨‍💻 Autor

Desarrollado con ❤️ por **Francisco Javier Quinteros Andrade**  
- GitHub: [@JavierQuinan](https://github.com/JavierQuinan)

---

## 📚 Recursos adicionales

- [PHP PDO Documentation](https://www.php.net/manual/es/book.pdo.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [MDN Web Docs](https://developer.mozilla.org/)
- [OWASP Security Guidelines](https://owasp.org/)

---

**¿Preguntas o sugerencias?** Abre un [issue](../../issues) en GitHub.

