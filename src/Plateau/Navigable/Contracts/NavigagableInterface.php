<?php
namespace Plateau\Navigable\Contracts;

interface NavigableInterface {
	
	public function hasChilds();

	public function getChilds();

	public function getLink();

	public function getLabel();

	public function isActive();
	
}