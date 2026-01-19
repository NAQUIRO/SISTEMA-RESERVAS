# Sistema de Reservas

Un sistema de gestión de reservas desarrollado con Laravel, diseñado para facilitar la reserva de mesas en restaurantes u otros espacios.

## Tecnologías Utilizadas

- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templates, Vite para compilación de assets
- **Base de Datos**: MySQL (compatible con XAMPP)
- **Autenticación**: Laravel Sanctum
- **Pruebas**: PHPUnit

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalados los siguientes componentes en tu sistema:

- **PHP** versión 8.1 o superior
- **Composer** (gestor de dependencias de PHP)
- **Node.js** y **npm** (para gestión de assets frontend)
- **XAMPP** o cualquier servidor local con MySQL (para la base de datos)
- **Git** (para clonar el repositorio)

### Verificar Instalaciones

Abre una terminal y ejecuta los siguientes comandos para verificar que todo esté instalado correctamente:

```bash
php --version
composer --version
node --version
npm --version
```

## Instalación

Sigue estos pasos para configurar el proyecto en tu máquina local:

### 1. Clonar el Repositorio

```bash
git clone https://github.com/tu-usuario/sistemareserva.git
cd sistemareserva
```

### 2. Instalar Dependencias de PHP

```bash
composer install
```

### 3. Instalar Dependencias de Node.js

```bash
npm install
```

### 4. Configurar el Archivo de Entorno

Copia el archivo de ejemplo de configuración:

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus configuraciones locales. Asegúrate de configurar la base de datos:

```env
APP_NAME=SistemaReserva
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistemareserva
DB_USERNAME=root
DB_PASSWORD=
```

**Nota**: Si usas XAMPP, el usuario por defecto es `root` y la contraseña está vacía. Asegúrate de que MySQL esté corriendo en XAMPP.

### 5. Generar la Clave de la Aplicación

```bash
php artisan key:generate
```

### 6. Configurar la Base de Datos

Asegúrate de que XAMPP esté ejecutándose y crea una base de datos llamada `sistemareserva` en phpMyAdmin.

Ejecuta las migraciones para crear las tablas:

```bash
php artisan migrate
```

### 7. Ejecutar los Seeders (Opcional)

Para poblar la base de datos con datos de ejemplo:

```bash
php artisan db:seed
```

Esto ejecutará el `TableSeeder` y otros seeders configurados.

### 8. Construir los Assets del Frontend

```bash
npm run build
```

O para desarrollo con recarga automática:

```bash
npm run dev
```

### 9. Ejecutar el Servidor de Desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

## Uso

Una vez configurado, puedes:

- Acceder a la aplicación web en tu navegador.
- Gestionar usuarios, mesas y reservas a través de la interfaz.
- Usar las rutas definidas en `routes/web.php` y `routes/api.php`.

### Comandos Útiles

- **Limpiar caché**: `php artisan cache:clear`
- **Limpiar vistas compiladas**: `php artisan view:clear`
- **Reiniciar migraciones**: `php artisan migrate:fresh --seed`

## Pruebas

Ejecuta las pruebas con PHPUnit:

```bash
./vendor/bin/phpunit
```

O usando el comando de Laravel:

```bash
php artisan test
```

## Estructura del Proyecto

- `app/Http/Controllers/` - Controladores de la aplicación
- `app/Models/` - Modelos Eloquent (User, Table, Reservation)
- `database/migrations/` - Migraciones de base de datos
- `database/seeders/` - Seeders para datos iniciales
- `resources/views/` - Vistas Blade
- `routes/` - Definición de rutas
- `public/` - Archivos públicos
- `tests/` - Pruebas unitarias y de funcionalidad

