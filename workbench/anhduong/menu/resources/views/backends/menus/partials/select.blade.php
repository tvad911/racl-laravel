<ul class="list-item">
@foreach ($object as $key => $row)
    <li>
    <a data-title="{{ $row->name }}" data-relatedid="{{ ($row->id) }}" data-type="{{ $type }}" href="#">{{ $row->name }}</a>
    {!! Menu::generateSelect($object, $type, $row->id, $row->status) !!}
    </li>
@endforeach
</ul>