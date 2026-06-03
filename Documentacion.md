# 📰 Sitio de hoteles

Plataforma web para la gestión y reservación de habitaciones de hotel, desarrollada con Laravel 13.
Implementa un sistema de roles y flujo de aprobación de reservas para garantizar un control adecuado entre usuarios, administradores de hotel y super administradores.

---

# Contenidos

1. [Descripción del Proyecto](#-descripción-del-proyecto)
2. [Roles del Sistema](#-roles-del-sistema)
3. [Requisitos Previos](#-requisitos-previos)
4. [Instalación Paso a Paso](#-instalación-paso-a-paso)
5. [Configuración de la Base de Datos](#-configuración-de-la-base-de-datos)
6. [Compilación de Assets](#-compilación-de-assets)
7. [Usuarios de Prueba](#-usuarios-de-prueba)
8. [Cómo Usar el Sistema](#-cómo-usar-el-sistema)
9. [Ejecutar las Pruebas](#-ejecutar-las-pruebas)
10. [Solución de Problemas Comunes](#-solución-de-problemas-comunes)
11. [Tecnologías Utilizadas](#-tecnologías-utilizadas)

---


## 📖 Descripción del Proyecto

El Sistema de Reservas de Hoteles es una aplicación web que permite:

Mostrar hoteles disponibles al público
Gestionar habitaciones por hotel
Solicitar reservas con fechas específicas
Aprobar o rechazar reservas por parte del administrador del hotel
Controlar accesos mediante roles
🏨 Funcionalidades principales
Gestión de hoteles (Super Admin)
Gestión de habitaciones (Admin Hotel)
Reservas con validación de fechas
Estados de reserva:
⏳ Pendiente
✅ Aprobada
❌ Rechazada
🚫 Cancelada
Paneles separados por rol

---

## 👥 Roles del Sistema

| Rol           |        Permisos
|---------------|----------------
| **Super Admin**  | Crear, editar y eliminar hoteles. Crear y administrar usuarios.
| **Admin Hotel**  | Administrar habitaciones de su hotel. Aprobar o rechazar reservas.
| **Usuario**      | Ver hoteles, reservar habitaciones y consultar el estado de sus reservas.
| **Invitado**     | Ver hoteles y habitaciones disponibles (solo lectura).

---

## ✅ Requisitos Previos

Antes de instalar el proyecto, debes tener instalado lo siguiente en tu computadora. **Todos son obligatorios.**

### 1. PHP 8.2 o superior

**Windows (recomendado: XAMPP)**
- Descarga XAMPP desde: https://www.apachefriends.org/
- Elige la versión que incluya **PHP 8.2 o superior**
- Durante la instalación, selecciona al menos los componentes: **Apache**, **MySQL**, **PHP**
- Después de instalar, agrega PHP al PATH del sistema:
  - Abre el menú Inicio → busca "Variables de entorno"
  - En "Variables del sistema", selecciona `Path` → Editar
  - Agrega una nueva entrada: `C:\xampp\php`
  - Acepta todos los cambios y reinicia la terminal

Verifica la instalación abriendo una terminal (CMD o PowerShell) y ejecutando:
```bash
php -v
```
Debes ver algo como: `PHP 8.2.x ...`

---

### 2. Composer (gestor de dependencias de PHP)

- Descarga el instalador desde: https://getcomposer.org/download/
- Ejecuta el instalador `.exe` y sigue los pasos
- Cuando te pregunte por el ejecutable de PHP, apunta a `C:\xampp\php\php.exe`

Verifica la instalación:
```bash
composer -V
```
Debes ver algo como: `Composer version 2.x.x`

---

### 3. Node.js 18 o superior (incluye npm)

- Descarga desde: https://nodejs.org/en/
- Descarga la versión **LTS (Long Term Support)**
- Instala con las opciones por defecto

Verifica la instalación:
```bash
node -v
npm -v
```
Debes ver los números de versión de ambos.

---

### 4. Git

- Descarga desde: https://git-scm.com/download/win
- Instala con las opciones por defecto

Verifica la instalación:
```bash
git -v
```

---

### 5. MySQL (ya incluido en XAMPP)

Si instalaste XAMPP, ya tienes MySQL disponible.

Incluido en XAMPP
Puerto por defecto: 3306

---

## 🚀 Instalación Paso a Paso

> ⚠️ **Importante:** Sigue los pasos **en el orden exacto indicado**. No saltes ningún paso.

### Paso 1 — Clonar el repositorio

Abre una terminal (CMD o PowerShell) y navega hasta la carpeta donde quieras instalar el proyecto. Se recomienda usar la carpeta `htdocs` de XAMPP:

```bash
cd C:\xampp\htdocs
```

Clona el repositorio:
```bash
git clone https://github.com/TU_Usuario/hotel.git

```
> ⚠️ Reemplaza `TU_USUARIO` con el nombre de usuario real de GitHub.

Entra a la carpeta del proyecto:
```bash
cd Sitio-de-Noticias
```

---

### Paso 2 — Instalar dependencias de PHP

Este comando descarga todas las librerías de PHP que el proyecto necesita (carpeta `vendor`):

```bash
composer install
```

> ⏳ Este proceso puede tardar entre 1 y 3 minutos según tu conexión a internet. Espera a que termine completamente antes de continuar.

---

### Paso 3 — Instalar dependencias de Node.js

Este comando descarga las herramientas de compilación de CSS/JS (carpeta `node_modules`):

```bash
npm install
```

---

### Paso 4 — Crear el archivo de configuración

El proyecto necesita un archivo `.env` con la configuración del entorno. Cópialo desde el archivo de ejemplo:

```bash
copy .env.example .env
```

---

### Paso 5 — Generar la clave de seguridad de la aplicación

Laravel necesita una clave única para encriptar sesiones y datos. Genera esta clave con:

```bash
php artisan key:generate
```

Deberías ver el mensaje: `Application key set successfully.`

---

## 🗄️ Configuración de la Base de Datos

### Paso 6 — Crear la base de datos en MySQL

1. Asegúrate de que el servicio **MySQL** esté corriendo en el Panel de Control de XAMPP.
2. Abre tu navegador y ve a: `http://localhost/phpmyadmin`
3. En el panel izquierdo, haz clic en **"Nueva"** (o "New").
4. En el campo **Nombre de la base de datos**, escribe exactamente: `bdhotel`
5. En el selector de cotejamiento (collation), elige: `utf8mb4_unicode_ci`
6. Haz clic en **"Crear"**.

---

### Paso 7 — Configurar la conexión en el archivo `.env`

Abre el archivo `.env` (que copiaste en el Paso 4) con cualquier editor de texto (bloc de notas, VSCode, etc.) y verifica que las siguientes líneas coincidan con tu configuración de XAMPP:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bdhotel
DB_USERNAME=root
DB_PASSWORD=
```

> ℹ️ En XAMPP, el usuario por defecto de MySQL es `root` y la contraseña está **vacía** (sin escribir nada). Si tu instalación tiene una contraseña diferente, escríbela después de `DB_PASSWORD=`.

Guarda los cambios en el archivo `.env`.

---

### Paso 8 — Ejecutar las migraciones

Este comando crea todas las tablas necesarias en la base de datos `bdhotel`:

```bash
php artisan migrate
```

Cuando pregunte `Do you want to run this command? [yes/no]`, escribe `yes` y presiona Enter.

Deberías ver una lista de todas las migraciones ejecutadas con ✓.

---

### Paso 9 — Ejecutar seeders

Este comando crea los 3 usuarios de prueba (Super_admin, admin_hotel, user):

```bash
php artisan db:seed
```

Deberías ver el mensaje: `Database seeding completed successfully.`



## 🎨 Compilación de Assets

### Paso 11 — Compilar CSS y JavaScript

El proyecto usa **Vite** para compilar los estilos y scripts. Ejecuta este comando para generar los archivos para producción:

```bash
npm run build
```

> ⏳ Este proceso puede tardar entre 30 segundos y 1 minuto. Espera hasta que veas el mensaje final con los archivos generados.

---

## ▶️ Iniciar el Servidor

### Paso 12 — Levantar el servidor de desarrollo

```bash
php artisan serve
```

Deberías ver:

```
INFO  Server running on [http://127.0.0.1:8000/].
```

Abre tu navegador y visita: **http://127.0.0.1:8000**

¡Listo! El proyecto ya está funcionando

> ℹ️ **Nota:** Mantén esta terminal abierta mientras uses el proyecto. Para detener el servidor, presiona `Ctrl + C`.

---

## 👤 Usuarios de Prueba

El seeder del Paso 9 crea automáticamente los siguientes usuarios para que puedas probar todas las funciones del sistema de inmediato:

| Rol | Correo Electrónico | Contraseña |
|-----|--------------------|------------|
| **Super Admin** | super@admin.com | password   |
| **Super Admin** | admin@hotel.com | password |
| **Usuario**.    | user@test.com   | password |

> ℹ️ También puedes registrar un nuevo usuario desde el sitio web. Por defecto, todos los usuarios nuevos reciben el rol de **Espectador**.

---

## 📱 Cómo Usar el Sistema

### Como Usuario
👤 Usuario
Inicia sesión
Ve la lista de hoteles
Selecciona un hotel
Elige una habitación
Selecciona fechas
La reserva queda en Pendiente
Espera aprobación del administrador

### Como Admin Hotel
🏨 Admin Hotel
Inicia sesión
Accede a su panel
Administra habitaciones
Revisa reservas pendientes
Aprueba o rechaza reservas

### Como Super Admin
👑 Super Admin
Gestiona hoteles
Crea usuarios
Asigna administradores a hoteles

### 🔄 Flujo de Reservas
Usuario → Reserva (Pendiente)
Admin Hotel → Aprueba / Rechaza
Usuario → Ve estado actualizado

---
### ###Solución de Problemas Comunes
### Error: Application key missing
php artisan key:generate

### Error: Base de datos no conecta
Verificar MySQL activo
Verificar .env

### Sin estilos CSS
npm run build

### Imágenes no se muestran
php artisan storage:link
---

## 🛠️ Tecnologías Utilizadas

| Tecnología        | Versión | Uso                     |
|-------------------|---------|-------------------------|
| **PHP**           | ^8.2    | Lenguaje backend        |
| **Laravel**       | ^12.0   | Framework principal     |
| **MySQL**         | 5.7+    | Base de datos relacional |
| **Vite**          | ^7.0    | Compilación de assets   |
| **Bootstrap**     | 5 (CDN) | Componentes de UI adicionales |
| **Laravel Breeze**| ^2.4    | Autenticación y gestión de usuarios |

---

## 📝 Licencia

Este proyecto fue desarrollado como trabajo académico para la materia de Programacion Web Avanzada.