title: Rabbit Generator
date: 2014-11-11
tags: [Rabbit Training Center, Rabbit Generator]
---
#### I- Create new workbench/package `rabbit/sample`

- Structure
    ```prettyprint
    
        \_workbench
            \_rabbit
                \_sample
                    \_src
                        \_config
                            \_menu.php
                            \_permission.php
                        \_controllers // autoload in composer.json
                            \_HomeController.php
                        \_lang
                        \_migrations
                        \_models // autoload in composer.json
                        \_Rabbit
                            \_Sample
                                \_Facades
                                    \_SampleList.php
                                \_Libraries
                                    \_SampleList.php
                                \_Requests // datatables, validator, form event...
                        \_views
                            \_home
                                \_index.blade.php
                        breadcrumbs.php // don't include in SampleServiceProvider.php
                        routes.php // include in SampleServiceProvider.php
    ``` 
- Config service provider
    ```prettyprint
        
        // app/config/app.php
        ...
        'providers' => array(
            ...
            'Rabbit\Sample\SampleServiceProvider',
            ...
        )
    ```
- Custom package name
    ```prettyprint
        
        // workbench/rabbit/cpanel/src/config/package.php        
        return array(
            'cpanel' => array(
                'name' => 'Cpanel System',
            ),
            'sample' => array(
                'name' => 'Sample System',
            ),
        );
    ```
    
#### II- Create new scaffold

- Work flow: `migration`, `model`, `request`, `view`, `controller`, `route`, `breadcrumb`, `menu`, `permission` and run `dump-autoload`
- Custom menu
    ```prettyprint
        
        // workbench/rabbit/sample/src/config/menu.php
        return [
            // Home
            'Home' => [
                'icon' => 'home',
                'url' => URL::route('sample.home.index'),
            ],
            // Manage Data
            'Manage Data' => [
                'icon' => 'suitcase',
                'tree' => [
        			/*** $MENU$ ***/
                ],
            ]
        ];

    ```
- Custom permission
    ```prettyprint
        
        // workbench/rabbit/sample/src/config/permission.php
        return [
            /*** $PERMISSION$ ***/
        ];
    ```
#### III- Final
- Run `php artisan migrate --bench="rabbit/sample"` and custom `form validator or value`
- Login with `super` user and add new `group` for testing new scaffolding.
    
#### Regenerate
If you would like to regenerate scaffold, please delete the old resource info in `src/migrations/...`, `routes.php`, `breadcrumb.php`, `menu.php` and `permission.php`.

#### License
This system is licensed under Rabbit Training Center, Tel: 053 50 66 777.