<?php
require_once '../vendor/autoload.php';
require_once '../xajax/xajax_core/xajax.inc.php';
session_start();

use Philo\Blade\Blade;
use Donatorm\Ud07\UsersDB;

$xajax = new xajax();
$xajax->configure('javascript URI', '../xajax');
$xajax->configure('debug', true);
/**
 * Función que valida un usuario insertado en la vista viewLogin
 *
 * @param string $user Usuario a validar
 * @param string $pass Contraseña a validar
 * @return void
 */
function validateFormLogin($user, $pass)
{
    $errorUser = false; // Para saber si se ha insertado algún caracter en el campo usuario de la viewLogin
    $errorPass = false; // Idem para el campo contraseña
    $valid = false; // Para controlar si la validación en la BD es correcta o no lo es
    $user = trim($user);
    $pass = trim($pass);
    $response = new xajaxResponse(); // Creamos un objeto de la clase xajaxResponse
    if (strlen($user) === 0) {
        $errorUser = true;
    }
    if (strlen($pass) === 0) {
        $errorPass = true;
    }
    if ($errorUser) {
        $response->assign('errorUser', 'innerHTML', 'Formato de Usuario incorrecto');
    } else {
        $response->clear('errorUser', 'innerHTML');
    }
    if ($errorPass) {
        $response->assign('errorPass', 'innerHTML', 'Formato de Contraseña incorrecto');
    } else {
        $response->clear('errorPass', 'innerHTML');
    }
    if ($errorUser === false && $errorPass === false) {
        $objUserDB = new UsersDB();
        $valid = $objUserDB->validateUserDB($user, $pass);
    }
    if (!$valid && !($errorUser || $errorPass)) {
        $response->assign('errorDB', 'innerHTML', 'Usuario incorrecto');
        $response->clear('errorUser', 'innerHTML');
        $response->clear('errorPass', 'innerHTML');
    } else {
        $_SESSION['user'] = $user;
        $response->clear('errorDB', 'innerHTML');
    }
    $response->setReturnValue($valid); // Indicamos que tiene que devolver el valor de la variable $valid a Javascript
    return $response;
}

// Se registran la función validateFormLogin para que JavaScript sea capaz de leerla
$xajax->register(XAJAX_FUNCTION, 'validateFormLogin');
$xajax->processRequest(); // Se lanza la petición del objeto xajax para que sea leído por el Javascript

$views = '../views';
$cache = '../cache';

$objViewLogin = new Blade($views, $cache);
$title = 'Login';
echo $objViewLogin->view()->make('viewLogin', compact('title', 'xajax'))->render();
