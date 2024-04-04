<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
<<<<<<< Updated upstream
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
=======
>>>>>>> Stashed changes

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

<<<<<<< Updated upstream
Route::get('/', [PokemonController::class, 'index'])->name('posts.index');

Route::get('/teams', [PokemonTeamController::class, 'index'])->name('team.index');
    
Route::get('/pokemons/{pokemon_name}', [PokemonBuildController::class, 'index'])->name('pokemon.builder');

Route::get('/myteam', [MyTeamController::class, 'index'])->name('myteam.index');

Route::get('/medal', [MedalController::class, 'index'])->name('medal.index');
=======
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
>>>>>>> Stashed changes
