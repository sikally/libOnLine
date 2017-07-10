<?php
class LivreDAO implements ILivreDAO {

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
        $sql = "SELECT * FROM livres";
        $rs = $this->pdo->query($sql)->fetchAll();
        return $rs;
    }

    public function findOneById($id){
        $sql = "SELECT * FROM livres WHERE id=?";
        $statement = $this->pdo->prepare($sql);
        $statement->execute([$id]);
        $rs = $statement->fetch();
        return $rs;
    }

    public function find(array $search){
        $sql = "SELECT * FROM livres ";

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

    public function save(LivreDTO $livre){
        try{
            if($livre->getId() == null){
                return $this->insert($livre);
            } else {
                return $this->update($livre);
            }
        }catch (Exception $e){
            echo $e->getMessage();
            exit;
        }

    }

    private function insert(LivreDTO $livre){
        $sql = "INSERT INTO livres 
                (isbn, titre, sous_titre, description, date_publication, nb_pages, image, lien, id_editeur, prix, id_langue) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $params = [
            $livre->getIsbn(),
            $livre->getTitre(),
            $livre->getSousTitre(),
            $livre->getDescription(),
            $livre->getDatePublication(),
            $livre->getNbPages(),
            $livre->getImage(),
            $livre->getLien(),
            $livre->getIdEditeur(),
            $livre->getPrix(),
            $livre->getIdLangue()
        ];

        $success = $statement->execute($params);
        return $success;
    }

    private function update(LivreDTO $livre){
        $sql = "UPDATE livres SET isbn=? , titre=? , sous_titre=? , description=? , date_publication=? , nb_pages=? , image=? , lien=? , id_editeur=? , prix=? , id_langue=?  WHERE id=?";
        $data = array(
            $livre->getIsbn(), $livre->getTitre(), $livre->getSousTitre(), $livre->getDescription(), $livre->getDatePublication(), $livre->getNbPages(), $livre->getImage(), $livre->getLien(), $livre->getIdEditeur(), $livre->getPrix(), $livre->getIdLangue(),
            $livre->getId()
        );

        var_dump($data);

        $statement = $this->pdo->prepare($sql);
        $success = $statement->execute($data);

        var_dump($statement->errorInfo());

        return $success;
    }

    public function delete(LivreDTO $livre){
        if($livre->getId() != null){
            $sql = "DELETE FROM livres WHERE id=?";
            $statement = $this->pdo->prepare($sql);
            $statement->execute([$livre->getId()]);
        }
    }

}