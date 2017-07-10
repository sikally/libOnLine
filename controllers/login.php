<?php

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_SANITIZE_STRING);
$submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);

$message = "";

if(isset($submit)){
    
    //Authentification
    $dao = new ClientDAO(getPDO());
    
    $data = $dao->find([
        'email' => $email,
        'mot_de_passe' => sha1($motDePasse)
    ]);
    
    
    
    if(count($data) == 0){
        $message = "Vos infos d'identification sont incorrectes";
        $_SESSION['message'] = $message;
        header('location:index.php?controller=login');
    } else {
        //Enregistrement de l'utilisateur dans un objet DTO
        
        session_regenerate_id(true);
        $data = $data[0];
        $client = new ClientDTO();
        $client->setClientId($data['client_id']);
        $client->setEmail($data['email']);
        $client->setNom($data['nom']);
        
        $_SESSION['client'] = serialize($client);
        
        $message = "Vous êtes connecté à notre site";
        $_SESSION['message'] = $message;
        
        header('location:index.php?controller=catalogue');
    }
}

//Consommation du message Flash
if(isset($_SESSION['message']) && $message== ""){
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;
}

echo getResponse('login', ['message' => $message]);
