<?php
namespace Plateau\Navigable\Menus;

use Plateau\Navigable\Contracts\NavigableInterface;

class Menu {

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

}