<?php

Route::group(['middleware' => ['web', 'admin'], 'prefix' => config('app.admin_url')], function () {
    Route::prefix('sales')->group(function () {
        /**
         * Reports routes.
         */

        Route::get('/reports', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.index'
        ])->name('admin.reports.index');

        Route::post('/reports/generate', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@generate')->name('admin.reports.generate');


        Route::get('/reports/invoiced', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.invoiced'
        ])->name('admin.reports.invoiced');


        Route::get('/reports/shipping', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.shipping'
        ])->name('admin.reports.shipping');

        Route::get('/reports/refunded', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.refunds'
        ])->name('admin.reports.refunded');

        Route::get('/reports/inventory', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.inventory'
        ])->name('admin.reports.inventory');

        Route::get('/reports/tax', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@index')->defaults('_config', [
            'view' => 'reports::super.tax'
        ])->name('admin.reports.tax');
//        Route::post('/reports/generate', 'Tahiryasin\Reports\Http\Controllers\Admin\ReportsController@generate')->name('admin.reports.generateInvoiceReport');


    });
});
