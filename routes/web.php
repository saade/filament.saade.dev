<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/login', '/register')->name('login');
