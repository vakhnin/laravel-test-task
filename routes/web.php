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

Route::post('/town', function (Request $request) {
  $validator = Validator::make($request->all(), [
    'town' => 'required|max:255',
  ]);

  if ($validator->fails()) {
    return redirect('/')
      ->withInput()
      ->withErrors($validator);
  }

  $town = new App\Town;
  $town->town = $request->town;
  $town->save();

  return redirect('/');
});
