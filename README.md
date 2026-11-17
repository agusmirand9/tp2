# Cabalgatas

Sitio dinámico para ofrecer cabalgatas por el campo correntino. Incluye un
blog de novedades, registro e inicio de sesión de usuarios y un panel de
administración.

Trabajo práctico: 2do parcial de Portales y Comercio Electrónico.

## Requisitos
- PHP 8.3 o superior
- Composer
- MySQL o MariaDB

## Instalación
1. `composer install`
2. Copiar `.env.example` a `.env` (o usar el `.env` de la entrega).
3. Crear la base de datos `miranda_agustina`.
4. `php artisan key:generate`
5. `php artisan migrate:fresh --seed`
6. `php artisan storage:link`
7. `php artisan serve`

## Usuarios de prueba
| Rol           | Email              | Contraseña |
|---------------|--------------------|------------|
| Administrador | admin@test.com     | tp0123456  |
| Usuario       | marlopez@test.com  | tp0123456  |
| Usuario       | mateo@test.com     | tp0123456  |

## Estructura
- `app/Http/Controllers`: controllers del sitio y, en `Admin/`, los del panel.
- `app/Http/Middleware/EnsureIsAdmin.php`: restringe el acceso al admin.
- `app/Models`: User, Role, Post, Ride y Booking.
- `database/migrations` y `database/seeders`: estructura y datos iniciales.
- `resources/views`: vistas Blade, con el layout en `components/layouts`.
