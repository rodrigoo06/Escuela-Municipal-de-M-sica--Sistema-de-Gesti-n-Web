# Escuela-Municipal-de-M-sica--Sistema-de-Gesti-n-Web
Bienvenido al repositorio del sistema web para la Escuela Municipal de Música. Esta aplicación está diseñada para facilitar la gestión de alumnos, renovaciones, lista de espera y bonificaciones, así como la administración de usuarios con acceso al panel de control.

# Escuela Municipal de Música - Sistema de Gestión Web

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

Comienza a gestionar alumnos y usuarios.

Licencia
Este proyecto es de código abierto. Puedes usarlo y modificarlo para tus necesidades, pero agradecemos que mantengas esta información y des créditos al autor original.

Contacto
Para dudas, sugerencias o reportes de errores, por favor abre un issue en este repositorio.
