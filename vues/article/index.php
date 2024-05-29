<?php

require 'entete.php';
?>



<div>
</div>

<?php 
    require_once 'partials/liste-categorie.php';
?>

<div class="flex justify-between items-center w-95 mx-auto">
    <h1 class="text-primary">Liste des articles</h1>
    <div>
        <a href="/design_pattern/article/create" class="btn btn-primary">Ajouter un article</a>
    </div>

</div>

<?php 
?>
<div class="mx-auto">

    <?php if ( count($articles) == 0) { ?>
        <div class="text-center text-primary">Aucun article trouvé</div>
    <?php }else { ?>

    <table class="table mx-auto radius-t-l">
        <tr class="px-2 bg-secondary radius-t-l">
            <th class="px-2 py-5 radius-t-l" >Titre</th>
            <th class="px-2 py-5" >Contenu</th>
            <th class="px-2 py-5 noWrap" >Date de création</th>
            <th class="px-2 py-5 noWrap" >Date de modification</th>
            <!-- <th class="px-2 py-5 " class="col_categorie" >Catégorie</th> -->
        </tr>
        <?php foreach($articles as $article): ?>
        <tr class="article border border-gray">
            <td class="px-2 py-2 border border-gray"><?= $article->getTitre() ?></td>
            <td class="py-2 px-2 border border-gray" ><?= $article->getContenu() ?></td>
            <td class="py-2 px-2 border border-gray"><?= $article->getDateCreation() ?></td>
            <td class="py-2 px-2 border border-gray"><?= $article->getDateModification() ?></td>
            <!-- <td  class="col_categorie py-2 border border-gray"><?= $article->getCategorie() ?></td> -->
        </tr>
        <?php endforeach; ?>
    </table>

    <?php } ?>


</div>


<?php
require 'footer.php';

