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

define('SCRIPT_DEBUG', true);
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
$container->bindArguments('App\\Model\\User', 	['dbh' => $dbh]);
$container->bindArguments('App\\Model\\Image', 	['dbh' => $dbh]);

/**************
*   ROUTING   *
**************/

$router = new Router();
$router->addRoute('GET', '/',		   		         ['App\\Controller\\SessionController', "redirect"	]);
$router->addRoute('GET', '/log_in',	  		         ['App\\Controller\\SessionController', "newSession"]);
$router->addRoute('GET', '/log_out',   		         ['App\\Controller\\SessionController', "destroy"   ]);
$router->addRoute('GET', '/sign_up',   		         ['App\\Controller\\UserController',    "signUp"	]);
$router->addRoute('GET', '/edit_user', 		         ['App\\Controller\\UserController',    "edit"		]);
$router->addRoute('GET', '/account',   		         ['App\\Controller\\UserController',    "account"	]);
$router->addRoute('GET', '/users' ,	   		         ['App\\Controller\\UserController',	"users"		]);
$router->addRoute('GET', '/upload',	   		         ['App\\Controller\\ImageController',   "upload"	]);
$router->addRoute('GET', '/gallery',   		         ['App\\Controller\\ImageController',   "gallery"	]);

$router->addRoute('POST', '/log_in',   		         ['App\\Controller\\SessionController', "create"	]);
$router->addRoute('POST', '/sign_up',  		         ['App\\Controller\\UserController',    "create"	]);
$router->addRoute('POST', '/delete_user',  	         ['App\\Controller\\UserController',    "destroy"	]);
$router->addRoute('POST', '/edit_user',		         ['App\\Controller\\UserController',    "update"	]);
$router->addRoute('POST', '/upload',   		         ['App\\Controller\\ImageController',   "save"		]);
$router->addRoute('POST', '/delete_image',  		 ['App\\Controller\\ImageController',   "destroy"	]);
$router->addRoute('POST', '/update_new_image_title', ['App\\Controller\\ImageController', "saveNewTitle"]);

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