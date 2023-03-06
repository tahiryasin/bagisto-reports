<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    |
    | All ACLs related to reports will be placed here.
    |
    */
    [
        'key' => 'reports',
        'name' => 'reports::app.layouts.left-menu.reports',
        'route' => 'admin.reports.index',
        'sort' => 10,
        'icon-class' => 'sales-icon',
    ], [
        'key' => 'reports.sales',
        'name' => 'reports::app.reports.sales-report',
        'route' => 'admin.reports.index',
        'sort' => 2,
        'icon-class' => 'sales-icon',
    ]
];