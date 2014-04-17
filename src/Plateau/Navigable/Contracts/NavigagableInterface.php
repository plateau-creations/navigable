<?php
namespace Plateau\Navigable\Contracts;

interface NavigableInterface {
	
	/**
	 * Check if Navigable Item has childs 
	 * @return boolean [description]
	 */
	public function hasChilds();

	/**
	 * [getChilds description]
	 * @return Array
	 */
	public function getChilds();

	public function getLink();

	public function getLabel();

	public function getAttributes();

	public function isActive();

}