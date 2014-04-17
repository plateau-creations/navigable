<?php
namespace Plateau\Navigable\Menus;

use Illuminate\Support\Collection;
use Plateau\Navigable\Contracts\NavigableInterface;

class Item implements NavigableInterface {

	protected $app;

	// The Menu Text
	protected $label;
	
	// Laravel Route Name
	protected $routeName;
	
	// Active State
	protected $isActive = false;

	// Item's Link
	protected $link;
	
	// Child Items
	protected $items = array();

	// Menu optionnal attributes, eg CSS Classes.. 
	protected $attributes = array();

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function addItem(NavigableInterface $item)
	{
		/*if (! $item instanceof Traversable) {
			throw new \InvalidArgumentException('Object of type '.get_class($item).' must be Iterable');
		}*/
		$this->items[] = $item;
	}

	public function hasChilds()
	{
		return (count($this->items) > 0);
	}

	public function getChilds()
	{
		return $this->items;
	}

	public function isActive()
	{
		return $this->isActive;
	}

	// Setters
	// 
	public function setActive()
	{
		$this->isActive = true;
	}

	public function setLabel($label)
	{
		$this->label = $label;
	}

	public function setRouteName($name)
	{
		$this->routeName = $name;
	}

	public function setLink($link)
	{
		$this->link = $link;
	}

	//
	public function getLink()
	{
		if(isset($this->link))
		{
			return $this->link;
		}
		if(isset($this->routeName))
		{
			$this->app->make('url')->route($this->routeName);
		}
		// Default return '#'
		return '#';
	}

	public function getLabel()
	{
		return $this->label;
	}


	/**
	 * Dynamically retrieve attributes on the menu item.
	 *
	 * @param  string  $key
	 * @return mixed
	 */
	public function __get($key)
	{
		switch ($key)
		{
			case 'link': 
				return $this->getLink();
				break;

			case 'label':
				return $this->getLabel();
				break;

			case 'active':
				return $this->isActive ? true : false;
				break;

			default:
				if (array_key_exists($key, $this->attributes))
				{
					return $this->attributes[$key];
				}
				else
				{
					throw new \InvalidArgumentException(' property '.$key." doesn't exists");
				}
		}
		
	}

	public function __set($key, $value)
	{
		switch ($key)
		{
			case 'link': 
				$this->setLink($value);
				break;

			case 'label':
				$this->setLabel($value);
				break;

			case 'active':
				if ($value) $this->setActive();
				break;

			default:
				$this->attributes[$key] = $value;
		}
	}

}