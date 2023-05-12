<?php
require_once '../vendor/autoload.php';
session_start();

use Philo\Blade\Blade;
use Donatorm\Ud07\UsersDB;

$xajax = new xajax();
$xajax->configure('javascript URI', '../vendor/xajax/xajax');
$xajax->configure('debug', true);
function validateFormLogin($user, $pass)
{
    $errorUser = false;
    $errorPass = false;
    $valid = false;
    $user = trim($user);
    $pass = trim($pass);
    $response = new xajaxResponse();
    if (strlen($user) === 0) {
        $errorUser = true;
    }
    if (strlen($pass) === 0) {
        $errorPass = true;
    }
    if (!$errorUser && !$errorPass) {
        $objUserDB = new UsersDB();
        $valid = $objUserDB->validateUserDB($user, $pass);
    }
    if ($errorUser) {
        $response->assign('errorUser', 'innerHTML', 'Formato de Usuario incorrecto');
        $response->assign('errorUser', 'class', 'bg-danger text-white rounded');
    } else {
        $response->clear('errorUser', 'innerHTML');
        $response->clear('errorUser', 'class');
    }
    if ($errorPass) {
        $response->assign('errorPass', 'innerHTML', 'Formato de Contraseña incorrecto');
        $response->assign('errorPass', 'class', 'bg-danger text-white rounded');
    } else {
        $response->clear('errorPass', 'innerHTML');
        $response->clear('errorPass', 'class');
    }
    $response->setReturnValue($valid);
    return $response;
}

$xajax->register(XAJAX_FUNCTION, 'validateFormLogin');
$xajax->processRequest();

$views = '../views';
$cache = '../cache';

$objViewLogin = new Blade($views, $cache);
$title = 'Login';
echo $objViewLogin->view()->make('viewLogin', compact('title', 'xajax'))->render();
