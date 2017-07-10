<?php
class LivreDTO {

    private $id;
private $isbn;
private $titre;
private $sousTitre;
private $description;
private $datePublication;
private $nbPages;
private $image;
private $lien;
private $idEditeur;
private $prix;
private $idLangue;

    public function setId($id){
            $this->id = $id;
        }
public function getId(){
            return $this->id;
        }
public function setIsbn($isbn){
            $this->isbn = $isbn;
        }
public function getIsbn(){
            return $this->isbn;
        }
public function setTitre($titre){
            $this->titre = $titre;
        }
public function getTitre(){
            return $this->titre;
        }
public function setSousTitre($sousTitre){
            $this->sousTitre = $sousTitre;
        }
public function getSousTitre(){
            return $this->sousTitre;
        }
public function setDescription($description){
            $this->description = $description;
        }
public function getDescription(){
            return $this->description;
        }
public function setDatePublication($datePublication){
            $this->datePublication = $datePublication;
        }
public function getDatePublication(){
            return $this->datePublication;
        }
public function setNbPages($nbPages){
            $this->nbPages = $nbPages;
        }
public function getNbPages(){
            return $this->nbPages;
        }
public function setImage($image){
            $this->image = $image;
        }
public function getImage(){
            return $this->image;
        }
public function setLien($lien){
            $this->lien = $lien;
        }
public function getLien(){
            return $this->lien;
        }
public function setIdEditeur($idEditeur){
            $this->idEditeur = $idEditeur;
        }
public function getIdEditeur(){
            return $this->idEditeur;
        }
public function setPrix($prix){
            $this->prix = $prix;
        }
public function getPrix(){
            return $this->prix;
        }
public function setIdLangue($idLangue){
            $this->idLangue = $idLangue;
        }
public function getIdLangue(){
            return $this->idLangue;
        }

}