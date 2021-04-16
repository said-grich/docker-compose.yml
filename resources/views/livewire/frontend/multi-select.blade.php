<div wire:ignore>
    <select class="selectpicker form-control" id="{{$selectId}}" title="{{$selectTitle}}" data-live-search="true" data-hide-disabled="true" {{$selectType}} wire:model="test.{{$key}}">
        @foreach($selectOptions as $item)
        @if($item->preparation->mode_preparation_id == $mode)
            <option>{{$item->preparation->nom}}</option>
        @endif
        @endforeach
    </select>
</div>

<script>
$(document).ready(function(){
    $('.selectpicker#{{$selectId}}').selectpicker();
});
</script>
