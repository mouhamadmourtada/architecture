<header>
    <nav class="">       
        <div class="" id="navbarNav">
            <ul class="flex w-66 mx-auto">
                <li class="categorie" id="all"> Accueil</li>
                
                <?php foreach($categories as $categorie): ?>
                
                    <li class="categorie" id =<?=$categorie->getId()?>>
                        <a class="" href="#"><?=$categorie->getLibelle()?></a>
                    </li>
                
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</header>