<?php

//Auto chargement des classes
function autoloader($class) {
    //Dossiers contenant les classes
    $folders = [
        'classes/',
        'classes/DAO/'
    ];
    //Boucle sur l'ensemble des dossiers
    //pour trouver la classe
    foreach ($folders as $folder) {
        $path = $folder . $class . '.php';
        $found = false;

        if (file_exists($path)) {
            $found = true;
            require $path;
            break;
        }
    }

    //Exception si la classe n'est pas trouvée
    if (!$found) {
        throw new Exception("Le fichier $class.php n'existe pas");
    }
}

spl_autoload_register('autoloader');

