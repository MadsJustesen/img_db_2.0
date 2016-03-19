<?php
use App\Core\Autoloader;
use App\Core\Container;
use App\Core\Router;

/*************
*   CONFIG   *
*************/

error_reporting(-1);

// dev only
ini_set('display_errors', 1);

define('VIEW_DIR', realpath(__DIR__ . '/../views'));
define('CONFIG_DIR', realpath(__DIR__ . '/../config/'));


/***********
*   INIT   *
***********/

session_start();

require __DIR__ . '/../App/Core/Autoloader.php';

require CONFIG_DIR . '/db.php';
$dbh = new PDO('mysql:host=127.0.0.1;dbname=' . $db_name, $db_user, $db_pass);
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$loader = new Autoloader();
$loader->addNamespace('App', __DIR__ . '/../App');
$loader->register();

$container = new Container();
$container->bindArguments('App\\Model\\User', ['dbh' => $dbh]);

/**************
*   ROUTING   *
**************/

$router = new Router();
$router->addRoute('GET', '/',			['App\\Controller\\SessionController',	"redirect"	]);
$router->addRoute('GET', '/log_in',		['App\\Controller\\SessionController',	"newSession"]);
$router->addRoute('GET', '/log_out',	['App\\Controller\\SessionController',	"destroy"	]);
$router->addRoute('GET', '/sign_up',	['App\\Controller\\UserController', 	"signUp"	]);
$router->addRoute('GET', '/users' ,		['App\\Controller\\UserController',		"users"		]);

$router->addRoute('POST', '/log_in',	['App\\Controller\\SessionController', 	"create"	]);
$router->addRoute('POST', '/sign_up',	['App\\Controller\\UserController', 	"create"	]);

// Convert i.e. "/foo%40bar?id=1" to "/foo@bar"
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$route = $router->match($_SERVER['REQUEST_METHOD'], $uri);

if ($route === null) {
    $route = [
        'handle' => ['App\\Controller\\ErrorController', 'error404'],
        'arguments' => []
    ];
}

$controller = $container->create($route['handle'][0]);
$container->call([$controller, $route['handle'][1]], $route['arguments']);