<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class);
Route::get('/search', \App\Livewire\Search::class);
Route::get('/search/history', \App\Livewire\History::class);
Route::get('/upload', \App\Livewire\Upload::class);
Route::view('/take', 'livewire/take');
Route::get('/book/{image_name}', \App\Livewire\Book::class);
