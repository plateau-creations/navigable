<?php
namespace Plateau\Navigable;
use Illuminate\Support\Facades\Facade;

class NavigableFacade extends Facade {
	
	 /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'navigable'; }
}