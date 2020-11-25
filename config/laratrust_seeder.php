<?php

return [
    'role_structure' => [
        'super_admin' => [
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'stock' => 'c,r,u,d',
            'pocket_money' => 'c,r,u,d',
            'sales' => 'c,r,u,d',
        ],
        'admin' => [
			'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'reports' => 'c,r,u,d',
            'stock' => 'c,r,u,d',
            'pocket_money' => 'c,r,u,d',
            'sales' => 'c,r,u,d',
		]
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
