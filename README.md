# Serviunix API

El proyecto es una API REST desarrollada en PHP y MySql.
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg" height="40" alt="php logo"  /> <img src="https://cdn.simpleicons.org/mysql/4479A1" height="40" alt="mysql logo"  />
## Requisitos del Entorno Local

Para ejecutar este proyecto en tu entorno local, necesitas tener instalado lo siguiente:

1. **XAMPP**: Un entorno de desarrollo que incluye Apache y MySQL. Puedes descargarlo [aquí](https://www.apachefriends.org/index.html).


## Configuración del Entorno Local

Sigue estos pasos para configurar tu entorno local:

1. Instala XAMPP siguiendo las instrucciones en su sitio web.

2. Inicia XAMPP y asegúrate de que Apache y MySQL estén funcionando.

3. Descarga este proyecto y colócalo en la carpeta `htdocs` de tu instalación de XAMPP. Por lo general, esta carpeta se encuentra en la siguiente ubicación (dependiendo de tu sistema operativo):
   - **Windows**: `C:\xampp\htdocs`
   - **Linux**: `/opt/lampp/htdocs`
   - **macOS**: `/Applications/XAMPP/xamppfiles/htdocs`

4. **Instala Composer** (si aún no lo tienes instalado):
   - Visita [https://getcomposer.org/download/](https://getcomposer.org/download/) para instalar Composer.
   - Asegúrate de tener PHP instalado en tu sistema antes de continuar.

5. **Instala las dependencias de Composer**:
   - Abre una terminal o línea de comandos en la carpeta del proyecto.
   - Ejecuta el siguiente comando para instalar las dependencias necesarias:

   ```bash
   composer install


6. en la carpeta database encontraras el archivo create_tables.sql ejecutalo para crear la base de datos.