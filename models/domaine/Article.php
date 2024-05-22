<?php

namespace models\domaine;
use models\dao\ArticleDao;

class Article extends Model{
    
    protected $id;
    private $titre;
    private $contenu;
    private $dateCreation;
    private $dateModification;
    private $categorie;

    private $dao = null;
    
    public function __construct($id, $titre, $contenu, $dateCreation, $dateModification, $categorie) {
        $this->id = $id;
        $this->titre = $titre;
        $this->contenu = $contenu;
        $this->dateCreation = $dateCreation;
        $this->dateModification = $dateModification;
        $this->categorie = $categorie;

        $this->dao = new ArticleDao();
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
        $this->dao->save($this);
    }

    public function delete(){
        $this->dao->delete($this);
    }
    

    public static function all(){
        $dao = new ArticleDao();
        return $dao->all();
    }

    public static function find($id){
        $dao = new ArticleDao();
        return $dao->find($id);
    }


    public static function findByCategory($id){
        $dao = new ArticleDao();
        return $dao->findByCategory($id);
    }


    public static function findByTitle($title){
        return "findByTitle";
    }

    public static function findByContent($content){
        return "findByContent";
    }

    public function update(){
        $this->dao->update($this);
    }
    
}