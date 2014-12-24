<?php

/*
|------------------------------
| Public route
|------------------------------
*/
Route::get('/', function () {
    return Redirect::route('cpanel.setting.create');
});

/*
|------------------------------
| Cpanel group route
|------------------------------
*/
Route::group(['prefix' => 'cpanel', 'namespace' => 'Rabbit\Cpanel'], function () {
    /*
    |------------------------------
    | Filter Auth
    |------------------------------
    */
    Route::group(['before' => 'auth.cpanel|setting.cpanel|permission.cpanel'], function () {
        // User
        Route::resource('user', 'UserController');
        // Company
        Route::resource('company', 'CompanyController', ['only' => ['edit', 'update']]);
        // Branch
        Route::resource('branch', 'BranchController');
        // Group
        Route::resource('group', 'GroupController');
        // Exchange
        Route::resource('exchange', 'ExchangeController');

        // Backup
        Route::get('backup', ['as' => 'cpanel.backup.create', 'uses' => 'BackupRestoreController@createBackup']);
        Route::post('backup', ['as' => 'cpanel.backup.store', 'uses' => 'BackupRestoreController@storeBackup']);
        // Restore
        Route::get('restore', ['as' => 'cpanel.restore.create', 'uses' => 'BackupRestoreController@createRestore']);
        Route::post('restore', ['as' => 'cpanel.restore.store', 'uses' => 'BackupRestoreController@storeRestore']);
    });

    /*
    |------------------------------------------
    | Filter home, profile (auth and group)
    |------------------------------------------
    */
    Route::group(['before' => 'auth.cpanel|setting.cpanel'], function () {
        // Home
        Route::get('home', ['as' => 'cpanel.home.index', 'uses' => 'HomeController@index']);
        // User profile
        Route::get('profile/edit', ['as' => 'cpanel.profile.edit', 'uses' => 'ProfileController@edit']);
        Route::put('profile/update', ['as' => 'cpanel.profile.update', 'uses' => 'ProfileController@update']);
    });

    /*
    |------------------------------------------
    | Filter setting form (auth)
    |------------------------------------------
    */
    Route::group(['before' => 'auth.cpanel'], function () {
        Route::get('setting', ['as' => 'cpanel.setting.create', 'uses' => 'SettingController@create']);
        Route::post('setting', ['as' => 'cpanel.setting.store', 'uses' => 'SettingController@store']);
    });

    /*
    |------------------------------------------
    | Filter Guest (Login and Logout)
    |------------------------------------------
    */
    // Login
    Route::group(['before' => 'guest.cpanel'], function () {
        Route::get('login', ['as' => 'cpanel.get_login', 'uses' => 'LoginController@getLogin']);
        Route::post('login', ['as' => 'cpanel.post_login', 'uses' => 'LoginController@postLogin']);
    });
    // Logout
    Route::group(['before' => 'auth.cpanel'], function () {
        Route::get('logout', ['as' => 'cpanel.logout', 'uses' => 'LoginController@logout']);
    });
});

/*
|----------------------------------------
| No filter route
|----------------------------------------
*/
Route::group(['prefix' => 'cpanel', 'namespace' => 'Rabbit\Cpanel'], function () {
    // User datatable
    Route::get('datatable/user', ['as' => 'cpanel.datatable.user', 'uses' => 'UserController@datatable']);
    // User validator
    Route::post('validator/user', ['as' => 'cpanel.validator.user', 'uses' => 'UserController@validator']);

    // Profile validator
    Route::post('validator/profile', ['as' => 'cpanel.validator.profile', 'uses' => 'ProfileController@validator']);

    // Branch datatable
    Route::get('datatable/branch', ['as' => 'cpanel.datatable.branch', 'uses' => 'BranchController@datatable']);
    // Branch validator
    Route::post('validator/branch', ['as' => 'cpanel.validator.branch', 'uses' => 'BranchController@validator']);

    // Group datatable
    Route::get('datatable/group', ['as' => 'cpanel.datatable.group', 'uses' => 'GroupController@datatable']);
    // Group validator
    Route::post('validator/group', ['as' => 'cpanel.validator.group', 'uses' => 'GroupController@validator']);
    // Group for package change
    Route::post('package_change/group', ['as' => 'cpanel.package_change.group', 'uses' => 'GroupController@packageChange']);

    // Exchange datatable
    Route::get('datatable/exchange', ['as' => 'cpanel.datatable.exchange', 'uses' => 'ExchangeController@datatable']);
    // Exchange validator
    Route::post('validator/exchange', ['as' => 'cpanel.validator.exchange', 'uses' => 'ExchangeController@validator']);
});

/*
|----------------------------------------
| Security Route
|----------------------------------------
*/
Route::get('security', ['as' => 'security', 'uses' => 'Rabbit\Cpanel\SecurityController@create']);
Route::post('security', ['as' => 'security', 'uses' => 'Rabbit\Cpanel\SecurityController@store']);

/*
|----------------------------------
| Generator routes
|----------------------------------
*/
Route::get('generator', ['as' => 'generator.bench.create', 'uses' => 'Rabbit\Cpanel\GeneratorController@getBench']);
Route::post('generator', ['as' => 'generator.bench.store', 'uses' => 'Rabbit\Cpanel\GeneratorController@postBench']);
Route::get('generator/scaffold', ['as' => 'generator.scaffold.create', 'uses' => 'Rabbit\Cpanel\GeneratorController@getScaffold']);
Route::post('generator/scaffold', ['as' => 'generator.scaffold.store', 'uses' => 'Rabbit\Cpanel\GeneratorController@postScaffold']);
