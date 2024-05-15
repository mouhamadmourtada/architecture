<?php

namespace models;
use config\Connection;


class Article extends Model{
    
    protected $id;
    private $titre;
    private $contenu;
    private $dateCreation;
    private $dateModification;
    private $categorie;
    
    public function __construct($id, $titre, $contenu, $dateCreation, $dateModification, $categorie) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->categorie = $categorie;
    }

   
   
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitre() {
        return $this->titre;
    }
    
    public function getContenu() {
        return $this->contenu;
    }
    
    public function getDateCreation() {
        return $this->dateCreation;
    }
    
    public function getDateModification() {
        return $this->dateModification;
    }
    
    public function getCategorie() {
        return $this->categorie;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setTitre($titre) {
        $this->titre = $titre;
    }
    
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }
    
    public function setDateCreation($dateCreation) {
        $this->dateCreation = $dateCreation;
    }
    
    public function setDateModification($dateModification) {
        $this->dateModification = $dateModification;
    }
    
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }



    public function save(){
        $query = $this->db->prepare("INSERT INTO article(titre, contenu, dateCreation, dateModification, categorie) VALUES(:titre, :contenu, :dateCreation, :dateModification, :categorie)");
        $query->execute([
            'titre' => $this->titre,
            'contenu' => $this->contenu,
            'dateCreation' => date('Y-m-d H:i:s'),
            'dateModification' => date('Y-m-d H:i:s'),
            // 'dateCreation' => $this->dateCreation,
            // 'dateModification' => $this->dateModification,
            'categorie' => $this->categorie
        ]);
    }

    public function delete(){
        $query = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $query->execute([
            'id' => $this->id
        ]);
    }
    

    public static function all(){
        $db = Connection::getConnection();
        $query = $db->query("SELECT * FROM article");
        $query->execute();
        $articles = [];
        while ($row = $query->fetch()) {
            $article = new Article($row['id'], $row['titre'], $row['contenu'], $row['dateCreation'], $row['dateModification'], $row['categorie']);
            $articles[] = $article;
        }
        return $articles;
        // $articles = $query->fetchAll();
        // return $articles;
    }

    public static function find($id){
        $db = Connection::getConnection();
        $query = $db->prepare("SELECT * FROM article WHERE id = :id");
        $query->execute([
            'id' => $id
        ]);
        $article = $query->fetch();
        return $article;
    }


    public static function findByCategory($id){
        $db = Connection::getConnection();
        $query = $db->prepare("SELECT * FROM article WHERE categorie = :id");
        $query->execute([
            'id' => $id
        ]);
        $articles = $query->fetchAll();
        return $articles;
    }


    public static function findByTitle($title){
        $db = Connection::getConnection();
        $query = $db->prepare("SELECT * FROM article WHERE titre LIKE :title");
        $query->execute([
            'title' => "%$title%"
        ]);
        $articles = $query->fetchAll();
        return $articles;
    }

    public static function findByContent($content){
        $db = Connection::getConnection();
        $query = $db->prepare("SELECT * FROM article WHERE contenu LIKE :content");
        $query->execute([
            'content' => "%$content%"
        ]);
        $articles = $query->fetchAll();
        return $articles;
    }

    public function update(){
        $query = $this->db->prepare("UPDATE article SET titre = :titre, contenu = :contenu, dateModification = :dateModification, categorie = :categorie WHERE id = :id");
        $query->execute([
            'titre' => $this->titre,
            'contenu' => $this->contenu,
            'dateModification' => date('Y-m-d H:i:s'),
            'categorie' => $this->categorie,
            'id' => $this->id
        ]);
    }
    
}