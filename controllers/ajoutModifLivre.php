<?php

$livreId = filter_input(INPUT_GET, 'livre_id', FILTER_VALIDATE_INT);
if($livreId == null){
    $livreId = filter_input(INPUT_POST, 'livre_id', FILTER_VALIDATE_INT);
}
$pdo = getPDO();

if (isset($livreId)) {

    $livreDAO = new LivreDAO($pdo);
    $livre = $livreDAO->findOneById($livreId);

} else {
    $livre = [
        'titre' => null,
        'sous_titre' => null,
        'prix' => null,
        'nb_pages' => null,
        'lien' => null,
        'isbn' => null,
        'image' => null,
        'id_langue' => null,
        'id_editeur' => null,
        'id' => null,
        'description' => null,
        'date_publication' => null
    ];
}

$submit = filter_input(INPUT_POST, 'submit');
$titre = filter_input(INPUT_POST, 'titre');
$sousTitre = filter_input(INPUT_POST, 'sous_titre');
$prix = filter_input(INPUT_POST, 'prix');
$nbPages = filter_input(INPUT_POST, 'nb_pages');
$lien = filter_input(INPUT_POST, 'lien');
$image = filter_input(INPUT_POST, 'image');
$idLangue = filter_input(INPUT_POST, 'id_langue');
$idEditeur = filter_input(INPUT_POST, 'id_editeur');
$description = filter_input(INPUT_POST, 'description');
$datePub = filter_input(INPUT_POST, 'date_publication');
$isbn = filter_input(INPUT_POST, 'isbn');



//Conversion de la date
$pattern = "/(\d{4})-(\d{1,2})-(\d{1,2})/";
$replacement = "$3/$2/$1";
$livre['date_publication'] = preg_replace($pattern, $replacement, $livre['date_publication']);


if (isset($submit)) {

    //Conversion de la date
    $pattern = "/(\d{1,2})\/(\d{1,2})\/(\d{4})/";
    $replacement = "$3-$2-$1";
    $datePub = preg_replace($pattern, $replacement, $datePub);

    $dao = new LivreDAO($pdo);
    $dto = new LivreDTO();
    $dto->setId($livreId);
    $dto->setTitre($titre);
    $dto->setSousTitre($sousTitre);
    $dto->setDescription($description);
    $dto->setDatePublication($datePub);
    $dto->setIsbn($isbn);
    $dto->setIdEditeur($idEditeur);
    $dto->setIdLangue($idLangue);
    $dto->setImage($image);
    $dto->setLien($lien);
    $dto->setNbPages($nbPages);
    $dto->setImage($image);
    $dto->setPrix($prix);
    $dto->setIsbn($isbn);

    var_dump($dto);

    $success = $dao->save($dto);

    var_dump($success);

    if ($success) {
        header('location:index.php?controller=catalogue');
    }

}

$langueDAO = new LangueDAO($pdo);
$listeLangues = $langueDAO->findAll();

$editeurDAO = new EditeurDAO($pdo);
$listeEditeurs = $editeurDAO->findAll();


echo getResponse(
    'formLivres',
    [
        'livre' => $livre,
        'listeLangues' => $listeLangues,
        'listeEditeurs' => $listeEditeurs,
        'livreId' => $livreId

    ]
);