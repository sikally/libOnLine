<?php
class PanierDTO {

    private $clientId;
private $produitId;
private $pu;
private $qt;

    public function setClientId($clientId){
            $this->clientId = $clientId;
        }
public function getClientId(){
            return $this->clientId;
        }
public function setProduitId($produitId){
            $this->produitId = $produitId;
        }
public function getProduitId(){
            return $this->produitId;
        }
public function setPu($pu){
            $this->pu = $pu;
        }
public function getPu(){
            return $this->pu;
        }
public function setQt($qt){
            $this->qt = $qt;
        }
public function getQt(){
            return $this->qt;
        }

}