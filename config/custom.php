<?php

return [
    'per-page' => 10,
    'suggest_num' => 2,
    'recent_num' => 4,
    'user_status' => [
        'pending' => 1,
        'active' => 2,
        'banned' => 3,
        'inactive' => 4
    ],
    'user_status_text' => [
        'Pending',
        'Active',
        'Banned',
        'Inactive'
    ],
    'article_status' => [
        'no_publish' => 1,
        'pending' => 2,
        'approved' => 3,
        'rejected' => 4
    ],
    'article_status_text' => [
        1 => 'No publish',
        2 => 'Pending',
        3 => 'Approved',
        4 => 'Rejected'
    ]
];
