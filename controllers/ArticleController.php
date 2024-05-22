<?php

namespace controllers;
use models\domaine\Article;
use models\domaine\Category;

class ArticleController extends Controller {


    public function index() {
        $articles = Article::all();
        $categories = Category::all();
        $this->view('article/index', [
            'articles' => $articles,
            "categories" => $categories,
        ]);
    }



    public function show($id) {
        $article = Article::find($id);
        $this->view('article/show', ['article' => $article]);
    }



    public function create() {
        $categories = Category::all();
        $this->view('article/create', ['categories' => $categories]);
    }



    public function store() {
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $categorie = $_POST['categorie'];
        $article = new Article(null, $titre, $contenu, null, null, $categorie);
        $article->save();
        $this->redirect('article');
    }



    public function edit($id) {
        $article = Article::find($id);
        $categories = Category::all();
        $this->view('article/edit', ['article' => $article, 'categories' => $categories]);
    }



    public function update($id) {
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $categorie = $_POST['categorie'];
        $article = Article::find($id);
        $article->setTitre($titre);
        $article->setContenu($contenu);
        $article->setCategorie($categorie);
        $article->update();
        $this->redirect('article');
    }



    public function destroy($id) {
        $article = Article::find($id);
        $article->delete();
        $this->redirect('article');
    }



}