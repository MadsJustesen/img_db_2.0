<?php
namespace App\Core;

use ReflectionClass;
use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;
use RuntimeException;

/*********************
*   IMPLEMENTATION   *
**********************
*
*	$container = new Container();
*
*	// Bind a factory function to a class
*	$container->bind('Foo', function () { return new Foo(); });
*
*	// Bind arguments to the constructor of a class
*	$container->bindArguments('Bar', ['name' => 'Bar', 'age' => 63]);
*
*	// Bind an instance to a class
*	$container->bindInstance('Tar', new Tar());
*
*	// Get a new or existing instance of a class depending on how it was binded
*	$foo = $container->get('Foo');
*
*	// Call a function and resolve it's parameters
*	$result = $container->call([$foo, 'method'], ['unresolvable' => 'argument']);
*
*********************/


class Container {

	private $arguments = array();
	private $factories = array();
	private $instances = array();
	private $singletons = array();

	public function __construct() {
		$this->instances[__CLASS__] = $this;
	}

	public function bind($class, callable $factory, $singleton = false) {
		$this->factories[$class] = $factory;

		if ($singleton) {
			$this->singletons[$class] = true;
		}
	}

	public function bindArguments($class, $arguments, $singleton = false) {
		$this->arguments[$class] = $arguments;

		if ($singleton) {
			$this->singletons[$class] = true;
		}
	}

	public function bindInstance($class, $instance) {
		$this->instances[$class] = $instance;
	}

	public function get($class) {
		if(isset($this->instances[$class])) {
			$object = $this->instances[$class];
		} else {
			$object = $this->create($class);
		}

		if(isset($this->singletons[$class])) {
			$this->instances[$class] = $object;
		}

		return $object;
	}

	public function call(callable $callable, array $arguments = []) {
		if(is_array($callable)) {
			$method = new ReflectionMethod($callable[0], $callable[1]);
		} else {
			$method = new ReflectionFunction($callable);
		}

		$arguments = $this->resolveParameters($method, $arguments);

		return call_user_func_array($callable, $arguments);
	}

	public function create($class, array $arguments = []) {
		$reflection = new ReflectionClass($class);

		if($method = $reflection->getConstructor()) {
			if(isset($this->arguments[$class])) {
				$arguments = array_merge($this->arguments[$class], $arguments);
			}

			if($arguments = $this->resolveParameters($method, $arguments)) {
				return $reflection->newInstanceArgs($arguments);
			}
		}

		return new $class();
	}

	private function resolveParameters(ReflectionFunctionAbstract $method, array $provided = []) {
		$arguments = [];
		$i = 0;

		foreach ($method->getParameters() as $parameter) {
			if(isset($provided[$parameter->name])) {
				$arguments[] = $provided[$parameter->name];

			} elseif (isset($provided[$i])) {
				$arguments[] = $provided[$i];
				$i++;

			} elseif($type = $parameter->getClass()) {
				$arguments[] = $this->get($type->name);

			} elseif ($parameter->isDefaultValueAvailable()) {
				$arguments[] = $parameter->getDefaultValue();

			} elseif ($parameter->isOptional()) {
				break;

			} else {
				throw new RuntimeException('Unable to resolve parameter "$' . $parameter->name . '" of ' . (string)$method);
			}
		}

		return $arguments;
	}
}