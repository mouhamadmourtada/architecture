<?php

// ce fichier est le dao en question 
namespace models\dao;

use models\domaine\Article;

class ArticleDao extends ModelDao {

    public function __construct(){
        parent::__construct();
    }

    
    public function all() {
        $req = $this->db->prepare("SELECT * FROM article");
        $req->execute();
        $articles = [];

        while ($row = $req->fetch()) {
            $article = new Article($row['id'], $row['titre'], $row['contenu'], $row['dateCreation'], $row['dateModification'], $row['categorie']);
            $articles[] = $article;
        }
        return $articles;
    }


    public function find($id) {
        $req = $this->db->prepare("SELECT * FROM article WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        $article = $req->fetch();
        return $article;
    }


    public function findByCategory($id) {
        $req = $this->db->prepare("SELECT * FROM article WHERE categorie = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        $articles = $req->fetchAll();
        return $articles;
    }



    public function save(Article $article) {
        $req = $this->db->prepare("INSERT INTO article (titre, contenu, dateCreation, dateModification, categorie) VALUES (:titre, :contenu, :dateCreation, :dateModification, :categorie)");
        $req->bindParam(':titre', $article->getTitre());
        $req->bindParam(':contenu', $article->getContenu());
        $req->bindParam(':dateCreation', $article->getDateCreation());
        $req->bindParam(':dateModification', $article->getDateModification());
        $req->bindParam(':categorie', $article->getCategorie()->getId());
        $req->execute();
    }



    
    public function update(Article $article) {
        $req = $this->db->prepare("UPDATE article SET titre = :titre, contenu = :contenu, dateModification = :dateModification, categorie = :categorie WHERE id = :id");
        $req->bindParam(':titre', $article->getTitre());
        $req->bindParam(':contenu', $article->getContenu());
        $req->bindParam(':dateModification', $article->getDateModification());
        $req->bindParam(':categorie', $article->getCategorie()->getId());
        $req->bindParam(':id', $article->getId());
        $req->execute();
    }

    public function delete(Article $article) {
        $req = $this->db->prepare("DELETE FROM article WHERE id = :id");
        $req->bindParam(':id', $article->getId());
        $req->execute();
    }



}