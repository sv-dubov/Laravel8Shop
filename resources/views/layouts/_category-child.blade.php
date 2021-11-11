<ul class="cat_child_menu">
    @foreach($allChildren as $child)
        <li class="hassubs">
            @if($child->allChildren->isNotEmpty())
                <a href="{{ url('categories/'.$child->id) }}">{{ $child->category_name }}
                    <i class="fas fa-chevron-right"></i></a>
                @include('layouts._category-child', ['allChildren' => $child->allChildren])
            @elseif($child->allChildren->isEmpty())
                <a href="{{ url('categories/'.$child->id) }}">{{ $child->category_name }}</a>
            @endif
        </li>
    @endforeach
</ul>
