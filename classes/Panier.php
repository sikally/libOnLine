<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Panier
 *
 * @author formation
 */
class Panier {

    private $produits = [];
    private $nbProduits = 0;
    private $totalPanier = 0;
    
    private $client;
    private $panierDAO;
    private $panierDTO;
    
    function __construct ($client,$panierDAO,$panierDTO) {
        $this->client = $client;
        $this->panierDAO = $panierDAO;
        $this->panierDTO = $panierDTO;
    }

        public function ajouter(array $produit) {
        if ($this->validerProduit($produit)) {
            $indice = $this->trouverProduit($produit['id']);

            if ($indice == -1) {
                array_push($this->produits, $produit);
            } else {
                $this->produits[$indice]['qt'] += 1;
            }

            $this->calculerPanier();
        }
    }

    public function __toString() {
        return "Il y a " . $this->nbProduits . " produit(s) dans le panier"
                . " pour un total de " . $this->totalPanier . " €";
    }

    private function validerProduit(array $produit) {
        return array_key_exists('id', $produit) && array_key_exists('qt', $produit) && array_key_exists('pu', $produit);
    }

    private function trouverProduit($id) {
        $indice = -1;
        $nbLignes = count($this->produits);

        for ($i = 0; $i < $nbLignes && $indice < 0; $i++) {
            if ($id == $this->produits[$i]['id']) {
                $indice = $i;
            }
        }
        return $indice;
    }

    private function calculerPanier() {
        $nbLivres = 0;
        $totalPanier = 0;

        foreach ($this->produits as $livre) {
            $nbLivres += $livre['qt'];
            $totalPanier += $livre['pu'] * $livre['qt'];
        }

        $this->nbProduits = $nbLivres;
        $this->totalPanier = $totalPanier;
    }

    public function supprimer($id) {
        $indice = $this->trouverProduit($id);
        if ($indice >= 0) {
            array_splice($this->produits, $indice, 1);
        }

        $this->calculerPanier();
    }

    public function modifier($id, $qt) {
        $indice = $this->trouverProduit($id);
        if ($indice >= 0) {
            if ($qt > 0) {
                var_dump($qt);
                $this->produits[$indice]['qt'] = $qt;
                
                var_dump($this->produits);
                var_dump($this->produits[$indice]['qt']);
            } else {
                array_splice($this->produits, $indice, 1);
            }
        }

        $this->calculerPanier();
    }

    public function getProduits() {
        return $this->produits;
    }

    public function getNbProduits() {
        return $this->nbProduits;
    }

    public function getTotalPanier() {
        return $this->totalPanier;
    }

}
