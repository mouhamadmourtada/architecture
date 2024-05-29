<?php

namespace controllers;

use models\domaine\Category;

class CategoryController extends Controller {
    
        public function index() {
            $categories = Category::all();
            $this->view('category/index', ['categories' => $categories]);
        }
    
        public function show($id) {
            $category = Category::find($id);
            $this->view('category/show', ['category' => $category]);
        }
    
        public function create() {
            $this->view('category/create');
        }
    
        public function store() {
            $libelle = $_POST['libelle'];
            $category = new Category(null, $libelle);
            $category->save();
            $this->redirect('category');
        }
    
        public function edit($id) {
            $category = Category::find($id);
            $this->view('category/edit', ['category' => $category]);
        }
    
        public function update($id) {
            $libelle = $_POST['libelle'];
            $category = Category::find($id);
            $category->setLibelle($libelle);
            $category->update();
            $this->redirect('category');
        }
    
        public function destroy($id) {
            $category = Category::find($id);
            $category->delete();
            $this->redirect('category');
        }
}