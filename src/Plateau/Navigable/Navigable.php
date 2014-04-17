<?php
namespace Plateau\Navigable;

use Plateau\Navigables\Menus\Builder;

class Navigable {
	
	protected $menus;

	public function menu($key)
	{
		if (array_key_exists($key, $this->menus))
		{
			return $this->menus[$key];
		}
		else
		{
			$this->menus[$key] = new Builder();
			return $this->menus[$key];
		}
	}

	
}