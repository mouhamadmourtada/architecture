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


$routes = [
    [
        "path" => "article",
        "controller" => "controllers\ArticleController",
        "children" =>
        [
            "" => "index",
            "index" => "index",
            "create" => "create",
            "store" => "store",
            "edit/{id}" => "edit",
            "update/{id}" => "update",
            "delete{id}" => "delete",
            "show/{id}" => "show"
        ]
    ],
    [
        "path" => "category",
        "controller" => "controllers\CategoryController",
        "children" =>
        [
            "" => "index",
            "index" => "index",
            "show" => "show",
            "create" => "create",
            "store" => "store",
            "edit" => "edit",
            "update" => "update",
            "delete" => "delete"
        ]
    ]

];

function findParams($route,  $routeElements, $index = 0) {
    $params = [];

    for($i = 1; $i < count($routeElements); $i++) {
        
        if(strpos($route['path'], '{') !== false) {
            $params[] = $routeElements[$i];
        }
    }
    return $params;
}


    $controller = null;
    $action = "index";
    $params = [];

    $categories = Category::all();
    // echo $_SERVER['REQUEST_URI'];

    $routeElements = explode('/', $_SERVER['REQUEST_URI']);

    // il faut parcours les routes
    for($i = 1; $i < count($routeElements)-1; $i++) {
        foreach($routes as $route) {

            if($route['path'] == $routeElements[$i]) {
                echo count( $routeElements );
                echo '<br>';
                echo $i;
                $controller = $route['controller'];

                $action = $route['children'][$routeElements[$i + 1]];
                // if( count( $routeElements ) <= ($i) ) 
                $params = findParams($route, $routeElements);               
                break;
            }
        }
    }



    if(!$controller) {
        echo "404";
        return;
    }


   $controller = new $controller();

    // il faut trouver un moyen de passer en parametre les params

    // $controller->$action();
    call_user_func_array([$controller, $action], $params);

    

    // if(isset($_GET['action'])) {

    //     // il faut retourner l'ur
    //     // il faut afficher l'url
    //     // comment recupérer l'url ?
    //     echo $_SERVER['REQUEST_URI'];
    //     return;

    //     $articleController = new ArticleController();

    //     return $articleController->index();
    // }
    // echo "ngani"
?>
