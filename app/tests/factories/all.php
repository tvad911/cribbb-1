<?php

use League\FactoryMuffin\Facade as FactoryMuffin;

FactoryMuffin::define('Post', array(
    'user_id' => 'factory|User'
));

FactoryMuffin::define('User', array(
    'username' => 'test',
    'email' => 'email',
    'password' => 'password',
    'password_confirmation' => 'password'
));