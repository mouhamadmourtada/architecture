<?php
namespace models\domaine;
use config\Connection;


abstract class Model{
    protected $id;
    protected $table;
    
    public function __construct($id = null){
        $this->id = $id;
        
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    abstract public function save();
    abstract public function delete();
    abstract public static function all();
    abstract public static function find($id);
    abstract public function update();

}