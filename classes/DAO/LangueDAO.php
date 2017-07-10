<?php
class LangueDAO implements ILangueDAO {

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

    public function findAll(){
        $sql = "SELECT * FROM langues";
        $rs = $this->pdo->query($sql)->fetchAll();
        return $rs;
    }

    public function findOneById($id){
        $sql = "SELECT * FROM langues WHERE id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $rs = $statement->fetch();
        return $rs;
    }

    public function find(array $search){
        $sql = "SELECT * FROM langues ";

        if(count($search)>0){
            $sql .= " WHERE ";
            $cols = array_map(
                function($item){
                    return "$item=:$item";
                }, array_keys($search)
            );

            $sql .= implode(" AND ", $cols);
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute($search);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save(LangueDTO $langue){
        if($langue->getId() == null){
            $this->insert($langue);
        } else {
            $this->update($langue);
        }
    }

    private function insert(LangueDTO $langue){
        $sql = "INSERT INTO clients (code_langue, libelle_langue) VALUES (?, ?})";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            $langue->getCodeLangue(), $langue->getLibelleLangue()
        ]);
    }

    private function update(LangueDTO $langue){
        $sql = "UPDATE langues SET code_langue=? , libelle_langue=?  WHERE id=?";
        $data = array(
            $langue->getCodeLangue(), $langue->getLibelleLangue(),
            $langue->getId()
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute($data);
    }

    public function delete(LangueDTO $langue){
        if($langue->getId() != null){
            $sql = "DELETE FROM langues WHERE id=?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$langue->getId()]);
        }
    }

}