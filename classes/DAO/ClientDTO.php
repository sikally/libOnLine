<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientDTO
 *
 * @author formation
 */
class ClientDTO {
    
    private $clientId;
    
    private $nom;
    
    private $email;
    
    private $motDePasse;
    
    private $motDePasseEnClair;
    
    public function getMotDePasseEnClair() {
        return $this->motDePasseEnClair;
    }

    public function setMotDePasseEnClair($motDePasseEnClair) {
        $this->motDePasseEnClair = $motDePasseEnClair;
        return $this;
    }

        
    public function getClientId() {
        return $this->clientId;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setClientId($clientId) {
        $this->clientId = $clientId;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
        return $this;
    }
    
    public function __set($name, $value)
    {
        return ['nom', 'email', 'clientId'];
    }


}
