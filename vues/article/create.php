<?php
// require './base.php';
require "entete.php";

?>
<div class="w-95 mx-auto m-10">
    create article
    <div class="w-100 border border-gray radius-10 my-5">
        <form action="/design_pattern/article/store" method="post">
            <div class="flex wrap">
                <div class="input_container">
                    <div class="w-100">
                        <label class="text-left" for="titre">Titre</label>
                    </div>
                    <input class="input" type="text" name="titre" id="titre">
                </div>

                <div class="input_container">
                    <div class="w-100">
                        <label for="categorie">Catégorie</label>

                    </div>
                    
                    <select class="input text-black" name="categorie" id="categorie">
                        <?php foreach($categories as $categorie): ?>
                            <option value="<?=$categorie->getId()?>"><?=$categorie->getLibelle()?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>
            <div class="input_container">
                <div class="w-100">
                    <!-- <label for="contenu">Contenu</label> -->

                </div>
                <textarea class="input w-75" rows="15"  name="contenu" id="contenu" placeholder="veuillez saisir la description de l'article"></textarea>
            </div>

            <div class="flex justify-end mx-10">
                <button class="btn btn-primary" type="submit">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<?php
require "footer.php";