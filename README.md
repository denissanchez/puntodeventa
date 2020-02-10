## Requerimentos

* PHP >= 7.2.19

## Instalación

1. Instalar dependencias composer:

    ```
    composer install
    ```
   
2. Generar key

     ```
    php artisan key:generate
    ```

3. Duplicar archivo ``.env.example`` y renombrarlo a ``.env``, luego configurar la base de datos.

3. Ejecutar migraciones

    ```
   php artisan migrate --seed
   ```
