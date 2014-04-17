<?php

namespace HieuLe\Active;

use Illuminate\Routing\Router;
use \Illuminate\Support\Str;

/**
 * The helper class for Laravel 4 applications to get active class base on current route
 *
 * @author Hieu Le
 */
class Active
{
    /*
     * @var \Illuminate\Routing\Router
     */
    protected $router;

    public function __construct(Router $router)
    {
	   $this->router = $router;
    }

    /**
     * Return 'active' class if current route match a pattern
     * 
     * @param string|array $patterns
     * @param string $class
     * @return string
     */
    public function pattern($patterns, $class = 'active')
    {
    	$uri = $this->router->current()->getUri();
    	if (!is_array($patterns))
    	    $patterns = array($patterns);
    	foreach ($patterns as $p)
    	{
    	    if (str_is($p, $uri))
    		return $class;
    	}
    	return '';
    }

    /**
     * Return 'active' class if current route name match one of provided names
     * 
     * @param string|array $names
     * @param string $class
     * @return string
     */
    public function route($names, $class = 'active')
    {
    	$routeName = $this->router->current()->getName();
    	if (!$routeName)
    	    return '';
    	if (!is_array($names))
    	    $names = array($names);
    	if (in_array($routeName, $names))
    	    return $class;
    	return '';
    }

    /**
     * Return 'active' class if current route action match one of provided action names
     * 
     * @param string|array $actions
     * @param string $class
     * @return string
     */
        public function action($actions, $class = 'active')
        {
    	$routeAction = $this->router->current()->getActionName();
    	if (!is_array($actions))
    	    $actions = array($actions);
    	if (in_array($routeAction, $actions))
    	    return $class;
    	return '';
    }

    /**
     * Return 'active' class if current controller match a controller name and 
     * current method doest not belong to excluded methods. The controller name 
     * and method name are gotten from <code>getController</code> and <code>getMethod</code>.
     * 
     * @param string $controller
     * @param string $class
     * @param array $excludedMethods
     * @return string
     */
        public function controller($controller, $class = 'active', $excludedMethods = array())
        {
    	$currentController = $this->getController();
    	if ($currentController !== $controller)
    	    return '';
    	$currentMethod = $this->getMethod();
    	if (in_array($currentMethod, $excludedMethods))
    	    return '';
    	return $class;
    }

    /**
     * Return 'active' class if current controller name match one of provided
     * controller names.
     * 
     * @param array $controllers
     * @param string $class
     * @return string
     */
    public function controllers(array $controllers, $class = 'active')
    {
    	$currentController = $this->getController();
    	if (in_array($currentController, $controllers))
    	    return $class;
    	return '';
    }

    /**
     * Get the current controller name with the suffix 'Controller' trimmed
     * 
     * @return string|null
     */
    public function getController()
    {
    	$action = $this->router->current()->getActionName();
    	if ($action)
    	    return head(str_replace('Controller', '', Str::parseCallback($action, null)));
    	return null;
    }

    /**
     * Get the current method name with the prefix 'get', 'post', 'put', 'delete', 'show' trimmed
     * 
     * @return string|null
     */
    public function getMethod()
    {
    	$action = $this->router->current()->getActionName();
    	if ($action)
    	    return last(str_replace(array('get', 'post', 'put', 'delete', 'show'), '', Str::parseCallback($action, null)));
    	return null;
    }

}

