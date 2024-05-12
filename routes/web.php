<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class);
Route::get('/search', \App\Livewire\Search::class);
Route::view('/take', 'livewire/take');
