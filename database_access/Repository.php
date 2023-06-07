<?php
include_once 'ConnexionPDO.php';
abstract class Repository
{
    protected $tableName;

    protected  $cnxPDO;

    public function __construct  ($tableName){
        $this->cnxPDO = ConnexionPDO::getInstance();
        $this->tableName= $tableName;
    }

    public function findAll(){
        $requete = "select * from $this->tableName order by id desc";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute(array());
        return $reponse->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id){
        $requete = "select * from $this->tableName where id = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$id]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }


    public function findByEmail($email){
        $requete = "select * from $this->tableName where email = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$email]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function findByName($name){
        $requete = "select * from $this->tableName where name = ? ";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$name]);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function Create ($params){
        $keys = array_keys($params);
        // ['id' , 'nom' , 'prenom' , 'age']
        $keyString = implode(",", $keys);
        // 'id' , 'nom' , 'prenom' , 'age'
        $paramselements = array_fill(0, count($keys), '?');
        // [ ? , ? , ? , ? ]
        $paramsString = implode(",", $paramselements);
        // ? , ? , ? , ?

        $requete = "insert into $this->tableName ($keyString) values ($paramsString)";
        $reponse =$this->cnxPDO->prepare($requete);
        $reponse->execute(array_values($params));
        return $reponse->fetch(PDO::FETCH_OBJ);
    }

    public function DeleteById($id){
        $requete = "delete from $this->tableName where id = ?";
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute([$id]);
    }

    public function UpdateById($id,$params){
        $keys = array_keys($params);
        $setClause = implode('=?, ', $keys) . '=?';
        $requete = "UPDATE $this->tableName SET $setClause WHERE id = ?";
        $values = array_values($params);
        $values[] = $id;
        $reponse = $this->cnxPDO->prepare($requete);
        $reponse->execute($values);
        return $reponse->fetch(PDO::FETCH_OBJ);
    }


}