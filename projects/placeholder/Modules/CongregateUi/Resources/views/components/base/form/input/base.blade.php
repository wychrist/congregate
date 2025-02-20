@if($label)
@if($row_col === 'row')
<div class="form-group row">
    <label for="{{$id}}" class="col-sm-{{$label_row_width}} col-form-label $label_classes">{{$label}}</label>
    <div class="col-sm-{{strval(12 - (intval($label_row_width)))}}">
        @else
        <div>
            <label for="{{$id}}" <?= empty($label_classes) ? '' : 'class="' . $label_classes . '"' ?>>{{$label}}</label>
            @endif
            @endif
            <input {{$attributes->get('disabled') ? 'disabled' :''}} type="{{$type}}" name="{{$name}}" id="{{$id}}" <?= $placeholder ? 'placeholder=' . $placeholder : '' ?> class="form-control {{$input_classes}}" />
            @if($label)
            @if($row_col === 'row')
        </div>
        @endif
    </div>
    @endif