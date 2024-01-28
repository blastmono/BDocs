<?php

use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizacionController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LoginSecurityController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BandejaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TareasController;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\Mention\Mention;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['2fa','auth', 'verified'])->name('dashboard');

Route::get('/notifica/{titulo}/{mensaje}', function($titulo,$mensaje){
    event(new \App\Events\PublicMessage($titulo,$mensaje));
    dd('Mensaje publico ' .$titulo .'/' .$mensaje.'ha sido enviado');
})->middleware(['2fa','auth', 'verified']);

Route::get('/notifica-private/{titulo}/{mensaje}', function($titulo,$mensaje){
    event(new \App\Events\PrivateMessage(auth()->user(),$titulo,$mensaje));
    dd('Private event executed.');
})->middleware(['2fa','auth', 'verified']);

Route::middleware(['2fa','auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function () {
    Route::post('/profile/userPass', [PasswordController::class, 'update'])->name('password.update');
});

Route::middleware(['2fa','auth', 'verified'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/user/',[RegisteredUserController::class, 'create'])->name('users.create');
    Route::post('/user/create',[RegisteredUserController::class, 'store'])->name('users.store');
});

Route::resources([
    'roles'=> RoleController::class,
]);
Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/entrada',[BandejaController::class, 'index'])->name('bandeja.index');
    Route::get('/entrada/{id}/{dist?}',[BandejaController::class, 'show'])->name('bandeja.show');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/organizaciones',[OrganizacionController::class, 'index'])->name('organizacion.index');
    Route::get('/organizaciones/create',[OrganizacionController::class, 'create'])->name('organizacion.create');
    Route::post('/organizaciones/create',[OrganizacionController::class, 'store'])->name('organizacion.store');
    Route::get('/organizaciones/{organizacion}',[OrganizacionController::class, 'show'])->name('organizacion.show');
    Route::get('/organizaciones/{organizacion}/edit',[OrganizacionController::class, 'edit'])->name('organizacion.edit');
    Route::delete('/organizaciones/{organizacion}/delete',[OrganizacionController::class, 'destroy'])->name('organizacion.destroy');
});
Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/instituciones',[InstitucionController::class, 'index'])->name('institucion.index');
    Route::get('/instituciones/create',[InstitucionController::class, 'create'])->name('institucion.create');
    Route::post('/instituciones/create',[InstitucionController::class, 'store'])->name('institucion.store');
    Route::get('/instituciones/{institucion}',[InstitucionController::class, 'show'])->name('institucion.show');
    Route::get('/instituciones/{institucion}/edit',[InstitucionController::class, 'edit'])->name('institucion.edit');
    Route::delete('/instituciones/{institucion}/delete',[InstitucionController::class, 'destroy'])->name('institucion.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/materias',[MateriaController::class, 'index'])->name('materias.index');
    Route::get('/materias/create',[MateriaController::class, 'create'])->name('materias.create');
    Route::post('/materias/create',[MateriaController::class, 'store'])->name('materias.store');
    Route::get('/materias/{tipoMateria}',[MateriaController::class, 'show'])->name('materias.show');
    Route::get('/materias/{tipoMateria}/edit',[MateriaController::class, 'edit'])->name('materias.edit');
    Route::delete('/materias/{tipoMateria}/delete',[MateriaController::class, 'destroy'])->name('materias.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/estados',[EstadoController::class, 'index'])->name('estados.index');
    Route::get('/estados/create',[EstadoController::class, 'create'])->name('estados.create');
    Route::post('/estados/store',[EstadoController::class, 'store'])->name('estados.store');
    Route::get('/estados/{estado}',[EstadoController::class, 'show'])->name('estados.show');
    Route::get('/estados/{estado}/edit',[EstadoController::class, 'edit'])->name('estados.edit');
    Route::delete('/estados/{estado}/delete',[EstadoController::class, 'destroy'])->name('estados.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/documentos',[DocumentoController::class, 'index'])->name('documentos.index');
    Route::get('/bandeja/{id}',[DocumentoController::class, 'bandeja'])->name('documentos.bandeja');
    Route::get('/documentos/create',[DocumentoController::class, 'create'])->name('documentos.create');
    Route::post('/documentos/create',[DocumentoController::class, 'store'])->name('documentos.store');
    Route::get('documentos/{id}/{dist?}',[DocumentoController::class, 'show'])->name('documentos.show');
    Route::get('/documentos/{id}/edit',[DocumentoController::class, 'edit'])->name('documentos.edit');
    Route::delete('/documentos/delete/{id}',[DocumentoController::class, 'destroy'])->name('documentos.destroy');
    Route::get('/notificar',[DocumentoController::class, 'enviarNotificacion'])->name('notificacion');
    Route::post('/buscar',[DocumentoController::class, 'buscar'])->name('documentos.buscar');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/distribucion',[DistribucionController::class, 'index'])->name('distribuciones.index');
    Route::get('/distribucion/enviar/{id_doc}',[DistribucionController::class, 'create'])->name('distribuciones.create');
    Route::post('/distribucion/create',[DistribucionController::class, 'store'])->name('distribuciones.store');
    Route::get('distribucion/{id}',[DistribucionController::class, 'show'])->name('distribuciones.show');
    Route::get('/distribucion/{id}/edit',[DistribucionController::class, 'edit'])->name('distribuciones.edit');
    Route::delete('/distribucion/{id}/delete',[DistribucionController::class, 'destroy'])->name('distribuciones.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/kardex',[KardexController::class, 'index'])->name('kardex.index');
    Route::get('/kardex/entrante',[KardexController::class, 'entrada'])->name('kardex.entrada');
    Route::get('/kardex/salidos',[KardexController::class, 'salida'])->name('kardex.salida');
    Route::get('/kardex/enviar',[KardexController::class, 'create'])->name('kardex.create');
    Route::post('/kardex/create',[KardexController::class, 'store'])->name('kardex.store');
    Route::get('kardex/{id}',[KardexController::class, 'show'])->name('kardex.show');
    Route::get('kardexs/',[KardexController::class, 'todo'])->name('kardex.todo');
    Route::get('/kardex/{id}/edit',[KardexController::class, 'edit'])->name('kardex.edit');
    Route::delete('/kardex/{id}/delete',[KardexController::class, 'destroy'])->name('kardex.destroy');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/tareas',[TareasController::class, 'index'])->name('tareas.index');
    Route::post('/tarea/cumple/{id}',[TareasController::class, 'cumple'])->name('tareas.cumple');
});

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/auditoria',[AuditoriaController::class, 'index'])->name('auditorias.index');
});

