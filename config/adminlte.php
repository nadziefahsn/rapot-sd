<?php

return [

    'title' => 'AdminLTE 4',
    'title_prefix' => '',
    'title_postfix' => '',
    'i18n_enabled' => false,

    'use_ico_only' => false,
    'use_full_favicon' => false,
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel. The 'logo' option holds
    | the brand text (html is allowed) and 'logo_img' the image placed next to
    | it, relative to the public folder.
    |
    | The optional 'logo_img_xl' option enables the AdminLTE logo switch: the
    | 'logo_img' one is then only shown while the sidebar is collapsed, and
    | this larger image replaces it while the sidebar is expanded.
    |
    | For detailed instructions you can look the logo section here:
    | https://jeroennoten.github.io/Laravel-AdminLTE/sections/configuration/basic_configuration.html
    |
    */

    'logo' => 'E-Raport ASTS SD GIS',
    'logo_img' => 'img/logo-sd-tv-edit.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs opacity-75',
    'logo_img_alt' => 'Admin Logo',

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'img/logo-samping.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 320,
            'height' => null,
        ],
    ],

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/assets/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => 'admin/profil',

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'logout_method' => null,
    'login_url' => 'login',
    'register_url' => null,
    'password_reset_url' => null,
    'password_email_url' => 'password/email',
    'profile_url' => false,

    'assets' => [
        'mode' => 'local',
        'cdn_fallback' => true,
        'adminlte_version' => null,
        'extended_colors' => false,
        'extended_colors_v3_aliases' => false,
        'palette' => [
            'primary' => null,
            'contrast' => null,
        ],
        'bootstrap_js' => true,
        'bootstrap_icons' => true,
        'overlayscrollbars' => true,
        'local' => [
            'adminlte_css' => 'vendor/adminlte/dist/css/adminlte.min.css',
            'adminlte_rtl_css' => 'vendor/adminlte/dist/css/adminlte.rtl.min.css',
            'adminlte_js' => 'vendor/adminlte/dist/js/adminlte.min.js',
            'colors_css' => 'vendor/adminlte/dist/css/adminlte-colors.min.css',
            'colors_rtl_css' => 'vendor/adminlte/dist/css/adminlte-colors.rtl.min.css',
            'colors_v3_css' => 'vendor/adminlte/dist/css/adminlte-colors-v3.min.css',
            'colors_v3_rtl_css' => 'vendor/adminlte/dist/css/adminlte-colors-v3.rtl.min.css',
            'bootstrap_js' => 'vendor/bootstrap/js/bootstrap.bundle.min.js',
            'bootstrap_icons_css' => 'vendor/bootstrap-icons/font/bootstrap-icons.min.css',
            'overlayscrollbars_css' => 'vendor/overlayscrollbars/styles/overlayscrollbars.min.css',
            'overlayscrollbars_js' => 'vendor/overlayscrollbars/browser/overlayscrollbars.browser.es6.min.js',
            'fonts_css' => 'vendor/fonts/source-sans-3/index.css',
        ],
        'cdn' => [
            'adminlte_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte.min.css',
            'adminlte_rtl_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte.rtl.min.css',
            'adminlte_js' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/js/adminlte.min.js',
            'colors_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-colors.min.css',
            'colors_rtl_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-colors.rtl.min.css',
            'colors_v3_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-colors-v3.min.css',
            'colors_v3_rtl_css' => 'https://cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-colors-v3.rtl.min.css',
            'bootstrap_js' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js',
            'bootstrap_icons_css' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css',
            'overlayscrollbars_css' => 'https://cdn.jsdelivr.net/npm/overlayscrollbars@2.16.0/styles/overlayscrollbars.min.css',
            'overlayscrollbars_js' => 'https://cdn.jsdelivr.net/npm/overlayscrollbars@2.16.0/browser/overlayscrollbars.browser.es6.min.js',
            'fonts_css' => 'https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.3.0/index.css',
        ],
    ],

    'google_fonts' => [
        'allowed' => true,
    ],

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'resources/css/app.css',
    'laravel_js_path' => 'resources/js/app.js',

    'color_mode' => [
        'enabled' => true,
        'default' => 'auto',
        'remember' => true,
        'no_flash_script' => true,
        'routes' => true,
        'theme_color' => [
            'light' => '#0d6efd',
            'dark' => '#1a1a1a',
        ],
    ],

    'disable_darkmode_routes' => false,

    'rtl' => [
        'enabled' => null,
        'locales' => [
            'ar', 'arc', 'ckb', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ps',
            'sd', 'ug', 'ur', 'uz-AF', 'yi',
        ],
    ],

    'print' => [],

    'layout_topnav' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_compact' => false,

    'classes_body' => 'bg-body-tertiary',
    'classes_brand' => '',
    'classes_brand_text' => 'fw-light',
    'classes_wrapper' => '',
    'classes_content_wrapper' => '',
    'classes_footer' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_content_top_area' => '',
    'classes_content_bottom_area' => '',
    'classes_sidebar' => 'bg-body-secondary shadow',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'bg-body',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container-fluid',

    'sidebar_theme' => 'dark',
    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_without_hover' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_expand' => 'lg',
    'sidebar_breakpoint' => null,

    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'leave',
    'sidebar_scrollbar_click_scroll' => true,
    'sidebar_scrollbar_options' => [],
    'sidebar_scrollbar_disable_below' => 992,

    'sidebar_nav_aria_label' => null,
    'sidebar_nav_compact' => false,
    'sidebar_nav_indent' => false,
    'sidebar_nav_pills' => false,
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'bi bi-gear',
    'right_sidebar_theme' => null,
    'right_sidebar_title' => null,
    'right_sidebar_placement' => 'end',
    'right_sidebar_backdrop' => true,
    'right_sidebar_scroll' => false,
    'right_sidebar_classes' => '',

    'css_variables' => [],
    'css_variables_scope' => ':root',
    'css_variables_sidebar' => [],

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-primary',

    'auth_social_links' => [],
    'auth_social_links_separator' => null,

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'header' => 'MENU UTAMA',
            'can'  => ['admin', 'guru'],
        ],
        [
            'text' => 'Dashboard', 
            'url' => 'admin/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'can'  => 'admin',
        ],
        [
            'text' => 'Dashboard', 
            'url' => 'guru/dashboard',
            'icon' => 'fas fa-tachometer-alt',
            'can'  => 'guru',
        ],
        [
            'text' => 'Pengumuman',
            'url'  => 'admin/pengumuman',
            'icon' => 'fas fa-bullhorn',
            'can'  => 'admin',
        ],
        [
            'text' => 'Data Master',
            'icon' => 'fas fa-server',
            'can'  => 'admin',
            'submenu' => [
                [
                    'text' => 'Informasi Sekolah',
                    'url'  => 'admin/sekolah',
                    'icon' => 'fas fa-school',
                ],
                [
                    'text' => 'Tahun Pelajaran',
                    'url'  => 'admin/tahun_ajaran',
                    'icon' => 'fas fa-calendar-alt',
                ],
                [
                    'text' => 'Guru',
                    'url'  => 'admin/guru',
                    'icon' => 'fas fa-chalkboard-teacher',
                ],
                [
                    'text' => 'Kelas & Wali',
                    'url'  => 'admin/kelas',
                    'icon' => 'fas fa-layer-group',
                ],
                [
                    'text' => 'Peserta Didik',
                    'url'  => 'admin/siswa',
                    'icon' => 'fas fa-user-graduate',
                ],
                [
                    'text' => 'Anggota Kelas',
                    'url'  => 'admin/anggota-kelas',
                    'icon' => 'fas fa-user-graduate',
                ],
                [
                    'text' => 'Kelompok T2Q',
                    'url'  => 'admin/guru-t2q',
                    'icon' => 'fas fa-chalkboard-teacher',
                ],
                [
                    'text' => 'Ekstrakulikuler',
                    'url'  => 'admin/ekstrakulikuler',
                    'icon' => 'fas fa-users',
                ],
            ],
        ],
        [
        'text' => 'Anggota Kelas',
        'url'  => 'guru/anggota-kelas',
        'icon' => 'fas fa-users',
        'can'  => 'guru',
        ],
        [
        'text'    => 'Penilaian',
        'icon'    => 'fas fa-file-alt',
        'can'     => ['admin', 'guru'],
        'submenu' => [
            [
                'text' => 'Mata Pelajaran',
                'url'  => 'admin/mapel',
                'icon' => 'fas fa-book-open',
                'can'  => 'admin',
            ],
            [
                'text' => 'Deskripsi Mapel',
                'url'  => 'admin/deskripsi',
                'icon' => 'fas fa-clipboard-list',
                'can'  => 'admin',
            ],
            [
                'text' => 'Rekap Kehadiran',
                'url'  => 'guru/kehadiran',
                'icon' => 'fas fa-calendar-check',
                'can'  => 'guru',
            ],
            [
                'text' => 'Catatan Wali Kelas',
                'url'  => 'guru/catatan',
                'icon' => 'fas fa-fw fa-sticky-note',
                'can'  => 'guru',
            ],  
            [
                'text' => 'Intrakulikuler',
                'url'  => 'guru/intrakulikuler', 
                'icon' => 'fas fa-fw fa-sticky-note',
                'can'  => 'guru',
            ],  
        ],
    ],
            [
                'text' => 'Hafalan',
                'url'  => 'guru_t2q/nilai-hafalan',
                'icon' => 'fas fa-fw fa-brain',
                'can'  => 'guru_t2q',
            ],
            [
                'text' => 'Pelajaran Sholat',
                'url'  => 'guru_t2q/nilai-sholat',
                'icon' => 'fas fa-fw fa-pray',
                'can'  => 'guru_t2q',
            ],
            [
                'text' => 'Tahsin',
                'url'  => 'guru_t2q/nilai-tahsin',
                'icon' => 'fas fa-fw fa-quran',
                'can'  => 'guru_t2q',
            ],
            [
                'text' => 'Tahfidz',
                'url'  => 'guru_t2q/nilai-tahfidz',
                'icon' => 'fas fa-fw fa-quran',
                'can'  => 'guru_t2q',
            ],
            [
                'text' => 'Amalan Ibadah',
                'url'  => 'guru_t2q/amalan-ibadah',
                'icon' => 'fas fa-hands-praying',
                'can'  => 'guru_t2q',
            ],

            [
                'text' => 'Catatan T2Q',
                'url'  => 'guru_t2q/catatan',
                'icon' => 'fas fa-fw fa-sticky-note',
                'can'  => 'guru_t2q',
            ],
        [
            'text' => 'Penilaian Ekstrakulikuler',
            'icon' => 'fas fa-book-reader',
            'can'  => ['guru_t2q', 'guru'],
            'submenu' => [
                [
                    'text'  => 'Pilihan',
                    'route' => 'nilai-eskul.index',
                    'icon'  => 'fas fa-check-square',
                ],
            ],
        ],
    ]
    

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://jeroennoten.github.io/Laravel-AdminLTE/sections/configuration/menu.html
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://jeroennoten.github.io/Laravel-AdminLTE/sections/configuration/plugins.html
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/2.1.8/js/dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => '//cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css',
                ],
            ],
        ],

        'FontAwesome' => [
        'active' => true,
        'files' => [
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'vendor/fontawesome-free/css/all.min.css',
            ],
        ],
    ],
        'CustomAdmin' => [
        'active' => true,
        'files' => [
            [
                'type' => 'css',
                'asset' => true,
                'location' => 'css/custom-admin.css',
            ],
        ],
    ],
        // The Datatables 'Buttons' extension, required by the 'with-buttons'
        // attribute of the datatable component. JSZip powers the excel export
        // and pdfmake the pdf one, drop them when you don't need those.

        'DatatablesButtons' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/4.0.2/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/4.0.2/js/buttons.bootstrap5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/4.0.2/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/4.0.2/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.3/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.3/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/buttons/4.0.2/css/buttons.bootstrap5.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css',
                ],

                // The AdminLTE v4 compatibility theme for Select2. Replace it
                // by the 'adminlte-select2.rtl.min.css' file on RTL mode.

                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-select2.min.css',
                    'rtl' => '//cdn.jsdelivr.net/npm/admin-lte@{version}/dist/css/adminlte-select2.rtl.min.css',
                ],
            ],
        ],
        'TomSelect' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap5.min.css',
                ],
            ],
        ],
        'Tabulator' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/tabulator-tables@6.3.0/dist/js/tabulator.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/tabulator-tables@6.3.0/dist/css/tabulator_bootstrap5.min.css',
                ],
            ],
        ],
        'Flatpickr' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css',
                ],
            ],
        ],
        'Quill' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css',
                ],
            ],
        ],
        'NoUiSlider' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/nouislider@15.8.1/dist/nouislider.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/nouislider@15.8.1/dist/nouislider.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/chart.js@4.4.6/dist/chart.umd.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.2.4/pace.min.js',
                ],
            ],

        ],
        'summernote' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js',
                ],
            ],
        ],
    ],

];