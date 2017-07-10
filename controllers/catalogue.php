<?php

//Récupération de données
$choixAuteur = filter_input(INPUT_GET, 'choixAuteur', FILTER_VALIDATE_INT);
$choixLangue = filter_input(INPUT_GET, 'choixLangue', FILTER_VALIDATE_INT);
$choixEditeur = filter_input(INPUT_GET, 'choixEditeur', FILTER_VALIDATE_INT);
$choixCategorie = filter_input(INPUT_GET, 'choixCategorie', FILTER_VALIDATE_INT);
$page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);


if(empty($page)){
    $page = 1;
}

$crit = [
    'id_langue' => $choixLangue,
    'id_auteur' => $choixAuteur,
    'id_editeur'=> $choixEditeur,
    'id_categorie' => $choixCategorie
];

//Liste des référentiels

$listeAuteurs = getListeReferentiels('auteurs');
$listeEditeurs = getListeReferentiels('editeurs');
$listeCategories = getListeReferentiels('categories');
$listeLangues = getListeReferentiels('langues');

//Nombre de livres
$nbLivres = getNbLivres($crit);
$nbPages = ceil($nbLivres / NB_PAR_PAGE);

$listeLivres = getCatalogue($crit, $page);

$url = "index.php?controller=catalogue".
    "&choixLangue=$choixLangue&choixAuteur=$choixAuteur".
    "&choixEditeur=$choixEditeur&choixCategorie=$choixCategorie";


//Affichage de la vue
echo getResponse('catalogue',
    [
        'listeAuteurs'  => $listeAuteurs,
        'listeEditeurs' => $listeEditeurs,
        'listeCategories' => $listeCategories,
        'listeLangues' => $listeLangues,
        'choixAuteur' => $choixAuteur,
        'choixLangue' => $choixLangue,
        'choixEditeur' => $choixEditeur,
        'choixCategorie' => $choixCategorie,
        'nbLivres' => $nbLivres,
        'nbPages' => $nbPages,
        'page' => $page,
        'listeLivres' => $listeLivres,
        'url' => $url
    ]
);