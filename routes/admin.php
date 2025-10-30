<?php

    use App\Http\Controllers\Admin\Auth\LoginController;
    use App\Http\Controllers\Admin\AdminController;
    use App\Http\Controllers\Admin\CompanyController;
    use App\Http\Controllers\Admin\EmployeeController;



    Route::group(['prefix' => 'admin'], function () {
        Route::get('/login', [LoginController::class, 'create'])->name('admin.login');

        Route::post('/login', [LoginController::class, 'store'])->name('admin.store');
        
        Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');

    });
    Route::middleware('auth:admin')->prefix('admin')->group(function () {

        Route::get('/index', [AdminController::class, 'index'])->name('admin.index');

        Route::group(['prefix' => 'companies'], function () {
            Route::get('/index', [CompanyController::class, 'index'])->name('admin.companies.index');
            Route::get('/create', [CompanyController::class, 'create'])->name('admin.companies.create');
            Route::post('/store', [CompanyController::class, 'store'])->name('admin.companies.store');
            Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('admin.companies.edit');
            Route::put('/update/{id}', [CompanyController::class, 'update'])->name('admin.companies.update');
            Route::delete('/delete/{id}', [CompanyController::class, 'destroy'])->name('admin.companies.delete');





        });
        Route::group(['prefix' => 'employees'], function () {
            Route::get('/index', [EmployeeController::class, 'index'])->name('admin.employees.index');
            Route::get('/create', [EmployeeController::class, 'create'])->name('admin.employees.create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('admin.employees.store');
            Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employees.edit');
            Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('admin.employees.update');
            Route::delete('/delete/{id}', [EmployeeController::class, 'destroy'])->name('admin.employees.delete');





        });
    });

  ?>