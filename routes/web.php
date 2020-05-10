<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', function () {
  $towns = App\Town::orderBy('created_at', 'asc')->get();

  return view('towns', [
    'towns' => $towns
  ]);
});

Route::post('/ajax',function (Request $request) {
  $validatedData = $request->validate([
    'town_name' => 'required|max:70',
    'town_population' => 'required|integer|min:0',
    'town_lat' => 'required|numeric|min:-90|max:90',
    'town_lon' => 'required|numeric|min:-180|max:180',
    ]);

  $town = new App\Town;
  $town->town = $request->town_name;
  $town->population = $request->town_population;
  $town->lat = $request->town_lat;
  $town->lon = $request->town_lon;
  $town->save();

  return response()->json(array('msg'=> $request->town_name), 200);
});
