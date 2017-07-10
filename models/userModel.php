<?php

define('USER_DATA_PATH', 'data/users.json');

/**
 * Récupération de la liste des utilisateurs
 * 
 * @return array tableau des utilisateurs
 */
function getUsers(){
    $users = [];
    
    if(file_exists(USER_DATA_PATH)){
        //Le second paramètre à true indique que l'on veut 
        //récupérer un tableau associatif et non un objet
        $users = json_decode(file_get_contents(USER_DATA_PATH), true); 
    }
    return $users;
}
/**
 * Enregistrement d'un utilisateur dans un fichier json
 * @param string $email
 * @param string $password
 */
function saveUser($email, $password){
    //Récupération des utilisateurs
    $users = getUsers();
    
    if(userExists($email)){
        $message = "L'utilisateur $email existe déjà";
    } else {

        //Définition d'un nouvel utilisateur
        $newUser = ['email' => $email, 'password' => sha1($password)];

        //Ajout du nouvel utilisateur au tableau des utilisateurs
        array_push($users, $newUser);

        //enregistrement des utilisateurs dans le fichier json
        file_put_contents(USER_DATA_PATH, json_encode($users));
        
        $message = "Votre inscription est réussie";
    }
    
    return $message;
}

/**
 * Test l'existence d'un email dans le tableau des utilisateurs
 * @param string $email
 * @return boolean
 */
function userExists($email){
    $users = getUsers();
    
    $nbUsers = count($users);
    $found = false;
    
    for($i=0; $i < $nbUsers && !$found; $i++){
       $found = $email == $users[$i]['email']; 
    }
    
    return $found;
}
