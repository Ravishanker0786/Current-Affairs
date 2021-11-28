<div class="quiz_rem">
    <input type="hidden"  name="in_id"
                    value="{{ $insight->in_id ?? '' }}">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                Background
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <input type="text" class="form-control is-warning validate" name="in_background"
                    value="{{ $insight->in_background ?? '' }}">
            </div>
        </div>
    </div>
@php
$count = count($insight->in_data??[]);
@endphp
@forelse ($insight->in_data??[] as $key => $item)
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            URL
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="text" class="form-control is-warning validate" name="in_data[]"
                value="{{ $item }}">
        </div>
    </div>
    
    <div class="col-md-1">
        <div class="form-group">
            <i class="fas fa-window-close"></i>
        </div>
    </div>
    @if ($key + 1 == $count)
        <div class="col-md-1">
            <div class="form-group">
                <i class="fa fa-plus-square"></i>
            </div>
        </div>
    @endif
</div>
@empty
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            URL
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <input type="text" class="form-control is-warning validate" name="in_data[]"
                value="">
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group">
            <i class="fas fa-window-close"></i>
        </div>
    </div>
    <div class="col-md-1">
        <div class="form-group">
            <i class="fa fa-plus-square"></i>
        </div>
    </div>
</div>
@endforelse
</div>