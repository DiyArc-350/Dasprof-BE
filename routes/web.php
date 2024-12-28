<?php

    use App\Http\Middleware\isAuthenticated;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\PhotoController;
    use App\Http\Controllers\CategoryController;

    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', [CategoryController::class, 'dashboard'])->name('dashboard');
        Route::get('/photo', [PhotoController::class, 'index'])->name('photo');
        Route::post('/photo', [PhotoController::class, 'store'])->name('add.photo');
        Route::post('/photo/update/{id}', [PhotoController::class, 'update'])->name('update.photo');
        Route::post('/photo/{id}', [PhotoController::class, 'destroy'])->name('delete.photo');

        Route::get('/category', [CategoryController::class, 'index'])->name('category');
        Route::post('/category', [CategoryController::class, 'store'])->name('add.category');
        Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
        Route::post('/category/{id}', [CategoryController::class, 'destroy'])->name('delete.category');
        Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    });


    Route::middleware('guest')->group(function(){
        Route::get('/', [AuthController::class, 'loginform'])->name('user.login.page');
        Route::get('/login', [AuthController::class, 'loginform'])->name('user.login.page2');
        Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    });
    Route::fallback(function () {
        return redirect()->route('user.login.page');
    })->middleware(isAuthenticated::class);
    // Route::post( '/register', [AuthController::class, 'register'])->name('user.regis');

