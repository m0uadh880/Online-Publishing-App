<?php
require_once 'Repository.php';

class ArticlesRepository extends Repository
{
    public function __construct($tableName = 'article')
    {
        parent::__construct($tableName);
    }
    public function findByNom($name){
        $requete = "select * from $this->tableName where name = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$name]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function findById($id){
        $requete = "select * from $this->tableName where id = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function searchByName($name) {
        $query = "SELECT * FROM {$this->tableName} WHERE title LIKE ?";
        $stmt = $this->cnxPDO->prepare($query);
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    public function findVisitsById($id) {
        $requete = "select visits from $this->tableName where  id = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }
    public function UpdateVisitsByOne($visitsP,$id){
        $requete = "update $this->tableName set visits = ? + 1 where id = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$visitsP,$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function DeleteById($id){
        $requete = "delete from $this->tableName where id = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->bindValue(':article_id', $id);
        $reponse->execute([$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }


}
