<?php

return [
    'table' => 'password_histories',

    'keep' => 2,

    'observe' => [
        'model' => \App\User::class,
        'column' => 'password',
    ],
];
