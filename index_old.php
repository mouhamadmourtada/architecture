    <?php
        // namespace design_pattern;
        spl_autoload_register(function ($class) {
            // Définissez le chemin de base de vos classes
            // $baseDir = __DIR__ . '$_SERVER["DOCUMENT_ROOT"]/design_pattern/';
            $baseDir = $_SERVER["DOCUMENT_ROOT"] . '/design_pattern/';
            // echo $baseDir;

            // Remplacez "MonNamespace\\" par le namespace de vos classes
            $prefix = '';
        
            // Vérifie si la classe utilise le préfixe du namespace spécifié
            $len = strlen($prefix);
            if (strncmp($prefix, $class, $len) !== 0) {
                return; // La classe ne correspond pas au préfixe du namespace spécifié
            }
        
            // Détermine le chemin relatif de la classe
            $relativeClass = substr($class, $len);
        
            // Construit le chemin complet du fichier de la classe
            $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
        
            // Vérifie si le fichier de la classe existe et le charge
            if (file_exists($file)) {
                require $file;
            }
        });
        
        use models\Category;
        use models\Article;

        use vues\layouts\Layout;


        $categories = Category::all();
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="./assets/styles/app.css">
        <!-- il faut recupérer le repertoire de base de l'application -->
        <!-- <link rel="stylesheet" href="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/design_pattern/assets/styles/app.css'; ?>"> -->
    </head>
    <body>

        <div class="main">
            <?php
            
                Layout::showHeader($categories);
                Layout::showListeArticles();

            ?>
        </div>
        


        <script src="./assets/scripts/app.js"></script>
    </body>
    </html>