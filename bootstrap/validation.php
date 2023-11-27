<?php

use App\Models\User;
use Valitron\Validator;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

Validator::addRule('emailIsUnique', function ($field, $value, $params, $fields) {
    $user = User::where('email', $value)
        ->where('email', '!=', Sentinel::check()->email)
        ->first();

    if ($user) {
        return false;
    }

    return true;
}, 'is already in use');

Validator::addRule('currentPassword', function ($field, $value, $params, $fields) {
    return Sentinel::getUserRepository()->validateCredentials(
        Sentinel::check(),
        ['password' => $value]
    );
}, 'is wrong');
