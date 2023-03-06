# Bagisto Reports Module
Sales, Inventory, Shipping, Refunds and Inventory reports for Bagisto opensource.

## Automatic Installation
1. Use command prompt to run this package `composer require tahiryasin/bagisto-reports`
2. Now open `config/app.php` and register reports provider.
```sh
'providers' => [
        // Reports provider
        Tahiryasin\Reports\Providers\ReportsServiceProvider::class,
]
```
5. Now run `php artisan config:cache`

## Manual Installation
1. Download the zip folder from the github repository.
2. Unzip the folder and go to your bagisto application path `package` and create a folder name `Tahiryasin/Reports/` upload `src` folder inside this path.
3. Now open `config/app.php` and register Reports provider.
```sh
'providers' => [
        // Reports provider
        Tahiryasin\Reports\Providers\ReportsServiceProvider::class,
]
```
4. Now open composer.json and go to `autoload psr-4`.
```sh
"autoload": {
        "psr-4": {
        "Tahiryasin\\Reports\\": "packages/Tahiryasin/Reports/src"
        }
    }
```

6. Now open the command prompt and run `composer dump-autoload`.
7. Now run `php artisan config:cache`
9. Now go to your bagisto super admin, you will find the `Reports/States` link under `Settings` menu.


## Troubleshooting

1. if anybody facing after placing a order you are not redirecting to payment gateway and getting a route error then simply go to `bootstrap/cache` and delete all the cache files.

For any help or customisation  <https://scriptbaker.com> or email us <scriptbaker@gmail.com>
