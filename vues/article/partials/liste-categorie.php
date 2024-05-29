<div>
    <nav >       
        <div class="text-primary" id="navbarNav">
            <ul class="flex w-66 mx-auto ul_categories">
                <li class="categorie" id="all"> 
                   
                    <a class="text-primary text-bold" href="/design_pattern/article">Accueil</a>
                </li>
                
                <?php foreach($categories as $categorie): ?>
                
                    <li class="categorie" id =<?=$categorie->getId()?>>
                        <a class="text-primary text-bold" 
                        href = "/design_pattern/article/articleCategorie/<?=$categorie->getId()?>"                        
                        ><?=$categorie->getLibelle()?></a>
                    </li>
                
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</div>