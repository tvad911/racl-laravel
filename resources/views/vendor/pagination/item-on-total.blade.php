@if ($paginator->hasPages())
    {!! Backend::items_on_totals($paginator) !!}
@endif