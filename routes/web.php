<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PokemonBuildController;
use App\Http\Controllers\PokemonTeamController;
use App\Http\Controllers\MyTeamController;
use App\Http\Controllers\MedalController;
// routes/web.php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
*/

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PokemonController::class, 'index'])->name('posts.index');

Route::get('/teams', [PokemonTeamController::class, 'index'])->name('team.index');
    
Route::get('/pokemons/{pokemon_name}', [PokemonBuildController::class, 'index'])->name('pokemon.builder');

Route::get('/myteam', [MyTeamController::class, 'index'])->name('myteam.index');

Route::get('/medal', [MedalController::class, 'index'])->name('medal.index');