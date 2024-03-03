<?php

return [
    [
        'text' => 'Dashboard',
        'icon' => 'fa-tachometer-alt',
        'route' => 'admin.dashboard',
        'children' => [],
        'visible' => true,
    ],
    [
        'text' => 'Products',
        'icon' => 'fa-shopping-bag',
        'route' => 'admin.product.index',
        'visible' => true,
        'children' => [
            [
                'text' => 'Products',
                'icon' => 'fa-shopping-bag',
                'route' => 'admin.product.index',
                'visible' => true,
                'children' => []
            ],
            // edit route
            [
                'route' => 'admin.product.edit',
                'visible' => false,
            ],
            [
                'text' => 'Add Product',
                'icon' => 'fas fa-plus',
                'route' => 'admin.product.create',
                'visible' => true,
                'children' => [
                ],
            ]
        ],
    ],
    [
        'text' => 'Categories',
        'icon' => 'fa-tags',
        'route' => 'admin.category.index',
        'visible' => true,
        'children' => [
            [
                'text' => 'Categories',
                'icon' => 'fa-tags',
                'route' => 'admin.category.index',
                'visible' => true,
                'children' => []
            ],
            // edit route
            [
                'route' => 'admin.category.edit',
                'visible' => false,
            ],
            [
                'text' => 'Add Category',
                'icon' => 'fas fa-plus',
                'route' => 'admin.category.create',
                'visible' => true,
                'children' => [
                ],
            ]
        ],
    ],
];
