<?php

return [

    /**
     * The table name to save your password histories.
     */
    'table' => 'password_histories',

    /**
     * The shows the number of password you want to keep and check for the current user.
     */
    'keep' => 2,

    /**
     * The models to be observed on and your password column name.
     */
    'observe' => [
        'model' => \App\User::class,
        'column' => 'password',
    ],
];
