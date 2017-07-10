<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClientDAO
 *
 * @author formation
 */
class ClientDAO implements IDAO {

    /**
     *
     * @var PDO 
     */
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Retourne la liste des clients en fonction de critères de recherche
     * @param array $search Les critère de recherche
     * 
     * [
     *  'nom' => 'Bernard',
     *  'mot_de_passe' => 'a'
     * ]
     */
    public function find(array $search) {
        $sql = "SELECT * FROM clients ";

        if (count($search) > 0) {
            $sql .= " WHERE ";
            $cols = array_keys($search);

            $cols = array_map(
                    function($item) {
                return "$item=:$item";
            }, $cols
            );

            $sql .= implode(' AND ', $cols);
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute($search);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * retourne l'ensemble des clients
     * @return array
     */
    public function findAll() {
        $sql = "SELECT * FROM clients";
        $data = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * Retourne un client identifié par sa clef primaire
     * @param int $id la clef primaire
     */
    public function findById($id) {
        $sql = "SELECT * FROM clients WHERE client_id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($dto) {
        $success =  false;
        if($dto->getClientId() != null){
            $sql = "DELETE FROM clients WHERE client_id=?";
            $statement = $this->pdo->prepare($sql);
            $success = $statement->execute([$dto->getClientId()]);
        }
        
        return $success;
    }

    public function save($dto) {
        $success = false;
        
        if($dto->getClientId()== null){
            $success = $this->insert($dto);
        } else {
            $success = $this->update($dto);
        }
        
        return $success;
    }
    
    private function insert($dto){
        $sql = "INSERT INTO clients (nom, email, mot_de_passe) VALUES (?,?,?)";
        $statement = $this->pdo->prepare($sql);
        $success= $statement->execute(
                [
                    $dto->getNom(),
                    $dto->getEmail(),
                    sha1($dto->getMotDePasseEnClair())
                ]
        );
        
        if($success){
            $dto->setClientId($this->pdo->lastInsertId());
            return $dto;
        } else {
            return $success;
        }
    }
    
    private function update($dto){
        $sql = "UPDATE clients SET nom=?, email=?, mot_de_passe=? WHERE client_id=?";
        $statement = $this->pdo->prepare($sql);
        return $statement->execute(
                [
                    $dto->getNom(),
                    $dto->getEmail(),
                    $dto->getMotDePasse(),
                    $dto->getClientId()
                ]
        );
    }

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param PDO $pdo
     * @return ClientDAO
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    

}
