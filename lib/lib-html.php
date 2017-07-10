<?php

/**
 * Fonction de création d'un lien html
 * 
 * @param string $href la référence du lien
 * @param string $content le texte ou le contenu du lien
 * @param array $attributes un tableau associatif des attributs html du lien
 * @return string le code html d'un lien
 */
function htmlLink($href, $content, array $attributes = []){
    $attributes['href'] = $href;
    $html = htmlTag("a", $content, $attributes);
    return $html;
}

/**
 * @author moi@moi.com
 * Fonction générique de création d'une balise html
 * 
 * @param string $tag le nom de la balise
 * @param string $content le contenu entre l'ouverture et la fermeture de la balise
 * @param array $attributes un tableau associatif des attributs html
 * @return string le code html de la balise
 */
function htmlTag($tag, $content, array $attributes = []){
    //ouverture de la balise
    $html = "<$tag";
    
    //Liste des attributs
    foreach($attributes as $key=>$val){
        $html .= " $key=\"$val\"";
    }
    
    //fin d'ouverture de la balise
    $html .= ">";
    
    //affichage du contenu
    $html .= $content;
    
    //fermeture de la balise
    $html .= "</$tag>";
    
    //retour de la fonction
    return $html;
}
