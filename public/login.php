<?php
require_once '../vendor/autoload.php';
require_once '../vendor/xajax/xajax_core/xajax.inc.php';
session_start();

use Philo\Blade\Blade;
use Donatorm\Ud07\UsersDB;

$xajax = new xajax();
$xajax->configure('javascript URI', '../vendor/xajax');
// $xajax->configure('debug', true);
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
    if ($errorUser) {
        $response->assign('errorUser', 'innerHTML', '<p class="d-flex justify-content-center align-items-center rounded bg-danger text-white mb-0">Formato de Usuario incorrecto</p>');
        $response->assign('errorUser', 'class', 'bg-danger text-white rounded');
    } else {
        $response->clear('errorUser', 'innerHTML');
        $response->clear('errorUser', 'class');
    }
    if ($errorPass) {
        $response->assign('errorPass', 'innerHTML', '<p class="d-flex justify-content-center align-items-center rounded bg-danger text-white mb-0">Formato de Contraseña incorrecto</p>');
        $response->assign('errorPass', 'class', 'bg-danger text-white rounded');
    } else {
        $response->clear('errorPass', 'innerHTML');
        $response->clear('errorPass', 'class');
    }
    if ($errorUser === false && $errorPass === false) {
        $objUserDB = new UsersDB();
        $valid = $objUserDB->validateUserDB($user, $pass);
    }
    if (!$valid) {
        $response->assign('errorDB', 'innerHTML', '<p class="d-flex justify-content-center align-items-center w-100 h-100 rounded bg-danger text-white mt-1">Usuario incorrecto</p>');
    } else {
        $response->clear('errorDB', 'innerHTML');
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
