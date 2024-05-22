<?php

require 'entete.php';
?>



<div>
</div>

<?php 
    require_once 'partials/liste-categorie.php';
?>

<h1>Liste des articles</h1>
<div class="table mx-auto">
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

</div>


<?php
require 'footer.php';

