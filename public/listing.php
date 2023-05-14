<?php
require_once '../vendor/autoload.php';
require_once '../xajax/xajax_core/xajax.inc.php';

use Donatorm\Ud07\ProductsDB;
use Donatorm\Ud07\VotesDB;
use Philo\Blade\Blade;

session_start();
$user = $_SESSION['user']; // Se recupera la variable de session donde se almacena el usuario logueado

// Si se intenta acceder directamente a este fichero sin pasar por login.php se reenvía a login.php
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    die();
}

// Si pulsamos el botón de Salir se eliminan las variables de sesión y se vuelve a login.php
if (isset($_POST['exit'])) {
    unset($_POST['exit']);
    session_unset();
    header('Location: login.php');
}

/* Función a la que tendremos acceso desde Javascript y nos almacenará en la BD el voto si el usuario
no lo ha votado antes */
function miVoto($id, $value)
{
    global $user;
    $fail = false;
    $response = new xajaxResponse();
    $objVote = new VotesDB();
    if ($objVote->validateVote($user, $id)) {
        $objVote->addVote($user, $id, $value);
    } else {
        $fail = true;
    }
    $response->setReturnValue($fail);
    return $response;
}

/* Función a la que tendremos acceso desde JavaScript y nos rellenará con las valoraciones y la media de
éstas representada con un conjunto de estrellas */
function pintarEstrellas($id)
{
    $response = new xajaxResponse();
    $objVote = new VotesDB();
    $halfStar = false;
    $totalStar = 0;
    $numberReviews = $objVote->countProducts($id); // Indica el número de Valoraciones según la id del producto
    if ($numberReviews !== 0) {
        $aritmeticMean = $objVote->arithmeticMeanVotes($id); // Se calcula la media de las valoraciones
        $integerPart = floor($aritmeticMean); // Se saca la parte entera de la media de la valoración
        $decimalPart = $aritmeticMean - $integerPart; // Se saca la parte decimal de la valoración
        // Se almacena con $halfStar si la parte decimal es menor que 0.5 para utilizar con la media estrella
        if ($decimalPart < 0.5) {
            $halfStar = false;
        } else {
            $halfStar = true;
        }
        $totalStar = $integerPart; // $total es el número de estrellas completas
    }
    // Si existe alguna valoración...
    if ($numberReviews !== 0) {
        // Se completa lo que se pasará a la vista desde JavaScript
        $box = $numberReviews . " Valoraciones. ";
        for ($i = 0; $i < $totalStar; $i++) {
            $box .= "<i class='fa-solid fa-star'></i>";
        }
        if ($halfStar) {
            $box .= "<i class='fa-regular fa-star-half-stroke'></i>";
        }
        $idStars = 'stars-' . $id; // Sacamos el nombre de la id porque casa span tiene un nombre distinto según su id
        $response->assign($idStars, 'innerHTML', $box);
    }
    return $response;
}

$xajax = new xajax(); // Se crea un objeto xajax
$xajax->register(XAJAX_FUNCTION, 'miVoto'); // Se registran la función miVoto para que JavaScript sea capaz de leerla
$xajax->register(XAJAX_FUNCTION, 'pintarEstrellas'); // Lo mismo para la función pintarEstrellas
$xajax->configure('javascript URI', '../xajax/'); // Se configura el PATH en donde localizar el directorio xajax_js

$xajax->processRequest(); // Se lanza la petición del objeto xajax para que sea leído por el Javascript 

$objProducts = new ProductsDB(); // Se crea un objeto de la tabla Productos
$tableProducts = $objProducts->getProductsDB(); // Recogemos en un array toda la tabla que luego la representaremos en la vista

$views = '../views';
$cache = '../cache';

$objListing = new Blade($views, $cache);
$title = 'Productos';
echo $objListing->view()->make('viewListing', compact('title', 'user', 'tableProducts', 'xajax'))->render();
