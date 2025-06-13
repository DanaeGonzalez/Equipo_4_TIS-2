# VetCodex - Plataforma Multicliente para Clínicas Veterinarias 🐾

VetCodex es una plataforma SaaS multi-tenant desarrollada en Laravel 10 para gestionar múltiples clínicas veterinarias, cada una con su propia base de datos y personalización (colores, logos, textos, blog, etc.).

## 🧱 Tecnologías

- Laravel 10 (PHP 8.2)
- XAMPP / MySQL
- Tailwind CSS 3.4.17 + Flowbite + DaisyUI
- Filament Admin Panel v3.3.17
- [stancl/tenancy](https://github.com/stancl/tenancy) v3.9.1
- Composer, GitHub, VSCode

## 📁 Estructura de carpetas destacadas

```bash
routes/
├── web.php           # Rutas del dominio central
├── tenant.php        # Rutas específicas para tenants

resources/views/
├── tenant/           # Vistas personalizadas por clínica
├── central/          # Vistas central

database/migrations/
├── /                 # Migraciones para la base central
├── tenant/           # Migraciones específicas de cada clínica

```

# Crear un tenant (clínica)
Crearlo desde el panel de admin de vetcodex

# Ejecutar migraciones para todos los tenants
Ya se ejecutan al crear el tenant pero en caso de no ser asi ejecutar:
php artisan tenant:migrate

# Listar todos los tenants
php artisan tenant:list

# Ejecutar seeders en todos los tenants
php artisan tenant:seed

# Ejecutar seeders solo en un tenant específico //check
php artisan tenant:seed --tenants=vivet

# Crear un usuario superadmin para el panel central
php artisan make:filament-user

# Instalar Tailwind CSS + DaisyUI + Flowbite
npm install -D tailwindcss@3.4.17 daisyui flowbite

# Compilar assets para producción (Usar este por tema de los subdominios)
npm run build

*Intrucciones 

luego de clonar el repositorio

para migrar la base de datos
- php artisan migrate

para los seeder
- php artisan db:seed

para los permisos 
- php artisan permissions:sync

tambien para generar los horarios
- php artisan schedules:generate-weekly

- y por ultimo un comando para finalizar las horas que expirararon o ya no deberian estar disponibles
php artisan appointments:mark-expired


--