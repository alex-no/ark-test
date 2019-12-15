<?php
use RonasIT\Support\AutoDoc\Http\Controllers\AutoDocController;


Route::get('/documentation', ['uses' => AutoDocController::class.'@documentation']);
Route::get('/{file}', ['uses' => AutoDocController::class.'@getFile']);
Route::get(config('docs.route'), ['uses' => AutoDocController::class.'@index']);