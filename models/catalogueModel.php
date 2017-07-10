<?php

/**
 * Récupération des référentiels
 * @param string $ref le référentiel
 * @return array
 */
function getListeReferentiels($ref)
{

    switch($ref){
        case 'auteurs':
        case 'editeurs':
        case 'categories':
        case 'langues':
            $table = $ref;
            break;
        default:
            $table = null;
    }

    try {
        $connexion = getPDO();
        $sql = "SELECT * FROM $table";

        $rs = $connexion->query($sql);

        return $rs->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}



/**
 * Définition de la clause WHERE en fonction des choix de recherche
 * @param array $crit un tableau associatif des critères de recherche
 * @return string
 */
function getWereClause(array $crit){
    $where = [];
    $str = "";

    foreach ($crit as $key => $val){
        if($val > 0){
            array_push($where, "$key=:$key");
        }
    }

    if(count($where) > 0){
        $str = " WHERE ".implode(" AND ", $where);
    }
    return $str;
}

/**
 * Définition de la chaine SQL en fonction des choix de recherche
 * @param array $crit un tableau associatif des critères de recherche
 * @return string
 */
function getSQL(array $crit = []){
    $sql = "
        SELECT
        livres.id,
        livres.isbn,
        livres.titre,
        livres.sous_titre,
        livres.description,
        YEAR (livres.date_publication) AS annee_publication,
        livres.nb_pages,
        livres.image,
        livres.lien,
        livres.id_editeur,
        livres.prix,
        livres.id_langue,
        editeurs.nom AS editeur,
        langues.libelle_langue AS langue,
        GROUP_CONCAT(auteurs.nom_complet) AS liste_auteurs,
        GROUP_CONCAT(DISTINCT categories.categorie) AS liste_categories
    FROM
        livres
    INNER JOIN langues ON livres.id_langue = langues.id
    INNER JOIN editeurs ON livres.id_editeur = editeurs.id
    INNER JOIN auteurs_livres ON livres.id = auteurs_livres.id_livre
    INNER JOIN livres_categories ON livres.id = livres_categories.id_livre
    INNER JOIN categories ON livres_categories.id_categorie = categories.id
    INNER JOIN auteurs ON auteurs_livres.id_auteur = auteurs.id \n"

    .getWereClause($crit).

    "\n GROUP BY
        livres.id
      LIMIT :nbParPage OFFSET :decalage
    ";

    return $sql;
}

/**
 * Obtention de la liste des livres en fonction des critères de recherche
 * et du numéro de la page
 * @param array $crit un tableau associatif des critères de recherche
 * @param int $page le numéro de page
 * @return array
 */
function getCatalogue(array $crit= [], $page = 1){
    $sql = getSQL($crit);
    $connexion = getPDO();
    $stm = $connexion->prepare($sql);

    $decalage = ($page -1) * NB_PAR_PAGE;

    $stm->bindValue('nbParPage', NB_PAR_PAGE, PDO::PARAM_INT);
    $stm->bindValue('decalage', $decalage, PDO::PARAM_INT);
    
    foreach ($crit as $key => $val){
        if($val >0){
            $stm->bindValue($key,$val,PDO::PARAM_INT);
        }
    }

    $stm->execute();

    return $stm->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Obtention du nombre total de livres en fonction des critères de recherche
 * @param array $crit un tableau associatif des critères de recherche
 * @return int
 */
function getNbLivres(array $crit = []){
    $sql = "
        SELECT
        livres.id as nb
    FROM
        livres
    INNER JOIN langues ON livres.id_langue = langues.id
    INNER JOIN editeurs ON livres.id_editeur = editeurs.id
    INNER JOIN auteurs_livres ON livres.id = auteurs_livres.id_livre
    INNER JOIN livres_categories ON livres.id = livres_categories.id_livre
    INNER JOIN categories ON livres_categories.id_categorie = categories.id
    INNER JOIN auteurs ON auteurs_livres.id_auteur = auteurs.id\n"

        .getWereClause($crit).

        "\nGROUP BY
        livres.id
    ";

    try {
        $connexion = getPDO();
        $stm = $connexion->prepare($sql);

        foreach ($crit as $key => $val){
            if($val >0){
                $stm->bindValue($key,$val,PDO::PARAM_INT);
            }
        }
        $stm->execute();
        $data =  $stm->fetchAll(PDO::FETCH_ASSOC);
        return count($data);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

