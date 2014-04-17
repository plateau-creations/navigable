<ul>
	@foreach($menu->getChilds() as $item)

		@if($item->hasChilds() )
		<li>
			@include('navigable.navigable', array('menu' => $item))
		</li>
	
		@else
		<li>

		</li>
		@endif
	@endforeach
</ul>
