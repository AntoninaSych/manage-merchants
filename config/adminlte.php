<?php



return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Concord pay',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Backoffice</b>',

    'logo_mini' => '<b>BO</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => null,

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */
    'menu' => [
        [
            'text' => 'Реестры',
            'url'  => 'reestrs',
            'icon' => ' fa-credit-card',
            'can'  => 'view-reestrs',
        ],
        [
            'text' => 'Менеджер ролей',
            'url'  => 'settings',
            'icon' => ' fa-credit-card',
            'can'  => 'manage-users',
        ],
        [
            'text' => 'Менеджер пользователей',
            'url'  => '/settings/users',
            'icon' => ' fa-credit-card',
            'can'  => 'manage-users',
        ],

        [
            'text' => 'Управление магазинами',
            'url'  => 'admin/blog',
            'icon' => ' fa-credit-card',
            'can'  => 'test',
        ],
        [
            'text' => 'История операций',
            'url'  => '/payments',
            'icon' => ' fa-credit-card',
            'can'  => 'view-payments',
        ],
        [
            'text' => 'Аналитика',
            'url'  => 'admin/blog',
            'can'  => 'test',
        ],
        [
            'text' => 'Просмотр мерчантов',
            'url'  => 'merchants/',
            'icon' => ' fa-credit-card',
            'can'  => 'merchant-view',
        ],
        [
            'text' => 'Управление MCC кодами',
            'url'  => '/mcc',
            'icon' => ' fa-credit-card',
            'can'  => 'manage-mcc',
        ],
        [
            'text' => 'Управление запросами',
            'url'  => '/queries',
            'icon' => ' fa-credit-card',
            'hasRole'  => 'apply-merchants-requests',
        ],
        [
            'text' => 'Просмотр статистики',
            'url'  => '/statistic',
            'icon' => ' fa-credit-card',
            'hasRole'  => 'view-statistic',
        ],
        [
            'text' => 'Мониторинг',
            'url'  => '/monitoring',
            'icon' => ' fa-credit-card',
            'hasRole'  => 'view-monitoring',
        ],
        [
            'text' => 'Отчеты',
            'url'  => '/reports',
            'icon' => ' fa-credit-card',
            'can'  => 'view-reports',
        ]
        ,
        [
            'text' => 'ConcordPay Users',
            'url'  => '/front/users',
            'icon' => ' fa-users',
            'hasRole'  => 'view-front-users',
        ]
    ],
//    'menu' => [
//        'MAIN NAVIGATION',
//        [
//            'text' => 'Blog',
//            'url'  => 'admin/blog',
//            'can'  => 'manage-blog',
//        ],
//        [
//            'text'        => 'Pages',
//            'url'         => 'admin/pages',
//            'icon'        => 'users-cog',
//            'label'       => 4,
//            'label_color' => 'success',
//        ],
//        'ACCOUNT SETTINGS',
//        [
//            'text' => 'Profile',
//            'url'  => 'admin/settings',
//            'icon' => 'user',
//        ],
//        [
//            'text' => 'Change Password',
//            'url'  => 'admin/settings',
//            'icon' => 'lock',
//        ],
//        [
//            'text'    => 'Multilevel',
//            'icon'    => 'share',
//            'submenu' => [
//                [
//                    'text' => 'Level One',
//                    'url'  => '#',
//                ],
//                [
//                    'text'    => 'Level One',
//                    'url'     => '#',
//                    'submenu' => [
//                        [
//                            'text' => 'Level Two',
//                            'url'  => '#',
//                        ],
//                        [
//                            'text'    => 'Level Two',
//                            'url'     => '#',
//                            'submenu' => [
//                                [
//                                    'text' => 'Level Three',
//                                    'url'  => '#',
//                                ],
//                                [
//                                    'text' => 'Level Three',
//                                    'url'  => '#',
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
//                [
//                    'text' => 'Level One',
//                    'url'  => '#',
//                ],
//            ],
//        ],
//        'LABELS',
//        [
//            'text'       => 'Important',
//            'icon_color' => 'red',
//        ],
//        [
//            'text'       => 'Warning',
//            'icon_color' => 'yellow',
//        ],
//        [
//            'text'       => 'Information',
//            'icon_color' => 'aqua',
//        ],
//    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
      //  JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        App\Classes\Filters\MenuFilter::class
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true
    ],
];
