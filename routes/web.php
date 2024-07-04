<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Home::class)->name('home');
Route::get('/search', \App\Livewire\Book\Search::class)->name('search');
Route::get('/search/result/{id}', \App\Livewire\Book\Result::class)->name('search.result');
Route::get('/search/history', \App\Livewire\Book\History::class)->name('search.history');
Route::get('/search/{image_name}', \App\Livewire\Book\Detail::class)->name('search.detail');

Route::middleware('guest')->group(function (){
    Route::get('/admin/login', \App\Livewire\Auth\Login::class)->name('login');
});

Route::middleware('auth')->group(function (){
    Route::get('/admin', \App\Livewire\Admin\Home::class)->name('admin.home');
    Route::get('/admin/book', \App\Livewire\Admin\Book\Index::class)->name('admin.book.index');
    Route::get('/admin/book/create', \App\Livewire\Admin\Book\Create::class)->name('admin.book.create');
    Route::get('/admin/book/{id}/edit', \App\Livewire\Admin\Book\Edit::class)->name('admin.book.edit');
    Route::get('/admin/logout', function () {
        auth()->logout();
        return redirect()->route('home');
    })->name('admin.logout');
});
