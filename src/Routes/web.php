<?php
// setup script to build db and initial seed
Route::group([
    'namespace'  => 'Southcoastweb\AdminUI\Setup',
    'middleware' => ['web'],
    'prefix'     => 'adminui'
], function() {
    Route::get('setup', 'SetupController@index');
    Route::post('setup', 'SetupController@store')->name('adminui.setup.store');
    Route::get('setupjs', 'SetupController@buildJs');
    Route::get('display', 'SetupController@display');
});

// Front and backend routes
Route::group([
    'namespace' => 'Southcoastweb\AdminUI\Controllers',
    'middleware' => ['web'],
], function() {
    // functions required by front or backend
    // clear cache from front end or back end
    Route::get('cache-clear', 'CacheClear\CacheClearController@index')->name('cache.clear');
    // view media
    Route::get('media/{encId}/{size?}/{name?}', 'Media\MediaViewController@view')->name('media.view');

    Route::post('media/editor-upload', 'Media\MediaUploadController@uploadEditor');
    Route::post('media/editor-delete', 'Media\MediaUploadController@remove');
});

// Ajax routes
Route::group([
    'namespace' => 'Southcoastweb\AdminUI\Controllers',
    'middleware' => ['web', 'adminAuth']
], function() {
    Route::post('admin/suspend', 'Suspend\SuspendController@index')
        ->name('admin.suspend');

    Route::post('admin/delete', 'Suspend\SuspendController@delete')
        ->name('admin.delete');

    Route::post('admin/mark-as-read', 'Notification\NotificationController@read')
        ->name('admin.notification.read');
});

// All ROutes
Route::group([
    'prefix'     => config('adminui.prefix'),
], function() {
    // Authentication Routes...
    Route::group([
        'middleware' => ['web', 'adminGuest'],
        'namespace'  => 'Southcoastweb\AdminUI\Controllers\Login',
    ], function() {
        Route::get('login', 'AdminLoginController@showLogin')->name('admin.login');
        Route::post('login', 'AdminLoginController@login');

        // Password Reset Routes...
        Route::get('password/reset', 'AdminForgotPasswordController@showRequest')->name('admin.password.reset'); //show request reset form
        Route::post('password/email', 'AdminForgotPasswordController@sendResetLink')->name('admin.password.email');  // send reset email
        Route::get('password/reset/{token}', 'AdminResetController@showReset')->name('admin.password.reset.token'); // show reset form
        Route::post('password/reset', 'AdminResetController@reset')->name('admin.password.reset.update'); // apply new password
    });


    // Dashboard        
    Route::get('', 'App\Http\Controllers\Admin\Dashboard\DashboardController@index')
        ->middleware(['web', 'adminAuth'])
        ->name('admin.home');

    // all routes are hidden behind auth
    Route::group([
        'middleware' => ['web', 'adminAuth'],
        'namespace'  => 'Southcoastweb\AdminUI\Controllers',
        'as' => 'admin.'
    ], function() {
        // Admin Accounts
        Route::get('admin/{page?}', 'Admin\AdminController@index')->name('admin.index');
        Route::get('admin/edit/{id}', 'Admin\AdminController@edit')->name('admin.edit');
        Route::put('admin/edit', 'Admin\AdminController@update')->name('admin.update');
        Route::get('admin/add', 'Admin\AdminController@create')->name('admin.create');
        Route::post('admin/add', 'Admin\AdminController@store')->name('admin.store');
        Route::post('admin/choose', 'Admin\AdminController@choose')->name('admin.choose');


        // blog categories
        Route::get('blog/categories', 'Blog\BlogCategoryController@index')->name('blog.category.index');
        Route::get('blog/categories/create', 'Blog\BlogCategoryController@create')->name('blog.category.create');
        Route::post('blog/categories/store', 'Blog\BlogCategoryController@store')->name('blog.category.store');
        Route::get('blog/categories/edit/{blogCategory}', 'Blog\BlogCategoryController@edit')->name('blog.category.edit');
        Route::post('blog/categories/update/{blogCategory}', 'Blog\BlogCategoryController@update')->name('blog.category.update');
        
        // blog stuff
        Route::get('blog/{page?}', 'Blog\BlogController@index')->name('blog.index');
        Route::get('blog/edit/{blog}', 'Blog\BlogController@edit')->name('blog.edit');
        Route::get('blog/create', 'Blog\BlogController@create')->name('blog.create');
        Route::post('blog/store', 'Blog\BlogController@store')->name('blog.store');
        Route::post('blog/update', 'Blog\BlogController@update')->name('blog.update');

        // Media Library
        Route::get('media', 'Media\MediaController@index')->name('media.index');
        Route::post('media', 'Media\MediaUploadController@upload')->name('media.store');

        Route::post('media/ajax/load-folders', 'Media\MediaController@folders');
        Route::post('media/ajax/load-sidebar-folders', 'Media\MediaController@sidebarFolders');
        Route::post('media/ajax/folder-store', 'Media\MediaController@folderStore');
        Route::post('media/ajax/load-files', 'Media\MediaController@files');
        Route::post('media/ajax/load-sidebar-files', 'Media\MediaController@sidebarFiles');
        Route::post('media/ajax/media-picker', 'Media\MediaController@mediaComponent');

        // PageBuilder
        Route::post('pagebuilder/add-row', 'PageBuilder\PageBuilderController@addRow');

        // notifications
        Route::get('notifications', 'Notification\NotificationController@index')->name('notification.index');

        // Config
        Route::get('configuration', 'Configuration\ConfigurationController@index')->name('configuration.index');
        Route::post('configuration/store', 'Configuration\ConfigurationController@store')->name('configuration.store');
        Route::post('configuration/update', 'Configuration\ConfigurationController@update')->name('configuration.update');

        // Backup
        Route::get('backup', 'Backup\BackupController@index')->name('backup.index');
        Route::get('backup/create/{table}', 'Backup\BackupController@create')->name('backup.create');

        // Roles
        Route::get('permissions', 'Permission\PermissionController@index')->name('permission.index');
        Route::post('permissions', 'Permission\PermissionController@store')->name('permission.store');

        // Logout
        Route::get('logout', 'Logout\AdminLogoutController@index')->name('logout');

        // Filters
        Route::post('filter', 'Filter\FilterController@index')->name('filter');
        Route::get('filter/clear/{method}', 'Filter\FilterController@clearFilter')->name('filter.clear');
        Route::get('filter/status/{method}/{status?}', 'Filter\FilterController@statusFilter')->name('filter.status');
    });
});

