<?php
require 'conf/config.php';
require 'lib/lib-html.php';
require 'lib/lib-mvc.php';
require 'lib/lib-pdo.php';
require 'models/userModel.php';
require 'models/catalogueModel.php';
require 'autoload.php';

session_start();

ini_set('session_cookie_lifetime', 60*60);

define('ROOT_FOLDER', __DIR__);

//Gestion d'un client anonyme
if(! isset($_SESSION['client'])){
    $client = new ClientDTO;
    $client->setNom("Anonyme");
    
    $_SESSION['client'] = serialize($client);
} else {
    $client = unserialize($_SESSION['client']);
}

//Récupération du panier
if(isset($_SESSION['panier'])){
    $panier = unserialize($_SESSION['panier']);
    //var_dump($panier);
} else {
    $panier = new Panier();
}

//Récupération du controller
$controller = filter_input(INPUT_GET, 'controller');

if(empty($controller)){
    $controller = 'mainController';
} elseif(!file_exists(ROOT_FOLDER."/controllers/$controller.php")){
    $controller = 'mainController';
}

require ROOT_FOLDER."/controllers/$controller.php";

