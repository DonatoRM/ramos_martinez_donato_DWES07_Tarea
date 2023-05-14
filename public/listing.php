<?php
require_once '../vendor/autoload.php';
require_once '../xajax/xajax_core/xajax.inc.php';

use Donatorm\Ud07\ProductsDB;
use Donatorm\Ud07\VotesDB;
use Philo\Blade\Blade;

session_start();
$user = $_SESSION['user'];

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    die();
}
if (isset($_POST['exit'])) {
    unset($_POST['exit']);
    session_unset();
    header('Location: login.php');
}

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
function pintarEstrellas($id)
{
    $response = new xajaxResponse();
    // Sigue aquí
    $objVote = new VotesDB();
    $halfStar = false;
    $totalStar = 0;
    $numberReviews = $objVote->countProducts($id);
    if ($numberReviews !== 0) {
        $aritmeticMean = $objVote->arithmeticMeanVotes($id);
        $integerPart = floor($aritmeticMean);
        $decimalPart = $aritmeticMean - $integerPart;
        if ($decimalPart < 0.5) {
            $halfStar = false;
        } else {
            $halfStar = true;
        }
        $totalStar = $integerPart;
    }
    if ($numberReviews !== 0) {
        $box = $numberReviews . " Valoraciones. ";
        for ($i = 0; $i < $totalStar; $i++) {
            $box .= "<i class='fa-solid fa-star'></i>";
        }
        if ($halfStar) {
            $box .= "<i class='fa-regular fa-star-half-stroke'></i>";
        }
        $idStars = 'stars-' . $id;
        $response->assign($idStars, 'innerHTML', $box);
    }
    return $response;
}

$xajax = new xajax();
$xajax->register(XAJAX_FUNCTION, 'miVoto');
$xajax->register(XAJAX_FUNCTION, 'pintarEstrellas');
$xajax->configure('javascript URI', '../xajax/');
// $xajax->configure('debug', true);
$xajax->processRequest();

$objProducts = new ProductsDB();
$tableProducts = $objProducts->getProductsDB();

$views = '../views';
$cache = '../cache';

$objListing = new Blade($views, $cache);
$title = 'Productos';
echo $objListing->view()->make('viewListing', compact('title', 'user', 'tableProducts', 'xajax'))->render();
