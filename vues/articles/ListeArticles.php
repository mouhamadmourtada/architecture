<?php
namespace vues\articles;
use models\Article;

// this a vue that show a table of articles, we must have a function to get the liste of articles

trait ListeArticles{


    static function showListeArticles(){
        $articles = Article::all();
        ?>

        <h1>Liste des articles</h1>
        <table>
            <tr>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date de création</th>
                <th>Date de modification</th>
                <th class="col_categorie">Catégorie</th>
            </tr>
            <?php foreach($articles as $article): ?>
            <tr class="article">
                <td><?= $article->getTitre() ?></td>
                <td><?= $article->getContenu() ?></td>
                <td><?= $article->getDateCreation() ?></td>
                <td><?= $article->getDateModification() ?></td>
                <td  class="col_categorie"><?= $article->getCategorie() ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php
    }

}

