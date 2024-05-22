<?php

namespace models\dao;
use config\Connection;
use models\domaine\Category;

class CategoryDao extends ModelDao {

    public function all() {
        $req = $this->db->prepare("SELECT * FROM categorie");
        $req->execute();
        $categories = [];

        while ($row = $req->fetch()) {
            $category = new Category($row['id'], $row['libelle']);
            $categories[] = $category;
        }
        return $categories;
    }



    public function find($id) {
        $req = $this->db->prepare("SELECT * FROM categorie WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        $row = $req->fetch();
        $category = new Category($row['id'], $row['libelle']);
        return $category;
    }


    


    
    public function save($category) {
        $req = $this->db->prepare("INSERT INTO categorie (libelle) VALUES (:libelle)");
        $req->bindParam(':libelle', $category->getLibelle());
        $req->execute();
    }


    
    public function update($category) {
        $req = $this->db->prepare("UPDATE categorie SET libelle = :libelle WHERE id = :id");
        $req->bindParam(':libelle', $category->getLibelle());
        $req->bindParam(':id', $category->getId());
        $req->execute();
    }



    public function delete($category) {
        $req = $this->db->prepare("DELETE FROM categorie WHERE id = :id");
        $req->bindParam(':id', $category->getId());
        $req->execute();
    }






}