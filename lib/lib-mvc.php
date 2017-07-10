<?php

function getViewContent($view, array $params = []){
    extract($params);
    ob_start();
    require ROOT_FOLDER."/views/$view.php";
    $content =  ob_get_clean();
    
    return $content;
}

function getResponse($view, array $params = [], $layout = 'default-layout'){
    //Récupération du contenu de la vue
    $viewContent = getViewContent($view, $params);
    
    $params['viewContent']= $viewContent;
    
    //Application de la vue sur le gabarit
    return getViewContent($layout, $params);
}

function linkToController($controller, $content, array $attributes = []){
    $href = "index.php?controller=$controller";
    return htmlLink($href, $content, $attributes);
}