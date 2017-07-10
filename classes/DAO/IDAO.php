<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author formation
 */
interface IDAO {
    
    public function findAll();
    
    public function findById($id);
    
    public function find(array $search);
    
    public function delete($dto);
    
    public function save($dto);
}
