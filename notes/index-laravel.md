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
Versión laravel 
~~~PHP
php artisan --version
~~~

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
Tipos de datos que manejan las migraciones:
[Tipos de columnas disponibles](https://laravel.com/docs/9.x/migrations#available-column-types)

El nombre correcto para crear una migración debe ser:
~~~ ad-tip
title: create migration 
create_names_table 
~~~
### Agregar columnas a tablas
El nombre correcto para agregar una columna a una tabla a través de una migración es:
~~~ ad-tip
title: add column 
php artisan make:migration add_name_columna_to_names_table
(names) = Nombre de la tabla a donde se desea agregar
~~~
Quedando de la siguiente forma, en Schema::table hace referencia a un cambio en la tabla.
~~~PHP
Schema::table('payments', function (Blueprint $table) {
    $table->unsignedBigInteger('user_id')->after('id');

    $table->foreign('user_id')->references('id')->on('users');
});
~~~

Ahora si queremos eliminar esta migración se debe poner así: 
~~~PHP
Schema::table('payments', function (Blueprint $table) {  
    $table->dropForeign('billings_user_id_foreign'); // Eliminamos lallave  
    $table->dropColumn('user_id');  // Eliminamos la columna
});
~~~

[Video de explicación](https://www.youtube.com/watch?v=igyDtDBecns&list=PLd3a4dr8oUsDAjQa8T0eKSyOxUCoiMVxO&index=20)
[Documentación](https://laravel.com/docs/9.x/migrations#foreign-key-constraints)
### Modificar columnas ya creadas
En primer lugar se debe instalar en el proyecto:
~~~PHP
composer require doctrine/dbal
~~~

~~~ ad-tip
title: updated column
php artisan make:migration update_name_to_users_table
~~~
De esta forma se cambiaria la columna name a una cantidad maxima de 70 caracteres.
~~~PHP
Schema::table('users', function (Blueprint $table) {  
    $table->string('name', 70)->change();  
});
~~~
Y en su función de rollback se pondria la cantidad que se tenia en un inicio, para poder volver en caso de que se requiera:
~~~PHP
Schema::table('users', function (Blueprint $table) {  
    $table->string('name', 60)->change();  
});
~~~

[Documentación](https://laravel.com/docs/9.x/migrations#updating-column-attributes)

---
## Model
Aunque el nombre del modelo sea en mayúscula y singular, laravel va a trabajar con el nombre de la tabla en minúscula y plural.
~~~ ad-tip
title: name model 
User = users 
Post = posts
Client = clients

El nombre de los modelos nunca deben ser verbos
~~~
Si se desea trabajar con otra tabla y de plano ignorar el estándar de laravel se definiría así:
~~~PHP
protected  $table = "Nombre de la tabla";
~~~
[Documentación modelos](https://laravel.com/docs/9.x/eloquent#generating-model-classes)
El protected le indica a laravel que esas variables no recibirán cargas de forma masiva. #InvDocumentación
- [ ] #task ¿Para que funciona HasFactory? 🔼 
- [ ] #task ¿Para que funciona protected laravel? 

HasFactory nos permite crear datos para insertar en la base de datos de una forma mas rápida. 

```PHP
class Client extends Model
{
	use HasFactory;
	protected $fillable = ['name', 'due', 'comments']; // Protejidas [No carga de forma masiva]
}
```

Atributos que son ocultos para los Arrays, no se desea retornarlos:
~~~PHP
/**  
 * The attributes that should be hidden for serialization. 
 * 
 * 
 * @var array<int, string>  
 */
 protected $hidden = [  
    'password',  
    'remember_token',  
];
~~~

casteos: El tipo de datos que los atributos deben tener
ptda: No entiendo muy bien la función.
~~~PHP
protected $casts = [  
    'email_verified_at' => 'datetime',  
];
~~~
### Llave foránea
~~~PHP
Schema::create('billings', function (Blueprint $table) {  
    $table->id();  
    $table->unsignedBigInteger('user_id');  
    $table->double('value')->default(0);  
    $table->text('details');  
    $table->timestamps();  
  
    $table->foreign('user_id')->references('id')->on('users');  
   // $table->foreignId('user_id')->constrained()->onDelete('cascade');  
});
~~~

¿Para que sirve HasFactory ? #InvDocumentación - [ ]
### Factories
Para crear las factories es:
~~~PHP
php artisan make:factory NameFactory
~~~

Las factories son utilizadas para definir la labor que realizará el seeds, definiendo de forma precisa cuales son los campos que se deben de cargan en la tabla.

~~~PHP
public function definition()  
{  
    return [  
        'name' => $this->faker->name(),  
        'document' => $this->faker->unique()->buildingNumber(),  
        'surname' => $this->faker->lastName(),  
        'email' => $this->faker->unique()->safeEmail(),  
        'email_verified_at' => now(),  
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password  
        'remember_token' => Str::random(10),  
        'billing_id' => Billing::factory()  
    ];  
}
~~~

~~~ ad-note
title: Billing::factory()
Esa linea de código le indica a los factories que debe crear un registro de tipo Billing por cada usuario que se cree.
~~~
[Documentación factories](https://laravel.com/docs/9.x/database-testing#defining-model-factories)
### Seeds
Se utiliza para realizar un registro de datos falsos en la base de datos en su momento de desarrollo para realizar pruebas o en un entorno de producción para insertar información relevante de países, códigos postales, etc.

~~~PHP
// Ruta: seeders DatabaseSeeders
public function run()  
{  
     // User::factory(10)->create();  
     $this->call([
	     PostSeeder::class,
     ])
}
~~~

~~~ ad-note
title: Seeds Run
Es aqui donde se hace uso de los factories en ejecución con el Seeders, se crearan 10 registros del modelo/tabla usuarios.

De igual forma al ejecutar el call se llama a todos los seeders que se requieran.
~~~
Para ejecutar la seeders es con el comando 
~~~PHP
php artisan db:seed
~~~
Si se desea refrescar las migraciones y al unisono cargar los seeders, se utilizara el siguiente comando:

~~~PHP
php artisan migrate:fresh --seed
~~~

[Documentación Seeders](https://laravel.com/docs/9.x/seeding#main-content)
[Video seeds  y factories](https://www.youtube.com/watch?v=mBzISfcAul4&list=PLd3a4dr8oUsDAjQa8T0eKSyOxUCoiMVxO&index=22) 

### Relaciones
Los nombres de las relacioness que se generan en los modelos, por estándar debe sere dependiendo de su relación:

~~~PHP
// Si un usuario puede tener varios posts, entonces:
public function posts () // Nombre en base a relación  
{  
    return $this->hasMany(Post::class); // 
}
// Si un usuario puede tener varios pagos, entonces:
public function bills () // Nombre en base a relación  
{  
    return $this->hasMany(Billing::class);  
}
// Si un pago/post solo lo puede tener un usuario, entonces:
public function user()  
{  
    return $this->hasOne(User::class);  
    // hasOne - belongsTo  
}
~~~

[Video relaciones](https://www.youtube.com/watch?v=lhHf9RvISXM&list=PLd3a4dr8oUsDAjQa8T0eKSyOxUCoiMVxO&index=23)
[Documentación relaciones](https://laravel.com/docs/9.x/eloquent-relationships#main-content)

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
## index 
La función index es utilizada cuando se accede por primera vez a una ruta que contenga este controlador.
~~~PHP
public function index(){  
    $clients = Client::paginate(5);  
    return view('client.index')  
        ->with('clients', $clients);  
}
~~~

~~~ ad-note
title: with
Esta es una forma de pasarle variables desde un controlador a una vista, no es necesario el $ para hacer el llamado a la variable.
~~~
~~~PHP
public function index(string $name): string{  
    return view('client.index', compact('name'))
}
~~~
~~~ ad-note
title: compact
Esta es una forma de pasarle variables desde un controlador a una vista 
~~~
### Create - store
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

- [ ] #task Diferencia entre response/request
## Sistema de autenticación de laravel
