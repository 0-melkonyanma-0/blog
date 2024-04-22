<?php

return [
    'permissions' => [
        'categories' => [
            'create', 'edit', 'delete'
        ],
        'comments' => [
            'create', 'edit', 'delete'
        ],
        'posts' => [
            'create', 'read', 'edit', 'delete'
        ],
        'bookmarks' => [
            'create', 'read', 'edit', 'delete'
        ],
    ],
    'roles' => [
        'admin' => [
            'categories_create', 'categories_edit', 'categories_delete',
            'posts_create', 'posts_read', 'posts_edit', 'posts_delete',
            'comments_create', 'comments_edit', 'comments_delete',
        ],
        'user' => [
            'posts_create', 'posts_read', 'posts_edit', 'posts_delete',
            'comments_create', 'comments_edit', 'comments_delete',
            'bookmarks_create', 'bookmarks_delete',
        ]
    ],
];
