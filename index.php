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

use controllers\ArticleController;
use controllers\CategoryController;
use models\domaine\Category;
    use models\domaine\Article;




    $categories = Category::all();

    if(isset($_GET['action'])) {
        $articleController = new ArticleController();

        return $articleController->index();
    }
    echo "ngani"
?>
