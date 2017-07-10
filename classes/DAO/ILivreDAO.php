<?php

interface ILivreDAO {

    public function findAll();

    public function findOneById($id);

    public function find(array $search);

    public function delete(LivreDTO $livre);

    public function save (LivreDTO $livre);

}