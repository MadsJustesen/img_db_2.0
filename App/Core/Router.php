<?php
namespace App\Core;

use RuntimeException;

/*********************
*   IMPLEMENTATION   *
**********************
*
*	$router = new Router();
*
*	$router->addRoute('GET', '/', 'root');
*	$router->addRoute('GET', '/article/{name}[/{page:\d+}]', 'article');
*	$router->addRoute('POST', '/api', ['Controller', 'method']);
*
*	$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
*	$route = $router->match($_SERVER['REQUEST_METHOD'], $uri);
*
*********************/

class Router {

	private $routes = array();
	private $info = array();

	public function addRoute($method, $pattern, $handle) {
		$parseRegex = '/(?:\\{([a-zA-Z][a-zA-Z0-9_]*)(?:\\:((?:\\{[0-9,]+\\}|[^}])+))?\\}|([^{]+))/';
		$routeRegex = '';
		$parameters = [];

		preg_match_all($parseRegex, $pattern, $matches, PREG_SET_ORDER);

		foreach ($matches as $match) {
			if(isset($match[3])) {
				$routeRegex .= strtr($match[3], ['[' => '(?:', ']' => ')?']);
			} else {
				$parameters[] = $match[1];
				$routeRegex .= isset($match[2]) ? "({$match[2]})" : '([^/]+)';
			}
		}

		$this->routes[$method][] = '~^' . strtr($routeRegex, ['~' => '\\~']) . '$~';
        $this->info[$method][] = [
            'handle' => $handle,
            'parameters' => $parameters
        ];
	}

	public function match($method, $uri)
    {
        foreach ($this->routes[$method] as $i => $regex) {
            if (preg_match($regex, $uri, $matches)) {
                $info = $this->info[$method][$i];
                $arguments = [];
                $index = 1;

                foreach ($info['parameters'] as $name) {
                    if (!isset($matches[$index])) {
                        break;
                    }

                    $arguments[$name] = $matches[$index];
                    $index++;
                }

                return [
                    'handle' => $info['handle'],
                    'arguments' => $arguments
                ];
            }
        }
    }

}