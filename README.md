# Tienda — Instalación en Windows

Proyecto **Laravel 13** con frontend basado en **Vite**, **Tailwind CSS** y **Bootstrap**. Usa **SQLite** como base de datos por defecto, así que no necesitas instalar un servidor de base de datos aparte.

## Requisitos previos

| Herramienta | Versión mínima | Verificar con (PowerShell/CMD) |
|---|---|---|
| PHP | 8.3+ | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 18+ (recomendado 20+) | `node -v` |
| npm | 9+ | `npm -v` |
| Git | cualquiera reciente | `git --version` |

### Extensiones de PHP necesarias

`mbstring`, `openssl`, `pdo_sqlite`, `sqlite3`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `curl`
(En Windows estas extensiones se habilitan descomentando líneas en `php.ini`, ver más abajo).

## Instalación de herramientas

### Opción recomendada: con [Laravel Herd](https://herd.laravel.com/windows)

Herd instala PHP, Composer y un servidor local con un solo instalador para Windows. Es la forma más rápida de tener todo listo. Después de instalarlo, sigue directo a "Pasos de instalación".

### Opción manual

1. **PHP**
   - Descarga el build "Thread Safe" desde https://windows.php.net/download/
   - Descomprime, por ejemplo, en `C:\php`
   - Agrega `C:\php` a la variable de entorno `PATH` (Panel de control → Sistema → Configuración avanzada → Variables de entorno)
   - Copia `php.ini-development` como `php.ini` y descomenta (quita el `;`) estas líneas:
     ```
     extension=mbstring
     extension=openssl
     extension=pdo_sqlite
     extension=sqlite3
     extension=fileinfo
     extension=curl
     ```

2. **Composer**
   - Descarga e instala desde https://getcomposer.org/Composer-Setup.exe
   - El instalador detecta tu PHP automáticamente

3. **Node.js**
   - Descarga el instalador LTS desde https://nodejs.org/ (incluye npm)

4. **Git**
   - Descarga desde https://git-scm.com/download/win

> Tip: usa **PowerShell** o la terminal integrada de VS Code para todos los comandos siguientes.

## Pasos de instalación

```powershell
# 1. Clonar el repositorio
git clone https://github.com/Azherafel/Tienda.git
cd Tienda

# 2. Instalar dependencias de PHP
composer install

# 3. Crear archivo de entorno y generar clave de la app
copy .env.example .env
php artisan key:generate

# 4. Crear la base de datos SQLite (vacía)
New-Item database\database.sqlite -ItemType File
php artisan migrate

# (Opcional) Cargar datos de prueba si el proyecto tiene seeders
php artisan db:seed

# 5. Instalar dependencias de frontend
npm install
```

> Si usas CMD en vez de PowerShell, cambia `copy` y `New-Item` por:
> ```cmd
> copy .env.example .env
> type nul > database\database.sqlite
> ```

## Levantar el proyecto

**Opción A — todo en un solo comando** (servidor, queue, logs y Vite juntos):

```powershell
composer run dev
```

**Opción B — manual, en dos terminales separadas:**

```powershell
php artisan serve      # backend → http://localhost:8000
npm run dev            # Vite (assets en caliente)
```

Abre tu navegador en **http://localhost:8000**.

## Problemas comunes

- **`'php' no se reconoce como un comando`:** falta agregar PHP al `PATH`, o necesitas abrir una terminal nueva después de instalarlo.
- **`could not find driver` al migrar:** revisa que `extension=pdo_sqlite` y `extension=sqlite3` estén descomentadas en tu `php.ini`, y que ese sea el `php.ini` que tu PHP realmente está usando (`php --ini` te dice cuál carga).
- **Error de permisos/antivirus al instalar dependencias npm:** ejecuta la terminal como administrador o agrega una excepción temporal en el antivirus.
- **Puerto 8000 ocupado:** usa `php artisan serve --port=8001`.

- # Tienda — Instalación en Linux

Proyecto **Laravel 13** con frontend basado en **Vite**, **Tailwind CSS** y **Bootstrap**. Usa **SQLite** como base de datos por defecto, así que no necesitas instalar un servidor de base de datos aparte.

## Requisitos previos

| Herramienta | Versión mínima | Verificar con |
|---|---|---|
| PHP | 8.3+ | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 18+ (recomendado 20+) | `node -v` |
| npm | 9+ | `npm -v` |
| Git | cualquiera reciente | `git --version` |

### Extensiones de PHP necesarias

`mbstring`, `openssl`, `pdo`, `pdo_sqlite`, `sqlite3`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `curl`

### Instalar lo anterior (ejemplo en Ubuntu/Debian/Mint)

```bash
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl \
  php8.3-sqlite3 php8.3-tokenizer unzip curl git -y

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js (vía NodeSource, ejemplo Node 20)
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

> En Arch: `sudo pacman -S php composer nodejs npm git`
> En Fedora: `sudo dnf install php php-cli php-pdo php-sqlite3 composer nodejs npm git`

## Pasos de instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/Azherafel/Tienda.git
cd Tienda

# 2. Instalar dependencias de PHP
composer install

# 3. Crear archivo de entorno y generar clave de la app
cp .env.example .env
php artisan key:generate

# 4. Crear la base de datos SQLite
touch database/database.sqlite
php artisan migrate

# (Opcional) Cargar datos de prueba si el proyecto tiene seeders
php artisan db:seed

# 5. Instalar dependencias de frontend
npm install
```

## Levantar el proyecto

**Opción A — todo en un solo comando** (servidor, queue, logs y Vite juntos):

```bash
composer run dev
```

**Opción B — manual, en terminales separadas:**

```bash
php artisan serve      # backend → http://localhost:8000
npm run dev            # Vite (assets en caliente)
```

Abre tu navegador en **http://localhost:8000**.

## Problemas comunes

- **`Permission denied` en `storage/` o `bootstrap/cache/`:**
  ```bash
  sudo chmod -R 775 storage bootstrap/cache
  sudo chown -R $USER:$USER storage bootstrap/cache
  ```
- **`could not find driver` al migrar:** falta la extensión `php-sqlite3`/`pdo_sqlite`. Instálala y reinicia el comando.
- **Puerto 8000 ocupado:** usa `php artisan serve --port=8001`.
