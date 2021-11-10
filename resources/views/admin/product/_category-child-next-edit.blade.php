@foreach($allChildren as $child)
    <option
        value="{{ $child->id }}" {{ $child->id == $product->category_id ? 'selected' : '' }}>
        {{ '-- ' . $child->category_name }}
    </option>
    @if($child->allChildren->count())
        @include('admin.product._category-child-next-edit', ['allChildren' => $child->allChildren])
    @endif
@endforeach
