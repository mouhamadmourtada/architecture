<?php
namespace vues\layouts;
// this is a function that will be uses to show the header of the website, it take the libelle of the categories as parameter
trait Header{
    static function showHeader($categories){
        ?>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">MG-LSI News</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item categorie" id="all"> Accueil</li>
                        <?php foreach($categories as $categorie): ?>
                        <li class="nav-item categorie" id =<?=$categorie->getId()?>>
                            <a class="nav-link" href="#"><?php echo $categorie->getLibelle(); ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
    }

}
