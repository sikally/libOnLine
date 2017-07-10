<?php

if(isset($_SESSION['panier'])){
    $panier = unserialize($_SESSION['panier']);
} else {
    $panier = new Panier();
}

$submit = filter_input(INPUT_POST, 'submit');
$qt = filter_input(INPUT_POST, 'qt', FILTER_VALIDATE_INT);
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

//($qt);

if($submit == 'supprimer'){
    $panier->supprimer($id);
} else if ($submit == "recalculer"){
    $panier->modifier($id, $qt);
}

$_SESSION['panier'] = serialize($panier);

echo getResponse('affichePanier', ['panier' => $panier]);