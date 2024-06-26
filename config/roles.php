<?php

declare(strict_types=1);

return [
    'permissions' => [
        'categories' => [
            'create', 'read', 'edit', 'delete'
        ],
        'comments' => [
            'create', 'edit', 'delete'
        ],
        'posts' => [
            'create', 'read', 'edit', 'delete'
        ],
        'users' => [
            'index', 'read', 'edit', 'delete'
        ]
    ],
    'roles' => [
        'admin' => [
            'users_index', 'users_edit', 'users_delete',
            'categories_create', 'categories_read', 'categories_edit', 'categories_delete',
            'posts_create', 'posts_read', 'posts_edit', 'posts_delete',
            'comments_create', 'comments_edit', 'comments_delete'
        ],
        'user' => [
            'users_edit', 'users_delete',
            'posts_create', 'posts_read', 'posts_edit', 'posts_delete',
            'comments_create', 'comments_edit', 'comments_delete'
        ]
    ],
];
