<?php
return [
    'all' => [
    ],
    'roles' => [
         [
            'name' => 'admin',
            'guard_name' => 'web',
            'users' => [
                [
                    'email' => 'admin@demo.com',
                    'name' => 'admin',
                    'password' => 'password',
                ]
            ],
            'permissions' => 'all'
        ]
    ]
];
