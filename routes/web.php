<?php

use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Users;
use App\Livewire\Contacts;
use App\Livewire\Counter;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/counter', Counter::class);
Route::get('/users', Users::class)->name('users');
Route::get('/about', About::class)->name('about');
Route::get('/contacts', Contacts::class)->name('contacts');
