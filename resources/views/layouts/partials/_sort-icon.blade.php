@if ($sortBy !== $field)
    <i  class="flaticon2-arrow-up icon-sm text-muted"></i>
@elseif ($sortDirection == 'asc')
    <i class="flaticon2-arrow-up icon-sm text-primary"></i>
@else
    <i class="flaticon2-arrow-down icon-sm text-primary"></i>
@endif