<?php

use App\Http\Controllers\AccueilController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;



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

// Route::get('/', function () {
//     return view('accueil');
// });

// Page accueil
Route::get('/',[AccueilController::class,'index']);

//Menu
Route::get('/voirMenu/{menu}',[AccueilController::class,'show'])->name('voirMenu');
Route::get('/voirMenuShow/{menu}',[AccueilController::class,'showMenu'])->name('voirMenuShow');

//Ajout consommation
Route::post('add-consommation',[RestaurantController::class,'addConso'])->name('add-conso');
//delete consommation
Route::get('delete-consommation/{conso}',[RestaurantController::class,'deleteConso'])->name('delete-conso');
//update consommation
Route::put('update-conso/{conso}',[RestaurantController::class,'updateConso'])->name('update-conso');

//Ajout option consommation
Route::post('addOption-consommation',[RestaurantController::class,'addOptionConso'])->name('addOption-conso');
//delete option consommation
Route::get('delete-optionConsommation/{option}',[RestaurantController::class,'deleteOptionConso'])->name('delete-option');
// statut menu disponible ou en rupture
Route::put('active-conso/{conso}',[RestaurantController::class,'makeactive'])->name('active.conso');
Route::put('unactive-conso/{conso}',[RestaurantController::class,'makeunactive'])->name('unactive.conso');
//Ajout Categorie
Route::post('add/categorie',[RestaurantController::class,'addCategorieConso'])->name('addCat');
//delete categorie
Route::get('delete-categorie/{cat}',[RestaurantController::class,'deleteCat'])->name('delete-cat');
//update categorie
Route::put('update-categorie/{cat}',[RestaurantController::class,'updateCat'])->name('update-cat');
Route::get('edit-categorie/{cat}',[RestaurantController::class,'editCat'])->name('edit-cat');
//update option conso
Route::put('update-option/{option}',[RestaurantController::class,'updateOptionConso'])->name('update-option');
Route::get('edit-option/{option}',[RestaurantController::class,'editOptionConso'])->name('edit-option');

// Mon compte profile enseigne
Route::get('/mon-compte/{user}/edit',[RestaurantController::class,'edit'])->name('moncompte');
Route::patch('/mon-compte/{user}/update',[RestaurantController::class, 'update'])->name('restaurant.updateCompte');

// Mon compte profile client
Route::get('/mon-compte-client/{user}/edit',[ClientController::class,'edit'])->name('moncompteClient');
Route::patch('/mon-compte-client/{user}/update',[ClientController::class, 'update'])->name('client.updateCompte');

//Auth
Route::post('/add-client',[ClientController::class,'store'])->name('client.store');
Route::get('/home/client',[ClientController::class,'homeClient'])->name('homeClient');
Route::post('/connexion',[LoginController::class,'addLogin'])->name('login.addLogin');

Route::post('/add-restaurant',[RestaurantController::class,'store'])->name('restaurant.store');
Route::get('/home/restaurant',[RestaurantController::class,'homeRestaurant'])->name('accueilRestaurant');

// Verification Compte client
Route::get('/verification/{verification}',[ClientController::class, 'verify'])->name('verification_user');

// Verification compte restaurant par un admin
Route::get('/admin',[AdminController::class,'admin']);
Route::get('approved/{user}',[AdminController::class,'approved'])->name('approved');
Route::get('search-automatic/{id}',[RestaurantController::class,'searchAutomatic']);
Route::get('search',[RestaurantController::class,'search']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
