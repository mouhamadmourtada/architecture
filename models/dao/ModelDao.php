<?php

namespace models\dao;
use config\Connection;

abstract class ModelDao {

    // il faut mettre le constructeur qui s'occupe de recupérer la connexion
    protected $db;

    public function __construct(){
        $this->db = Connection::getConnection();
    }

}