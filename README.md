# Sistema web de gestión de citas odontológicas

Aplicación educativa en PHP para administrar citas odontológicas, pacientes, médicos, consultorios y disponibilidad de horarios.

## Tecnologías
PHP 8.2+, MySQL (PDO), Composer y PHPUnit.

## Arquitectura
Organización por capas con controladores, dominio, repositorios, servicios y vistas.
- `src/`: lógica de aplicación.
- `views/`: presentación.
- `public/`: punto de entrada y recursos públicos.
- `database/init/`: scripts SQL.
- `tests/`: pruebas.

## Instalación local (Git Bash)
Requiere PHP 8.2+, extensiones mbstring, PDO y pdo_mysql, Composer y MySQL.

```bash
git clone https://github.com/AstharoXs/Gestion-Citas.git
cd Gestion-Citas
composer install
cp .env.example .env
```

Configura .env con una base de datos local de pruebas. Revisa e importa los scripts database/init/01_schema.sql y database/init/02_seed.sql en ese orden, únicamente en una base de datos de desarrollo.

Configura Apache con public/ como directorio público y las reglas de reescritura correspondientes. El script composer serve referencia public/router.php, que no aparece en el repositorio actual; queda pendiente corregirlo antes de recomendarlo como método de ejecución.

## Comprobaciones
```bash
composer check
composer test
```

## Estado y privacidad
Proyecto académico, no destinado a uso clínico real. Utiliza exclusivamente datos ficticios. No publiques archivos .env con credenciales. La ejecución y las pruebas no se han validado en un entorno limpio.
.
