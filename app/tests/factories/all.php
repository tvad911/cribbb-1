<?php

use League\FactoryMuffin\Facade as FactoryMuffin;

FactoryMuffin::define('Post', [
    'user_id' => 'factory|User'
]);

FactoryMuffin::define('User', [
    'name' => 'firstName',
    'profile_pic' => 'optional:imageUrl|400;400'
]);