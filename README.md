# TIS-2
Proyecto TIS-2, Grupo 4
Integrantes:
- César Avendaño
- Danae González
- Natalia Marileo
- Javier Pino


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