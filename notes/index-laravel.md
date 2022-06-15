---
aliases: [index, back]
---

## Instalación
Para realizar una instalación en linux
1. PHP y dependencias:
```terminal
sudo apt update
```
```terminal
sudo apt install php-cli unzip
```
2. Composer
```terminal
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
```
```terminal
HASH=`curl -sS https://composer.github.io/installer.sig`
```
```terminal
echo $HASH
```
```terminal
Output e0012edf3e80b6978849f5eff0d4b4e4c79ff1609dd1e613307e16318854d24ae64f26d17af3ef0bf7cfb710ca74755a 
```
```terminal
php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
```terminal
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
```terminal
composer
```

3. Instalar laravel 
   Se dirige al directorio en donde se quiere crear
```terminal
composer create-project --prefer-dist laravel/laravel my_app
```
Estando en el directorio 
```terminal
php artisan serve
```

## Links:

[Instalación  laravel](https://noviello.it/es/como-instalar-laravel-en-ubuntu-20-04-lts/)
[Instalación Laravel 2](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04-es)
[Instalación Laravel 3](https://laravel.com/docs/9.x#getting-started-on-linux)

---

## php artisan make:model
Este comando es utilizado para generar un modelo en laravel
```php
php artisan make:model Client -mcr
```

``` ad-info
El -mcr es usado para que cree el modelo, la migración a la base de datos y el controlador.
```

---
## Migraciones
Las migraciones tienen dos partes de código:
1. up() = Se ejecuta cuando la migración está en funcionamiento
2. down() = Se ejecuta cuando la migración se debe reversar.
```php
public function up()
{
	Schema::create('clients', function (Blueprint $table) {
		$table->id();
		$table->string('name', 75);
		$table->integer('due')->default(0);
		$table->text('comments')->default(''); // Investigar por que no funciona el default  
		$table->timestamps();

	});
}
```
#InvDocumentación
``` ad-info
Se puede colocar caracteriticas propias de SQL con el uso de ->
	-> default() // Agregarle algo por default 
	-> nullable() // Que el atributo no sea nulo
```

```php
 php artisan migrate
```

``` ad-info
Este comando realizará todas las migraciones posibles.
```


---
## Protected - Model
El portected le indica a laravel que esas variables no recibirán cargas de forma masiva. #InvDocumentación
- [ ] #task ¿Para que funciona HasFactory? 🔼 
- [ ] #task ¿Para que funciona protected laravel? 


¿Para que sirve HasFactory ? #InvDocumentación - [ ]
```PHP
class Client extends Model
{
	use HasFactory;
	protected $fillable = ['name', 'due', 'comments']; // Protejidas [No carga de forma masiva]
}
```
---
## Vistas
Las vistas en Laravel se manejan a través de de la extensión .blade
nombreVista.blade.php 

``` ad-tip
Es importate crear plantillas para menejar las vistas, optimiza tu código.
```

Las directivas en blade se manejan así:

```HTML
{{ -- @yield('name') -- }}
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>
	<body>
	
	@yield('content')
	
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	</body>

</html>
```

``` ad-info
El lugar donde se coloque el @yield('name') será el predispuesto para agregar contenido a la página.
```

Lo que se realizó anteriormente fue  crear una plantilla de inicio y esta será implementada en el index de laravel a modo de ejemplo:

```HTML
@extends('theme.base')

@section('content')
	<div class="container py-5">
		<h1 class="text-center"> Hola Mundo! </h1>
	</div>
@endsection
```

``` ad-info
title: @extends 
Es usado para indicarle de donde debe tomar la plantilla
```

``` ad-info
title: @section    
Este hace referencia al @yield que se creo en la platilla y es usado para introducir nuevo contenido a la página base.
```

---

## Controlador

```PHP
//
```
---
