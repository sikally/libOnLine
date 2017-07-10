<?php

//Récupération du panier
if(isset($_SESSION['panier'])){
    $panier = unserialize($_SESSION['panier']);
} else {
    $panier = new Panier();
}

$livreId = filter_input(INPUT_GET, 'livre_id', FILTER_VALIDATE_INT);
$pu = filter_input(INPUT_GET, 'pu', FILTER_VALIDATE_FLOAT);

if(isset($livreId) && isset($pu)){
    $panier->ajouter(['id' => $livreId, 'pu' => $pu, 'qt' => 1]);    
    $_SESSION['panier'] = serialize($panier);
}

header('location:'. $_SERVER['HTTP_REFERER']);