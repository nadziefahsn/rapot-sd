<?php

return [

    'title' => 'AdminLTE 4',
    'title_prefix' => '',
    'title_postfix' => '',
    'i18n_enabled' => false,

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'logo' => '<b>Admin</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/assets/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image opacity-75 shadow',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs opacity-75',
    'logo_img_alt' => 'Admin Logo',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/assets/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
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
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
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

    'menu' => [
        [
            'text' => 'Dashboard',
            'url'  => 'admin/dashboard',
            'icon' => 'fas fa-fw fa-tachometer-alt',
        ],
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
    ],

];