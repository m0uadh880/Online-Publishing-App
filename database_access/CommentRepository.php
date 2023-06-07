<?php
require_once 'Repository.php';
class CommentRepository extends Repository
{
    public function __construct($tableName)
    {
        parent::__construct('comment');
    }
    public function findByArticleID($articleID){
        $requete = "select * from $this->tableName where articleID = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$articleID]);
        return $reponse->fetchAll(PDO::FETCH_OBJ);
    }
    public function findNumberByArticleID($articleID){
        $requete = "select count(*) from $this->tableName group by articleID having articleID = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$articleID]);
        return $reponse->fetchColumn();
    }


    public function DeleteByArticleId($articleID){
        $requete = "delete from $this->tableName where articleID = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$articleID]);
    }


}
?>
