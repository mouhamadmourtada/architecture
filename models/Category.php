<?php

namespace models;
use config\Connection;


class Category extends Model {
    
    protected $id;
    private $libelle;
    
    public function __construct($id, $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getLibelle() {
        return $this->libelle;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function save() {
        $req = $this->db->prepare("INSERT INTO categorie (libelle) VALUES (:libelle)");
        $req->bindParam(':libelle', $this->libelle);
        $req->execute();
    }

    public function delete() {
        $req = $this->db->prepare("DELETE FROM categorie WHERE id = :id");
        $req->bindParam(':id', $this->id);
        $req->execute();
    }

    public static function all() {
        $db = Connection::getConnection();
        $req = $db->prepare("SELECT * FROM categorie");
        $req->execute();
        $categories = [];

        while ($row = $req->fetch()) {
            $category = new Category($row['id'], $row['libelle']);
            $categories[] = $category;
        }
        return $categories;
    }

    public static function find($id) {
        $db = Connection::getConnection();
        $req = $db->prepare("SELECT * FROM categorie WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        
        $categoryData = $req->fetch();

        // Vérifier si une catégorie a été trouvée
        if ($categoryData) {
            // Créer et retourner un objet Category
            return new Category($categoryData['id'], $categoryData['name']);
        } else {
            return null; // Aucune catégorie trouvée pour cet ID
        }
    }

    public static function findByArticle($id) {
        $db = Connection::getConnection();
        $req = $db->prepare("SELECT * FROM categorie WHERE article = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        $categories = [];


        while ($row = $req->fetch()) {
            $category = new Category($row['id'], $row['libelle']);
            $categories[] = $category;
        }
        return $categories;
    }

    public function update() {
        $req = $this->db->prepare("UPDATE categorie SET libelle = :libelle WHERE id = :id");
        $req->bindParam(':libelle', $this->libelle);
        $req->bindParam(':id', $this->id);
        $req->execute();
    }

    
    
}