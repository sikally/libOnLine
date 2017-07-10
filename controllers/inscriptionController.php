<?php

//Récupération des données
$nom = filter_input(INPUT_POST,'nom', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
$pass = filter_input(INPUT_POST, 'pass');
$passConfirm = filter_input(INPUT_POST, 'pass-confirm');
$submit = filter_input(INPUT_POST, 'submit');

$message = "";

//Validation des données
if(isset($submit)){
    if($pass != $passConfirm){
        $message = "Le mot de passe et sa confirmation doivent être identique";
    }elseif(! $email){
        $message = "Vous devez saisir un email valide";
    }elseif($pass == null || mb_strlen($pass) < 5){
        $message = "Votre mot de passe doit comporter au moins 5 caractères";
    } elseif(isset($submit) && isset($email) && isset($pass)){
        //Enregistrement de l'utilisateur
        //$message = saveUser($email, $pass);
        
        $client = new ClientDTO;
        $client->setEmail($email)
                ->setNom($nom)
                ->setMotDePasseEnClair($pass);
        
        $dao = new ClientDAO(getPDO());
        
        $client = $dao->save($client);
        
        if($client){
           $message = "Vous êtes inscrit"; 
           $_SESSION['client'] = serialize($client);
           $_SESSION['message'] = $message;
           header('location:index.php?controller=catalogue');
        } else {
            $message = "Votre inscription a échouée";
            $_SESSION['message'] = $message;
            header('location:index.php?controller=inscriptionController');
        }
        
    }
}

if(isset($_SESSION['message']) && $message== ""){
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;
}

//Affichage de la vue
echo getResponse('inscription', [
    'message' => $message
]);
