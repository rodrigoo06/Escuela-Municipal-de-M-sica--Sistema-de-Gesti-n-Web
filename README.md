# Escuela Municipal de Música - Sistema de Gestión Web
*El siguiente código puede dar fallo o estar incompleto.*
## ¿Qué hace esta aplicación?

- Permite registrar nuevos alumnos y gestionar renovaciones.
- Mantiene una lista de espera automática cuando se alcanza el límite máximo de plazas (55).
- Administra bonificaciones:
  - 50% para familias numerosas (previa presentación de documentación).
  - 100% para personas con renta baja.
  - Exención total para miembros de la Banda de Música.
- Permite dar de baja alumnos sin borrar su información, para conservar histórico.
- Permite gestionar usuarios administradores con diferentes permisos para acceder al panel de control.
- Panel de administración con:
  - Registro y edición de alumnos.
  - Listado con filtros y visualización del estado (activo, baja, lista de espera).
  - Gestión de usuarios administradores (creación y eliminación).
- Sistema de login seguro con contraseñas cifradas.

---

## Tecnologías utilizadas

- PHP 8+
- MySQL / MariaDB
- Bootstrap 5 para diseño responsivo y moderno
- POO y PDO para conexiones seguras a la base de datos

---

## Instalación y configuración

### 1. Requisitos previos

- Servidor web con PHP 8 o superior (por ejemplo Apache o Nginx).
- Base de datos MySQL o MariaDB.
- Acceso a un panel de control como Plesk o phpMyAdmin para gestionar la base de datos.

### 2. Crear la base de datos

Puedes crear una base de datos llamada, por ejemplo, `escuela_musica` con usuario y contraseña que tengan todos los permisos:

```sql
CREATE DATABASE escuela_musica CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'usuario_web'@'localhost' IDENTIFIED BY 'contrasena_segura';
GRANT ALL PRIVILEGES ON escuela_musica.* TO 'usuario_web'@'localhost';
FLUSH PRIVILEGES;
```

Comienza a gestionar alumnos y usuarios.

### 3. Importar tablas
Importa el archivo `sql/database.sql` que contiene la estructura y datos iniciales necesarios para la aplicación.

### 4. Configurar conexión a la base de datos
Edita el archivo `includes/db.php` para ajustar los datos de conexión:
```sql
<?php
$host = 'localhost';
$db   = 'escuela_musica';
$user = 'usuario_web';
$pass = 'contrasena_segura';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}
```
### 5. Crear usuario administrador
Ejecuta este SQL para crear un primer usuario administrador (cambia el email y el hash por uno adecuado):
```sql
INSERT INTO usuarios (nombre, email, password) VALUES (
    'Administrador',
    'admin@escuela.local',
    '$2y$10$EjemploDeHashDeContraseñaGeneradoPorPHP'
);
```
**Nota:** La contraseña debe estar cifrada con `password_hash()`. Puedes generar un hash usando este pequeño script PHP:
```sql
<?php
echo password_hash('tu_contraseña', PASSWORD_DEFAULT);
```

### 6. Acceder a la aplicación
- Abre el navegador y navega a la URL donde está alojada la aplicación.
- Inicia sesión con el email y contraseña del administrador creado.
- Comienza a gestionar alumnos y usuarios.

# Licencia de Uso - Código Abierto con Condiciones

Copyright (c) 2025 Rodrigo Perez
---
Por la presente, se concede permiso para utilizar, copiar, modificar y distribuir este software y su código fuente, tanto para uso público como privado, bajo las siguientes condiciones:

1. **Mantenimiento de derechos de autor:**  
   El aviso de copyright original y los créditos al autor Rodrigo Perez deben mantenerse en todas las copias, modificaciones o distribuciones del software.

2. **Notificación de cambios:**  
   Cualquier modificación, mejora o cambio realizado al código original debe ser claramente indicado y documentado en los archivos correspondientes o en la documentación adjunta.

3. **Permiso para publicación:**  
   Antes de publicar, distribuir o hacer público cualquier copia, versión modificada o derivada de este software, es obligatorio solicitar y obtener autorización previa y por escrito contactando a Rodrigo Perez mediante:

   - Correo electrónico: rodrigo@plenix.net  
   - Instagram: [@__rodrigoo.06](https://www.instagram.com/__rodrigoo.06)

---

**Descargo de responsabilidad:**  
Este software se proporciona "tal cual", sin garantías expresas o implícitas de ningún tipo. El autor no se hace responsable de daños o perjuicios derivados del uso o mal uso del software.

---

Al usar, modificar o distribuir este software, usted acepta y se compromete a cumplir con las condiciones anteriormente expuestas.

---

**Fecha de emisión:** Julio 2025


