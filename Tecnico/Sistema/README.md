# Sistema Misves

Sistema web para la gestión de una pastelería desarrollado con **CodeIgniter 4**, PHP y MySQL. Permite publicar el catálogo de productos, administrar usuarios, gestionar pedidos y domicilios, moderar reseñas y consultar estadísticas de ventas.

## Características

- Catálogo público de productos.
- Registro, inicio y cierre de sesión.
- Contraseñas almacenadas con `password_hash`.
- Perfiles con roles:
  - Cliente: rol `1`.
  - Administrador: rol `2`.
  - Domiciliario: rol `3`.
- Administración de usuarios, productos, pedidos y reseñas.
- Gestión de estados de domicilios.
- Estadísticas y productos más vendidos.
- Migraciones y seeders de CodeIgniter 4.
- Protección de rutas mediante filtros de autenticación y roles.
- Diseño adaptable para escritorio y dispositivos móviles.

## Requisitos

- PHP 8.2 o superior.
- Composer.
- MySQL 8 o MariaDB.
- Extensiones PHP: `intl`, `mbstring`, `mysqli`, `json` y `curl`.
- Apache o el servidor integrado de CodeIgniter 4.

## Instalación local

1. Clona o copia el proyecto dentro de tu servidor local.

2. Instala las dependencias:

```bash
composer install
```

3. Crea una base de datos MySQL llamada:

```text
pasteler_misves
```

4. Revisa el archivo `.env` y ajusta los datos de conexión:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080'

database.default.hostname = localhost
database.default.database = pasteler_misves
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

5. Ejecuta las migraciones y datos iniciales:

```bash
php spark migrate --seed
```

6. Inicia el servidor:

```bash
php spark serve
```

Abre `http://localhost:8080` en el navegador.

## Credenciales de prueba

Las credenciales se crean mediante `UsuarioSeeder`:

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | `admin@misves.com` | `admin123` |
| Cliente | `cliente@misves.com` | `cliente123` |
| Domiciliario | `domicilio@misves.com` | `domicilio123` |

Cambia estas credenciales antes de usar el sistema en producción.

## Estructura principal

```text
app/
├── Config/             Configuración y rutas
├── Controllers/        Controladores de la aplicación
├── Database/
│   ├── Migrations/     Estructura de la base de datos
│   └── Seeds/          Datos iniciales
├── Filters/            Autenticación y autorización por rol
├── Models/             Modelos de acceso a datos
└── Views/              Vistas HTML
public/
├── css/                Hojas de estilos
├── img/                Imágenes públicas
└── uploads/            Imágenes de productos
```

## Rutas principales

- `/` — Página de inicio.
- `/catalogo` — Catálogo público.
- `/login` — Inicio de sesión.
- `/registro` — Registro de clientes.
- `/dashboard` — Panel del usuario autenticado.
- `/perfil` — Edición del perfil.
- `/admin/usuarios` — Administración de usuarios.
- `/admin/productos` — Administración de productos.
- `/admin/pedidos` — Administración de pedidos.
- `/admin/resenas` — Administración de reseñas.
- `/admin/estadisticas` — Estadísticas.
- `/domicilios` — Gestión de domicilios para administradores y domiciliarios.

## Base de datos

Las migraciones crean las tablas principales del sistema:

- `rol`
- `usuario`
- `producto`
- `resena`
- `pedido`
- `detalle_pedido`

Para reiniciar la base de datos durante el desarrollo:

```bash
php spark migrate:refresh --seed
```

Este comando elimina y vuelve a crear las tablas. No lo ejecutes en producción sin realizar una copia de seguridad.

## Configuración con XAMPP

Si usas XAMPP:

1. Copia el proyecto en `htdocs`.
2. Inicia Apache y MySQL.
3. Crea la base de datos `pasteler_misves` desde phpMyAdmin.
4. Configura `.env` con tus credenciales locales.
5. Ejecuta `composer install` y las migraciones.
6. Accede mediante `http://localhost/sistema/public/` o configura un VirtualHost apuntando a la carpeta `public`.

La carpeta pública debe ser el documento raíz del servidor. No apuntes Apache al directorio raíz del proyecto porque expondrías archivos internos.

## Seguridad

- No subas el archivo `.env` con credenciales reales.
- Usa HTTPS en producción.
- Cambia las contraseñas de prueba.
- Mantén `CI_ENVIRONMENT = production` en el servidor de producción.
- Valida y limita los archivos que se suban a `public/uploads`.
- Realiza copias de seguridad de la base de datos.

## Comandos útiles

```bash
php spark routes              # Lista las rutas disponibles
php spark migrate             # Ejecuta migraciones pendientes
php spark db:seed DatabaseSeeder
php spark cache:clear         # Limpia la caché
vendor/bin/phpunit            # Ejecuta las pruebas
```

## Tecnologías

- CodeIgniter 4.
- PHP 8.2+.
- MySQL/MariaDB.
- Composer.
- HTML, CSS y JavaScript.
- Dompdf para documentos PDF.

## Estado del proyecto

El proyecto está estructurado para ejecutarse localmente con CodeIgniter 4. Antes de publicarlo, configura las credenciales reales, revisa las reglas del servidor web, prueba todos los flujos con datos reales y ejecuta la suite de pruebas.

## Licencia

Este proyecto se distribuye bajo la licencia incluida en el archivo `LICENSE`.

## Soporte

Para problemas con CodeIgniter, consulta la [documentación oficial](https://codeigniter.com/user_guide/). Para incidencias específicas del sistema, revisa primero la configuración de `.env`, la conexión MySQL y los registros de `writable/logs`.

---

Desarrollado para la gestión de la pastelería Misves.
