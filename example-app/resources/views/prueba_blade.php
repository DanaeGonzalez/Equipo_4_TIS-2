<?php
use illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
});
