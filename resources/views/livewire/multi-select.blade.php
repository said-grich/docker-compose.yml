<div>
    <select class="selectpicker form-control" id="{{$selectId}}" title="{{$selectTitle}}" data-live-search="true" data-hide-disabled="true" {{$selectType}}>
        @foreach($selectOptions as $item)
            <option @if($selected == $item->id) {{'selected'}} @endif>{{$item->nom}}</option>
        @endforeach
    </select>
</div>

<script>
$(document).ready(function(){
    $('.selectpicker#{{$selectId}}').selectpicker();
});
</script>
