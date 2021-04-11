<div>
    <select class="selectpicker form-control" id="{{$selectId}}" title="{{$selectTitle}}" data-live-search="true" data-hide-disabled="true" {{$selectType}}>
        @foreach($selectOptions as $item)
            <option>{{$item->preparation->nom}}</option>
        @endforeach
    </select>
</div>

<script>
$(document).ready(function(){
    $('.selectpicker#{{$selectId}}').selectpicker();
});
</script>
