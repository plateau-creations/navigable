<?php
namespace Plateau\Navigable\Menus;

use Plateau\Navigable\Contracts\NavigableInterface;

class Builder {

	protected $rootItem;
	
	protected $filters = array();

	public function __construct()
	{
		$this->rootItem = new Item();
	}

	public function addItem(NavigableInterface $item)
	{
		$this->rootItem->addItem($item);
	}

	/**
	 * Add a filter to the menu items
	 * @param Closure $filter [description]
	 */
	public function addFilter(Closure $filter)
	{
		$this->filters[] = $filter;
	}


	/* Build the menu
	* @return [array] of Navigable Objects
	*/
	public function build()
	{
		$menuItems = array();

		foreach($this->rootItem as $item)
		{
			$menuItems[] = $filteredItem;
		}

		return $menuItems;
	}

	protected function filter(NavigableInterface $item)
	{
		if( $item->hasChilds() )
		{
			foreach($item->getChilds() as $subItem)
			{
				if ($this->filter($subItem))
				{
				}
			}
		}
	}


	/**
	 * Convert Any NavigableInterface object to an array
	 * @param  NavigableInterface $item [description]
	 * @return [type]                   [description]
	 */
	protected function toArray(NavigableInterface $item)
	{
		$itemArray = array();

		$itemArray['link'] = $item->getLink();
		$itemArray['label'] = $item->getLabel();
		$itemArray['active'] = $item->isActive();
		$itemArray['link'] = $item->getLink();
		
		foreach($item->getAttributes() as $key->value)
		{
			$itemArray[$key] = $value;
		}
		
		if ($item->hasChilds() )
		{
			foreach ($item->getChilds() as $child)
			{
				$itemArray['childs'][] = $this->toArray($child);
			}
		}
		return $itemArray;
	}
}