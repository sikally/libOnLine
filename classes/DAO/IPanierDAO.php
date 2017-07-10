<?php

interface IPanierDAO {

    public function findAll();

    public function findOneById($id);

    public function find(array $search);

    public function delete(PanierDTO $panier);

    public function save (PanierDTO $panier);

}