<div align="center">

#  Mini Sistema CRUD - PHP PDO

### Sistema de Gestión de Items con Backend RESTful API

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![SQLite](https://img.shields.io/badge/SQLite-3.0+-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://www.sqlite.org/)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)
[![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=for-the-badge)](http://makeapullrequest.com)

**Sistema CRUD profesional con API RESTful, validaciones robustas y testing automatizado**

[Demo](#-instalación) • [Características](#-características-destacadas) • [Documentación](#-documentación-de-api) • [Tests](#-testing)

</div>

---

##  Tabla de Contenidos

- [Características Destacadas](#-características-destacadas)
- [Tech Stack](#-tech-stack)
- [Instalación Rápida](#-instalación-rápida)
- [Documentación de API](#-documentación-de-api)
- [Testing](#-testing)
- [Seguridad](#-seguridad)
- [Contribuir](#-contribuir)
- [Licencia](#-licencia)

---

##  Características Destacadas

<table>
<tr>
<td>

###  CRUD Completo
- ✅ Crear, Leer, Actualizar, Eliminar
- ✅ Paginación inteligente
- ✅ Validaciones en tiempo real
- ✅ Sanitización automática

</td>
<td>

###  Seguridad
- ✅ PDO Prepared Statements
- ✅ Protección XSS
- ✅ Validaciones robustas
- ✅ CORS configurable

</td>
</tr>
<tr>
<td>

###  Performance
- ✅ Singleton Pattern
- ✅ Consultas optimizadas
- ✅ Logging eficiente
- ✅ Cache-ready

</td>
<td>

###  Testing
- ✅ 20 tests unitarios
- ✅ Cobertura completa
- ✅ CI/CD ready
- ✅ Validación automática

</td>
</tr>
</table>

---

##  Tech Stack

<div align="center">

### Backend
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PDO](https://img.shields.io/badge/PDO-Database-blue?style=for-the-badge)
![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

### Frontend
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

### Tools & Patterns
![REST API](https://img.shields.io/badge/REST-API-green?style=for-the-badge)
![Singleton](https://img.shields.io/badge/Pattern-Singleton-orange?style=for-the-badge)
![MVC](https://img.shields.io/badge/Architecture-MVC-red?style=for-the-badge)

</div>

---

## � Estructura del Proyecto

```
Mini_Sistema_PDO/
│
├── 📂 public/                  # Directorio público (DocumentRoot)
│   ├── index.html             # Frontend (UI moderna)
│   └── 📂 api/
│       └── items.php          # API RESTful endpoints
│
├── 📂 logs/                    # Logs del sistema (auto-generado)
│   └── error.log              # Registro de errores
│
├── 🔧 config.php               # Configuración activa (privado)
├── 📋 config.example.php       # Plantilla de configuración
├── 🗄️ config_sqlite.php        # Config específica SQLite
│
├── 🏗️ Database.php             # Clase Singleton PDO
├── 📦 ItemModel.php            # Modelo de datos (CRUD)
│
├── 🚀 setup_sqlite.php         # Setup automático SQLite
├── 🧪 run_tests.php            # Suite de tests
│
├── 📄 sql.txt                  # Script SQL para MySQL
├── 📖 README.md                # Esta documentación
├── ⚖️ LICENSE                  # Licencia MIT
└── 🚫 .gitignore               # Archivos ignorados
```

---

##  Características Avanzadas

### Frontend Moderno

-  **Diseño Responsive**: funciona en móvil, tablet y desktop
-  **Dark Mode**: soporte automático según preferencias del sistema
-  **Edición Inline**: edita directamente en la tabla
-  **Actualización en Tiempo Real**: sin recargar página
-  **Modal Moderno**: interfaz intuitiva para actualizaciones

### Backend Robusto

-  **Patrón Singleton**: una sola conexión a BD
-  **Transacciones**: soporte completo para operaciones complejas
-  **Logging Avanzado**: contexto completo en cada error
-  **API RESTful**: diseño limpio y escalable
-  **Performance**: consultas optimizadas

---

##  Roadmap

### Versión 2.0 (Planificado)

- [ ]  Búsqueda y filtros avanzados
- [ ]  Dashboard con estadísticas
- [ ]  Sistema de autenticación JWT
- [ ]  Multi-usuario con roles
- [ ]  PWA (Progressive Web App)
- [ ]  Docker containerization
- [ ]  Métricas y analytics

### Mejoras Continuas

- [ ] GraphQL API
- [ ] WebSockets para tiempo real
- [ ] Exportación a PDF/Excel
- [ ] Importación masiva
- [ ] Auditoría de cambios
- [ ] Soft delete con papelera

---

##  Instalación Rápida

### Opción 1: Setup Automático con SQLite (⚡ Recomendado)

```bash
# 1. Clonar repositorio
git clone https://github.com/JavierQuinan/Mini_Sistema_PDO.git
cd Mini_Sistema_PDO

# 2. Configurar base de datos SQLite (automático)
php setup_sqlite.php

# 3. Iniciar servidor
php -S localhost:8000 -t public

# 4. Abrir navegador
# http://localhost:8000
```

### Opción 2: Configuración con MySQL

```bash
# 1. Crear base de datos
mysql -u root -p < sql.txt

# 2. Configurar credenciales
# Editar config.php y descomentar las líneas de MySQL

# 3. Iniciar servidor
php -S localhost:8000 -t public
```

###  Verificar Instalación

```bash
# Ejecutar suite de tests
php run_tests.php

# Resultado esperado: ✅ 20/20 tests pasados
```

---

##  Endpoints de la API

Base: `/api/items.php`

- **Listar**
  ```
  GET  ?action=listar&limit=50&offset=0
  ``� Documentación de API

### Endpoints Disponibles

| Método | Endpoint | Descripción | Body |
|--------|----------|-------------|------|
| `GET` | `/api/items.php?action=listar` | Listar todos los items | - |
| `GET` | `/api/items.php?action=obtener&id={id}` | Obtener item por ID | - |
| `POST` | `/api/items.php?action=crear` | Crear nuevo item | `{nombre, precio}` |
| `POST` | `/api/items.php?action=actualizar&id={id}` | Actualizar item | `{nombre?, precio?}` |
| `POST` | `/api/items.php?action=eliminar&id={id}` | Eliminar item | - |

### Ejemplos de Uso

<details>
<summary> Listar Items (con paginación)</summary>

```bash
curl "http://localhost:8000/api/items.php?action=listar&limit=10&offset=0"
```

**Respuesta:**
```json
{
  "ok": true,
  "data": [
    {
      "id": 1,
      "nombre": "Laptop HP",
      "precio": "1200.00",
      "creado_en": "2025-12-28 10:30:00"
    }
  ]
}
```
</details>

<details>
<sum� Seguridad

### Medidas Implementadas

| Característica | Implementación | Nivel |
|----------------|----------------|-------|
| SQL Injection | PDO Prepared Statements | 🟢 Alto |
| XSS Protection | `htmlspecialchars()` | 🟢 Alto |
| CORS | Headers configurables | 🟢 Alto |
| Validaciones | Servidor + Cliente | 🟢 Alto |
| Error Handling | Logging centralizado | 🟢 Alto |

### Validaciones de Entrada

```php
// Validaciones automáticas
✅ Nombre: máx 120 caracteres, no vacío
✅ Precio: rango 0 - 999,999.99
✅ Sanitización: escape de HTML
✅ Type Safety: strict types habilitado
```

### Buenas Prácticas

- ✅ Sin credenciales en el código
- ✅ `.gitignore` configurado
- ✅ Archivos de configuración separados
- ✅ Manejo de errores sin exponer información sensible
- ✅ Logging solo en modo desarrollod '{"precio":139.99}'
```
</details>

<details>
<summary> Eliminar Item</summary>

```bash
curl -X POST "http://localhost:8000/api/items.php?action=eliminar&id=6"
```

**Respuesta:**
```json
{
  "ok": true,
  "deleted": 6
}
```
</details> **Sanitización de inputs** con `htmlspecialchars()`
- ✅ **Validaciones robustas**: longitud de strings, rangos numéricos
- ✅ **CORS configurado** para peticiones cross-origin
- ✅ **Manejo de errores centralizado** con logging
- ✅ **Headers de seguridad** configurados
- ✅ **Proting

### Suite de Tests Automatizados

El proyecto incluye **20 tests unitarios** que validan toda la funcionalidad:

```bash
php run_tests.php
```

### Cobertura de Tests

| Categoría | Tests | Estado |
|-----------|-------|--------|
|  CRUD Básico | 6 tests | ✅ 100% |
|  Validaciones | 4 tests | ✅ 100% |
|  Seguridad XSS | 2 tests | ✅ 100% |
|  Paginación | 2 tests | ✅ 100% |
| **Total** | **20 tests** | **✅ 100%** |

### Ejemplo de Salida

```
 Iniciando Suite de Tests - Mini Sistema PDO
============================================================

📋 Test 1: Listar Items
✅ PASS: Listar debe retornar un array
✅ PASS: Debe haber al menos un item en la BD

➕ Test 2: Crear Item
✅ PASS: Crear debe retornar el item creado
✅ PASS: El nombre debe coincidir
✅ PASS: El precio debe coincidir

...

============================================================
 RESUMEN DE TESTS
============================================================
✅ Tests pasados: 20
❌ Tests fallidos: 0
📈 Total: 20

 ¡Todos los tests pasaron exitosamente!
``` refused | {"code":"2002"}
[2025-12-28 10:31:12] Validación fallida: El nombre no puede exceder 120 caracteres
```

---

##  Mejoras implementadas

 **Esta versión mejorada incluye:**

1.  **Sistema de CORS configurable** para integración con frontends
2.  **Logging de errores** con contexto detallado
3.  **Sanitización mejorada** contra XSS con `htmlspecialchars()`
4.  **Validaciones extendidas**: límites de caracteres (120) y precio (999999.99)
5.  **Archivo `.gitignore`** para proteger configuración sensible
6.  **Plantilla `config.example.php`** para facilitar setup
7.  **Manejo de errores diferenciado** (validación, BD, genéricos)
8.  **Documentación mejorada** con badges y estructura clara
9.  **Licencia MIT** incluida
10. **Soporte SQLite** - funciona sin necesidad de instalar MySQL
11. **Suite de tests** - 20 tests unitarios automatizados
12. **Setup automático** - script de configuración con un solo comando

---

##  Tests

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

##  Frontend (index.html)

- Formulario para crear items.
- Tabla con filas editables (guardado **on blur**).
- **Modal** para actualizar con campos precargados.
- Botón **Eliminar** con confirmación.
- CSS moderno con soporte *dark mode* (via `prefers-color-scheme`).

---

##  Troubleshooting

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

##  Roadmap (ideas)

- Filtro por nombre y **búsqueda live**.
- **Paginación** y ordenamiento por columnas.
- Campos extra (estado/categoría) y **soft delete**.
- **Autenticación** y **roles** (admin/técnico).
- Tests con **PHPUnit**.

---

##  FAQ

**¿Por qué PDO en vez de MySQLi?**  
- Portabilidad multi-motor (MySQL, PostgreSQL, SQLite, etc.).  
- Placeholders **nombrados** y API ergonómica.  
- Excepciones consistentes con `ERRMODE_EXCEPTION`.  
- Misma seguridad si usas preparados correctamente; PDO **facilita** hacerlo bien.

---

##  Contribuir

1. Fork el proyecto
2. Crea una rama: `git checkout -b feature/nueva-funcionalidad`
3. Commit tus cambios: `git commit -m 'Agrega nueva funcionalidad'`
4. Push a la rama: `git push origin feature/nueva-funcionalidad`
5. Abre un Pull Request

---

##  Licencia

Este proyecto está bajo la **Licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más detalles.

---

##  Autor

Desarrollado por **Francisco Javier Quinteros Andrade**  
- GitHub: [@JavierQuinan](https://github.com/JavierQuinan)

---

##  Recursos adicionales

- [PHP PDO Documentation](https://www.php.net/manual/es/book.pdo.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [MDN Web Docs](https://developer.mozilla.org/)
- [OWASP Security Guidelines](https://owasp.org/)

---

**¿Preguntas o sugerencias?** Abre un [issue](../../issues) en GitHub.

