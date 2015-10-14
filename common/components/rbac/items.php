<?php
return [
    'dashboard' => [
        'type' => 2,
        'description' => 'Admin control panel',
    ],
    'user' => [
        'type' => 1,
        'description' => 'End user',
        'ruleName' => 'userRole',
    ],
    'moder' => [
        'type' => 1,
        'description' => 'Moderator',
        'ruleName' => 'userRole',
        'children' => [
            'user',
            'dashboard',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'Administrator',
        'ruleName' => 'userRole',
        'children' => [
            'moder',
        ],
    ],
];
