# Guía de Instalación y Ejecución

Sigue estos pasos para instalar y ejecutar el programa correctamente.

## 1. Instalación de Extensiones

### 1.1 Extensiones Requeridas
Para comenzar, instala las siguientes extensiones en tu editor de código:

- **PHP Intelephense**
- **PHP Server**

### 1.2 Desactivar PHP Incorporado
En el buscador de extensiones de tu editor, busca `@builtin php`. Si está activado, desactívalo para evitar conflictos con las extensiones.

## 2. Configuración de Variables de Entorno

Es necesario cambiar algunas variables de entorno para que el programa se ejecute correctamente. Asegúrate de que las variables estén configuradas adecuadamente antes de continuar.

## 3. Crear Base de Datos

Crea una base de datos en PostgreSQL llamada `products_db`

### 3.1 Script SQL
Una vez creada la base de datos, ejecuta el siguiente script SQL para configurar las tablas necesarias:

```sql
SQL.txt
