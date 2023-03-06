<?php

return [
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
    ], [
        'key' => 'reports.invoice',
        'name' => 'reports::app.reports.invoice-report',
        'route' => 'admin.reports.invoiced',
        'sort' => 2,
        'icon-class' => 'sales-icon',
    ], [
        'key' => 'reports.shipping',
        'name' => 'reports::app.reports.shipping-report',
        'route' => 'admin.reports.shipping',
        'sort' => 2,
        'icon-class' => 'sales-icon',
    ], [
        'key' => 'reports.refund',
        'name' => 'reports::app.reports.refunds-report',
        'route' => 'admin.reports.refunded',
        'sort' => 2,
        'icon-class' => 'sales-icon',
    ], [
        'key' => 'reports.inventory',
        'name' => 'reports::app.reports.inventory-report',
        'route' => 'admin.reports.inventory',
        'sort' => 2,
        'icon-class' => 'sales-icon',
    ]
];