Route::group(['prefix'=>'2fa'], function(){
    Route::get('/',[LoginSecurityController::class, 'show2faForm']);
    Route::post('/generateSecret',[LoginSecurityController::class, 'generate2faSecret'])->name('generate2faSecret');
    Route::post('/enable2fa',[LoginSecurityController::class, 'enable2fa'])->name('enable2fa');
    Route::post('/disable2fa',[LoginSecurityController::class, 'disable2fa'])->name('disable2fa');

    // 2fa middleware
    Route::post('/2faVerify', function () {
        return redirect(URL()->previous());
    })->name('2faVerify')->middleware('2fa');
});

// test middleware
Route::get('/test_middleware', function () {
    return "2FA middleware work!";
})->middleware(['auth', '2fa']);

Route::get('/generaDoc',[PDFController::class, 'generatePDF']);

Route::middleware(['2fa','auth', 'verified'])->group(function(){
    Route::get('/calendario',[CalendarioController::class, 'index'])->name('calendario.index');
    Route::get('/calendario/{month}',[CalendarioController::class, 'index_month']);
});

Route::middleware(['2fa','auth','verified'])->group(function(){
    Route::get('/anuncios',[AnuncioController::class, 'index'])->name('anuncios.index');
    Route::get('/anuncios/org',[AnuncioController::class, 'anuncios_organizacion'])->name('anuncios.organizacion');
    Route::get('/anuncios/usr',[AnuncioController::class, 'anuncios_usuario'])->name('anuncios.usuarios');
    Route::get('/anuncios/nuevo',[AnuncioController::class, 'create'])->name('anuncios.create');
    Route::post('/anuncios/create',[AnuncioController::class, 'store'])->name('anuncios.store');
    Route::get('anuncios/{id}',[AnuncioController::class, 'show'])->name('anuncios.show');
    Route::delete('/anuncios/{id}/delete',[AnuncioController::class, 'destroy'])->name('anuncios.destroy');
});


require __DIR__.'/auth.php';

/*
| GET|HEAD  | tes/keren              | keren.index   | App\Http\Controllers\TesController@index   | web          |
| POST      | tes/keren              | keren.store   | App\Http\Controllers\TesController@store   | web          |
| GET|HEAD  | tes/keren/create       | keren.create  | App\Http\Controllers\TesController@create  | web          |
| GET|HEAD  | tes/keren/{keren}      | keren.show    | App\Http\Controllers\TesController@show    | web          |
| PUT|PATCH | tes/keren/{keren}      | keren.update  | App\Http\Controllers\TesController@update  | web          |
| DELETE    | tes/keren/{keren}      | keren.destroy | App\Http\Controllers\TesController@destroy | web          |
| GET|HEAD  | tes/keren/{keren}/edit | keren.edit    | App\Http\Controllers\TesController@edit    | web          |
*/