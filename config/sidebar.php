<?php

return [
    [
        'text' => 'Dashboard',
        'icon' => 'fa-tachometer-alt',
        'route' => 'admin.dashboard',
        'children' => [],
    ],
    [
        'text' => 'Products',
        'icon' => 'fa-shopping-bag',
        'route' => 'admin.product.index',
        'children' => [
            [
                'text' => 'Products',
                'icon' => 'fa-shopping-bag',
                'route' => 'admin.product.index',
                'children' => []
            ],
            [
                'text' => 'Add Product',
                'icon' => 'fas fa-plus',
                'route' => 'admin.product.create',
                'children' => [
                ],
            ]
        ],
    ],
    [
        'text' => 'Categories',
        'icon' => 'fa-tags',
        'route' => 'admin.category',
        'children' => [],
    ],

];
