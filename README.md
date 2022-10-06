# CARRITO DE COMPRAS
Proyecto del cusro de Aseguramiento de la Calidad de Software

## Requerimientos
- php >= 7.4.29 (Instalar Xampp o WampServer)
- Composer >= 2.3.10
- Node >= 16.14.0
- Angular CLI >= 13.2.6

## Instalacion de requerimientos
### PHP 
[Xampp](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.2.31/)
o
[WampServer](https://www.wampserver.com/en/)

### Composer
[Composer](https://getcomposer.org/)

### Node.js
[Node.js](https://nodejs.org/es/)

## Configuración de Ambiente de desarrollo
Verificar que los requerimientos esten instalados

```sh
php --version
composer --version
node --version
ng --version
```

Los comandos no deber retornar error, de lo contrario se deben instalar los requerimientos

### Instalación de Angular
```sh
npm i -g @angular/cli@13.2.6
```

## Primer ejecución del proyecto de Backend
```sh
cd ./Backend 
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

## Configuración de Variables de entorno de Base de datos (.env)
```sh
DB_DATABASE=tienda

FILESYSTEM_DRIVER = public
```
## Ejecución de Backend
```sh
php artisan serve
```

## Primer ejecución del proyecto de Frontend
```sh
cd ./Frontend
npm install
```
## Configuración de variables (enviroment.ts)
```sh
    IP = ip donde se ejecuta el backend
    PORT = Puerto en donde se ejecuta el backend
  url_api: 'http://IP:PORT/api',
  url_storage: 'http://IP:PORT/storage',
```

## Ejecución de Frontend
```sh
ng serve -o
```

## Recursos
[Mamba UI](https://mambaui.com/components)

[Tailwind CSS](https://tailwindcss.com/docs/guides/angular)

[Socialite Providers](https://socialiteproviders.com/)

[CSS Gradient](https://cssgradient.io//)
