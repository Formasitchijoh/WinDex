<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;

Route::apiResource('brands', BrandController::class);