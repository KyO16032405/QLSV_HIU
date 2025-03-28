<?php

return [


    'title' => 'Management School Admin',

    'title_prefix' => '',

    'title_postfix' => '',


    'logo' => '<b>Management</b> School',

    'logo_mini' => '<b>MS</b>',

    'skin' => 'blue-light',


    'layout' => 'fixed',


    'collapse_sidebar' => false,


    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => 'POST',

    'login_url' => 'login',

    'register_url' => 'register',


    'menu' => [
        'MAIN NAVIGATION',
        [
            'text' => 'Trang chủ',
            'url'  => '/',
        ],
        [
            'text' => 'Môn học',
            'url'  => 'subject',
        ],
        [
            'text' => 'Lớp',
            'url'  => 'class',
        ],
        [
            'text' => 'Quản lý điểm',
            'url'  => 'point',
            'can'  => 'admin'
        ],
        [
            'text' => 'Xem điểm',
            'url'  => 'point-list',
            'can'  => 'user'
        ],
        [
            'text' => 'Sinh viên',
            'url'  => 'student',
        ],
        [
            'text' => 'Giảng viên',
            'url'  => 'lecturer',
        ],
        [
            'text' => 'Sinh viên học lại',
            'url'  => 'studyagain',
        ],
        [
            'text' => 'Sinh viên thi lại',
            'url'  => 'retest',
        ],
        [
            'text' => 'Sinh viên lên lớp',
            'url'  => 'studyresult/1/2025-2026/1',
        ],
        [
            'text' => 'Sinh viên đạt học bổng',
            'url'  => 'scholarship/2025-2026/1/0',
        ],
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],


    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
