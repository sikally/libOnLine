<?php

interface ILangueDAO {

    public function findAll();

    public function findOneById($id);

    public function find(array $search);

    public function delete(LangueDTO $langue);

    public function save (LangueDTO $langue);

}