<ul>
	@foreach($menu->getChilds() as $item)

		@if($item->hasChilds())
		<li>
			<a href='{{item->link}}'>{{$item->label}}</a>
			@include('navigable.navigable', array('menu' => $item))
		</li>
	
		@else
		<li>
			<a href='{{item->link}}'>{{$item->label}}</a>
		</li>
		@endif
	@endforeach
</ul>
