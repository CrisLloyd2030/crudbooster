<div class='form-group {{$header_group_class}} {{ ($errors->first($name))?"has-error":"" }}' id='form-group-{{$name}}' style="{{@$form['style']}}">
    <label class='control-label col-sm-2'>{{$form['label']}}
        @if($required)
            <span class='text-danger' title='{!! cbLang('this_field_is_required') !!}'>*</span>
        @endif
    </label>

    <div class="{{$col_width?:'col-sm-10'}}">
        <div class="input-group">
            <span class="input-group-addon" style="border-top-left-radius: 7px; border-bottom-left-radius: 7px;"><i class="fa fa-envelope"></i></span>
            <input type="email" name="{{$name}}" style="display: none">
            <input type='email' style="border-top-right-radius: 7px; border-bottom-right-radius: 7px;" title="{{$form['label']}}"
                   {{$required}} {{$readonly}} {!!$placeholder!!} {{$disabled}} {{$validation['max']?"maxlength=".$validation['max']:""}} class='form-control'
                   name="{{$name}}" id="{{$name}}" value='{{$value}}'/>
        </div>
        <div class="text-danger">{!! $errors->first($name)?"<i class='fa fa-info-circle'></i> ".$errors->first($name):"" !!}</div>
        <p class='help-block'>{{ @$form['help'] }}</p>
    </div>
</div>