<?php

class PanierDAO implements IPanierDAO
{

    /**
     * @var \PDO
     */
    private $pdo;


    /**
     * DAOClient constructor.
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM paniers";
        $rs = $this->pdo->query($sql)->fetchAll();

        return $rs;
    }

    public function findOneById($id)
    {
        $sql = "SELECT * FROM paniers WHERE produit_id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $rs = $statement->fetch();

        return $rs;
    }

    public function find(array $search)
    {
        $sql = "SELECT * FROM paniers ";

        if (count($search) > 0) {
            $sql .= " WHERE ";
            $cols = array_map(
                function ($item) {
                    return "$item=:$item";
                },
                array_keys($search)
            );

            $sql .= implode(" AND ", $cols);
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute($search);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(PanierDTO $panier)
    {
        if ($panier->getClientId() != null && $panier->getProduitId() != null) {
            try {
                $sql = "REPLACE INTO paniers (pu, qt, produit_id, client_id) VALUES (?,?,?,?)";
                $statement = $this->pdo->prepare($sql);
                $params = [
                    $panier->getPu(),
                    $panier->getQt(),
                    $panier->getProduitId(),
                    $panier->getClientId()
                ];
                $success = $statement->execute($params);


                return $success;
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }

        }
    }


    public function delete(PanierDTO $panier)
    {
        if ($panier->getClientId() != null && $panier->getProduitId() != null) {
            $sql = "DELETE FROM paniers WHERE produit_id=? and client_id=?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$panier->getProduitId(), $panier->getClientId()]);
        }
    }

    public function deleteAllFromClient($idClient)
    {
        if ($idClient != null) {
            $sql = "DELETE FROM paniers WHERE client_id=?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$idClient]);
        }
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
     * @return PanierDAO
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }


}