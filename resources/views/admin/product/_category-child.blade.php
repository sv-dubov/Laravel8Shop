@foreach($allChildren as $child)
    <option value="{{ $child->id }}" @if(old('category_id') == $child->id) selected="selected" @endif>
        {{ '- ' . $child->category_name }}
    </option>
    @if($child->allChildren->count())
        @include('admin.product._category-child-next', ['allChildren' => $child->allChildren])
    @endif
@endforeach
