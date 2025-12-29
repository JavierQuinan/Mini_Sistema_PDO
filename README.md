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
├── config_sqlite.php       # Configuración específica para SQLite
├── Database.php            # Singleton PDO + helpers (select/exec/tx)
├── ItemModel.php           # Lógica de dominio (CRUD completo)
├── setup_sqlite.php        # Script de configuración SQLite
├── run_tests.php           # Suite de tests unitarios
├── .gitignore             # Archivos ignorados por git
├── sql.txt                # Script de creación de BD MySQL
├── database.sqlite        # Base de datos SQLite (generada)
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

- **PHP 8.0+** con extensiones:
  - `pdo_mysql` (para MySQL) o `pdo_sqlite` (para SQLite)
- **MySQL/MariaDB 5.7+** (opcional si usas SQLite)
- Navegador moderno (Chrome, Firefox, Edge, Safari)

### Verificar extensiones PHP:

```bash
# Para SQLite (recomendado)
php -m | grep pdo_sqlite

# Para MySQL (opcional)
php -m | grep pdo_mysql

# En Windows PowerShell:
php -m | findstr /I pdo_sqlite
php -m | findstr /I pdo_mysql
```

---

## 📦 Instalación

### 1️⃣ Clonar el repositorio

```bash
git clone <tu-repo>
cd Mini_Sistema_PDO
```

### 2️⃣ Configurar la base de datos

**Opción A: SQLite (Recomendado - No requiere instalación)**

```bash
php setup_sqlite.php
```

Esto creará automáticamente:
- Base de datos `database.sqlite`
- Tabla `items` con estructura completa
- 5 items de ejemplo para probar

**Opción B: MySQL (Si ya tienes MySQL instalado)**

Ejecuta el script SQL:

```bash
mysql -u root -p < sql.txt
```

Luego actualiza `config.php` descomentando las líneas de MySQL.

### 3️⃣ Iniciar el servidor

```bash
php -S localhost:8000 -t public
```

### 4️⃣ Acceder a la aplicación

Abre tu navegador en: **http://localhost:8000**

### 5️⃣ (Opcional) Ejecutar tests

```bash
php run_tests.php
```

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
10. 🗄️ **Soporte SQLite** - funciona sin necesidad de instalar MySQL
11. 🧪 **Suite de tests** - 20 tests unitarios automatizados
12. 🚀 **Setup automático** - script de configuración con un solo comando

---

## 🧪 Tests

El proyecto incluye una suite completa de tests unitarios:

```bash
php run_tests.php
```

**Tests incluidos:**
- ✅ Listar items con paginación
- ✅ Crear items con validaciones
- ✅ Obtener item por ID
- ✅ Actualizar items (parcial y completo)
- ✅ Eliminar items
- ✅ Validaciones (nombre vacío, precio negativo, longitud máxima, etc.)
- ✅ Sanitización XSS
- ✅ Límites de paginación

**Resultado esperado:** 20/20 tests pasados ✅

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

