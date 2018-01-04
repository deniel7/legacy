<?php

return [

    

    'multi-auth' => [
    'admin' => [
        'driver' => 'eloquent',
        'model'  => App\SysUser::class,
        'table'  => 'sys_user'
    ],

    'password' => [
        'email'  => 'emails.password',
        'table'  => 'password_resets',
        'expire' => 60,
    ],

    'user' => [
        'driver' => 'eloquent',
        'model'  => App\User::class,
        'table'  => 'users'
    ]
    ]

    

];
