<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\PokemonBuildController;
use App\Http\Controllers\PokemonTeamController;
use App\Http\Controllers\MyTeamController;
use App\Http\Controllers\MedalController;
use App\Http\Controllers\MedalGroupController;
use App\Http\Controllers\PokemonItemController;
use App\Http\Controllers\ItemGroupController;
use App\Http\Controllers\ItemGroupMedalGroupController;
use App\Http\Controllers\PokemonMedalController;
use App\Http\Controllers\UserPokemonController;

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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/myteam', [MyTeamController::class, 'index'])->name('myteam.index');

});

require __DIR__.'/auth.php';
Route::get('/', [PokemonController::class, 'index'])->name('posts.index');

Route::get('/teams', [PokemonTeamController::class, 'index'])->name('team.index');
    
Route::get('/pokemons/{pokemon_name}', [PokemonBuildController::class, 'index'])->name('pokemon.builder');

Route::get('/medal/team', [MedalGroupController::class, 'index'])->name('medalgroup.index');

Route::post('/medal', [MedalController::class, 'store'])->name('medal.store');

Route::get('/medal', [MedalController::class, 'index'])->name('medal.index');

Route::post('/pokemons/{pokemon_name}/attach-items', [PokemonItemController::class, 'attachItems'])->name('pokemon.attach-items');

Route::delete('/medals/{medal}', [MedalController::class, 'destroy'])->name('medal.destroy');

Route::get('/medals/{medal}', [MedalController::class, 'show'])->name('medal.show');

Route::post('/teams/save', [PokemonTeamController::class, 'store'])->name('team.save')->middleware('auth');

Route::post('/item-group-medal-groups', [ItemGroupMedalGroupController::class, 'store'])->name('item-group-medal-group.store');

Route::post('/user-pokemons', [UserPokemonController::class, 'store'])->name('user-pokemons.store');

Route::delete('/myteam/{id}', [MyTeamController::class, 'destroy'])->name('myteam.destroy');

Route::delete('/item-groups/{id}', [ItemGroupController::class, 'destroy'])->name('itemGroups.destroy');

Route::post('/myteam/update-level/{userPokemonId}', [MyTeamController::class, 'updateLevel'])->name('myteam.updateLevel');
