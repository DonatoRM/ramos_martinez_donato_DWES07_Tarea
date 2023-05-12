<?php
require_once '../vendor/autoload.php';

use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';

$objViewLogin = new Blade($views, $cache);
$title = 'Login';
echo $objViewLogin->view()->make('viewLogin', compact('title'))->render();
