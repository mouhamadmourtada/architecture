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
use exceptions\NotFound;
use controllers\ExceptionController;


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
            "edit" => ["edit", 
                "params" => ["id" => 1]
            ],
            "update" => ["update",
                "params" => ["id" => 1]
            ],
            "delete" => ["destroy",
                "params" => ["id" => 1],
            ],
            "show" => ["show",
            
                "params" => ["id" => 1]
            ],
            "articleCategorie" => ["articleCategorie",
                "params" => ["categorie_id" => 1]
            ]
        ]
    ],
    [
        "path" => "category",
        "controller" => CategoryController::class,
        "children" =>
        [
            "" => "index",
            "index" => "index",
            "create" => "create",
            "store" => "store",
            "edit" => ["edit", 
                "params" => ["id" => 1]
            ],
            "update" => ["update",
                "params" => ["id" => 1]
            ],
            "delete" => ["destroy",
                "params" => ["id" => 1],
            ],
            "show" => ["show",
            
                "params" => ["id" => 1]
            ]
        ]
    ]

];

function findParams($route,  $routeElements, $index = 0) {
    $params = $route["params"];
    $params = array_slice($routeElements, $index);
    return $params;
    
}



    $controller = null;
    $action = "index";
    $params = [];


    $routeElements = explode('/', $_SERVER['REQUEST_URI']);
    if($routeElements[count($routeElements) - 1] == "") {
        array_pop($routeElements);
    }

   
    function findControllerActionParams($routeElements, $routes) {
        $controller = null;
        $action = "index";
        $params = [];

        for($i = 1; $i < count($routeElements); $i++) {
            foreach($routes as $route) {
                if($route['path'] == $routeElements[$i]) {
                    
                    $controller = $route['controller'];
                    

                    if(count($routeElements) == $i + 1) {
                        $action = "index";
                        return [$controller, $action, $params];
                    }

                    if( !isset($route['children'][$routeElements[$i + 1]]) ) {
                        throw new NotFound($message = "Page not found", $code = 404, $previous = null);
                    }
                    $action = $route['children'][$routeElements[$i + 1]];
                    
                    if(is_array($action)) {
                        $params = findParams($route['children'][$routeElements[$i + 1]], $routeElements, $i + 2);
                        $action = $action[0];
                    }
                    return [$controller, $action, $params];
                }
            }
        }

        return [$controller, $action, $params];
    }
    
    try {


        list($controller, $action, $params) = findControllerActionParams($routeElements, $routes);
        
        
    } catch (NotFound $th) {
        $controller = new ExceptionController();
        return $controller->notFound();
    }
    
    
    
    
    if(!$controller) {
        $controller = new ExceptionController();
        return $controller->notFound();
    }
    
    
    
    // print_r($params);
    try {
        $controller = new $controller();
        call_user_func_array([$controller, $action], $params);

    } catch (\Throwable $th) {
        echo $th;
        $controller = new ExceptionController();
        return $controller->notFound();

    }

 
    // call_user_func_array([$controller, $action], $params);

    

 
?>
