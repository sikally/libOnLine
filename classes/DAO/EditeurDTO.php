<?php
class EditeurDTO {

    private $id;
private $nom;

    public function setId($id){
            $this->id = $id;
        }
public function getId(){
            return $this->id;
        }
public function setNom($nom){
            $this->nom = $nom;
        }
public function getNom(){
            return $this->nom;
        }

}