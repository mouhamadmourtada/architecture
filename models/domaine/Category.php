<?php

namespace models\domaine;
use models\dao\CategoryDao;


class Category extends Model {
    
    protected $id;
    private $libelle;
    private $dao = null;
    
    public function __construct($id, $libelle) {
        $this->id = $id;
        $this->libelle = $libelle;

        $this->dao = new CategoryDao();
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
        $this->dao->save($this);
    }

    public function delete() {
        $this->dao->delete($this);
    }

    public static function all() {
        $dao = new CategoryDao();
        return $dao->all();
    }

    public static function find($id) {
        $dao = new CategoryDao();
        return $dao->find($id);
    }

    public static function findByArticle($id) {
        return "findByArticle";
    }

    public function update() {
        $this->dao->update($this);
    }

    
    
}