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
### Create
Desde un controlador se pueden validar los datos enviados, adicionalmente del Frontend
```PHP
public function store(Request $request)
{
	$request->validate([
		'name' => 'required|max:15',
		'due' => 'required|gte:50'
	]); // Validar con la documentacion

	$client = Client::create($request->only('name', 'due', 'comments')); // Only solo para que se envien los datos que se necesitan
	Session::flash('mensaje','Registro creado con exito');
	return redirect()->route('client.index');

}
```

Para realizar el Insert en la base de datos en este caso se utiliza el create y se envia desde la función only para que solo tenga en cuenta esos datos. 

### Update
Desde la vista se vería así, la cual valida que exista la varible client, en caso positivo realiza el form como post pero el metodo put es modificado.
~~~ HTML
@if (isset($client))
	<form action="{{ route('client.update', $client ) }}" method="POST">
	@method('PUT') {{-- HTML solo permite los metodos de post & get. laravel a traves de este modificador permite cambiar esto y enviar un metodo put--}}
@else
	<form action="{{ route('client.store') }}" method="POST">
@endif
~~~

Ahora si se desea actualizar un dato de forma individual en vez de masiva
```PHP
public function update(Request $request, Client $client)
{
	$request->validate([
		'name' => 'required|max:15',
		'due' => 'required|gte:50'
	]); // Validar con la documentacion

	$client->name = $request['name'];
	$client->due = $request['due'];
	$client->comments = $request['comments'];
	$client->save(); // Almacena en la base de datos
	
	Session::flash('mensaje','Registro creado con exito');
	return redirect()->route('client.index');

}
```

### Destroy
``` ad-tip
title: Destroy
Cuando se envia una función de destroy desde un boton se deben enviar a traves de un formulario.
```
~~~HTML
<form action="{{ route('client.destroy', $client) }}" method="post" class="d-inline"> {{--Se pone inline para que lo deje sobre la misma linea, ya que form es en bloque--}}
	@method('DELETE')
	@csrf
	<button type="submit" class="btn btn-danger" onclick="return confirm('¿Estas seguro de eliminar este cliente?')">Eliminar</button>
</form>
~~~

```PHP
public function destroy(Client $client)
{
	$client->delete();
	
	Session::flash('mensaje', 'Registro eliminado con éxito');
	return redirect()->route('client.index');

}
```
---
## Routes
Te permiten entrar en laravel y llamar a un recurso de tu interes.
Para listar las rutas que están disponibles en el aplicativo, en la ruta que se encuentre almacenado.
```PHP
php artisan route:list
```

Las rutas para ejecutar las páginas es el archivo router/web.php 
Estas rutas utilizan verbos http
[Métodos de petición http](https://developer.mozilla.org/es/docs/Web/HTTP/Methods)
En este caso se evidencia el uso de la fachada Route con un verbo http de GET, el cual al ingresar a esta ruta retornará la vista de resources/views/welcome.blade.php

~~~ PHP
Route::get('/', function () {  
    return view('welcome');  
});
~~~

Variables en rutas:

~~~PHP
Route::get('/hola/{name}', function (string $name) {  
    return "Hola {$name}";  
});
~~~



---
## Variable de sesión
Son utilizadas para enviar mensajes en este caso hacia una vista 
```PHP
use Illuminate\Support\Facades\Session;
Session::flash('mensaje','Registro creado con exito');
```

La vista (index.blade.php) se vería así:

```html
@extends('theme.base')
@section('content')
	<div class="container py-5 text-center">
	
		<h1> Listado de clientes </h1>
		<a href="{{ route('client.create') }}" class="btn btn-primary">Crear clientes</a>

		@if (Session::has('mensaje'))
			<div class="alert alert-info my-5">
				{{Session::get('mensaje')}}
			</div>
		@endif
		<table class="table">
			<thead>
				<tr>
					<th>Nombre</th>
					<th>Saldo</th>
					<th>Acciones</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td scope="row">FelinoHost</td>
					<td> 0.0 </td>
					<td>Editar - Eliminar</td>
				</tr>
				<tr>
					<td scope="row"> </td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>
@endsection
```

``` ad-info
title: @Session  
Evalua que exista una variable de session llamada mensaje, al encontrarla imprime en un div, el valor que contenga dicha variable.
```
---
## Bootstrappers
Estos actuan directamente en el kernel del enrrutamiento o kernel de requires:
Modo de funcionamiento:
1. Carga las variables de entorno
2. Carga la confuguración
3. Gestiona las excepciones
4. Registra "fachadas": Las fachadas utilizan métodos callStatic, simula la llamada a métodos estáticos sin que realmente estos sean estáticos. (Route, Response, Session, Require); Evita estar creando instancias a cada rato.
5. Registra los providers: 
6. Bootea los providers 

Para que laravel funcione, tiene que ejecutar lo anterior y en ese orden.

---