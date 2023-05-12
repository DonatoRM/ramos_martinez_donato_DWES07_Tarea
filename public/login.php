<?php
require_once '../vendor/autoload.php';
require_once '../xajax/xajax_core/xajax.inc.php';

use Philo\Blade\Blade;

$views = '../views';
$cache = '../cache';

$objViewLogin = new Blade($views, $cache);
$title = 'Login';
echo $objViewLogin->view()->make('viewLogin', compact('title'))->render();
