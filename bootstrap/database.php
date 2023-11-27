<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$capsule->addConnection([
    'driver' => 'pgsql',
    'host' => '127.0.0.1',
    'database' => 'slimauth',
    'username' => 'alexgarrettsmith',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci'
]);

$capsule->bootEloquent();
