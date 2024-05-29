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

        $articles = [];
        while($row = $req->fetch()) {
            $article = new Article($row['id'], $row['titre'], $row['contenu'], $row['dateCreation'], $row['dateModification'], $row['categorie']);
            $articles[] = $article;
        }
        return $articles;
    }



    // voici mes errerus para rapport à ce code 
    // Notice: Only variables should be passed by reference in C:\Apache24\htdocs\design_pattern\models\dao\ArticleDao.php on line 54

// Notice: Only variables should be passed by reference in C:\Apache24\htdocs\design_pattern\models\dao\ArticleDao.php on line 55

// Notice: Only variables should be passed by reference in C:\Apache24\htdocs\design_pattern\models\dao\ArticleDao.php on line 56



    public function save(Article $article) {
        $titre = $article->getTitre();
        $contenu = $article->getContenu();
        $categorie = $article->getCategorie()->getId();
        $currentDate = date('Y-m-d H:i:s'); 



        $req = $this->db->prepare("INSERT INTO article (titre, contenu, dateCreation, dateModification, categorie) VALUES (:titre, :contenu, :dateCreation, :dateModification, :categorie)");
        $req->bindParam(':titre', $titre);
        $req->bindParam(':contenu', $contenu);
        $req->bindParam(':dateCreation', $article->getDateCreation());
        $req->bindParam(':dateModification', $currentDate);
        $req->bindParam(':categorie', $categorie);
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