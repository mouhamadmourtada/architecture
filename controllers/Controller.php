<?php

namespace controllers;

abstract class Controller {

    protected function view($view, $data = []) {
        extract($data);
        
        require_once 'vues/' . $view . '.php';
    }

    protected function redirect($route) {
        header('Location: ' . $route);
    }

}