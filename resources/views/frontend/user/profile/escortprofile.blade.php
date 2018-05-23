 <?php 
function in_array_field($needle, $needle_field, $haystack, $strict = false) { 
    if ($strict) { 
        foreach ($haystack as $item) 
            if (isset($item->$needle_field) && $item->$needle_field === $needle) 
                return true; 
    } 
    else { 
        foreach ($haystack as $item) 
            if (isset($item->$needle_field) && $item->$needle_field == $needle) 
                return true; 
    } 
    return false; 
} 
?>

 <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.language'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <select name='language[]' class="form-control" multiple="multiple">
                                    <option>Please Select Language</option>
                                    @foreach($Language_arr as $lv)
                                    <option value="{{$lv->id}}" <?php if(in_array_field($lv->id, 'language_id', $user_Language_arr)){ echo "selected=selected";}?> >{{$lv->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.service'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <select name='service[]' class="form-control" multiple="multiple">
                                    <option>Please Select Service</option>
                                    @foreach($Service_arr as $lv)
                                    <option value="{{$lv->id}}" <?php if(in_array_field($lv->id, 'service_id', $user_Service_arr)){ echo "selected=selected";}?>>{{$lv->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.message'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <textarea name="message" class="form-control" placeholder="{{trans('validation.attributes.frontend.messagep')}}">{{$user_info_arr->message}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.canton'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="canton" class="form-control" placeholder="{{trans('validation.attributes.frontend.canton')}}" value="{{$user_info_arr->canton}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.region'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="region" class="form-control" placeholder="{{trans('validation.attributes.frontend.region')}}" value="{{$user_info_arr->region}}">
                            </div>
                        </div>
                         <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.area'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="area" class="form-control" placeholder="{{trans('validation.attributes.frontend.area')}}" value="{{$user_info_arr->area}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.type'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="type" class="form-control" placeholder="{{trans('validation.attributes.frontend.type')}}" value="{{$user_info_arr->type}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.nationality'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="nationality" class="form-control" placeholder="{{trans('validation.attributes.frontend.nationality')}}" value="{{$user_info_arr->nationality}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.ethnicity'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="ethnicity" class="form-control" placeholder="{{trans('validation.attributes.frontend.ethnicity')}}" value="{{$user_info_arr->ethnicity}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.age'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="age" class="form-control" placeholder="{{trans('validation.attributes.frontend.age')}}" value="{{$user->age}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.weight'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="weight" class="form-control" placeholder="{{trans('validation.attributes.frontend.weight')}}" value="{{$user_info_arr->weight}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.height'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="height" class="form-control" placeholder="{{trans('validation.attributes.frontend.height')}}" value="{{$user_info_arr->height}}">
                            </div>
                        </div>
                         <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.eyes'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="eyes" class="form-control" placeholder="{{trans('validation.attributes.frontend.eyes')}}" value="{{$user_info_arr->eyes}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.hair'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="hair" class="form-control" placeholder="{{trans('validation.attributes.frontend.hair')}}" value="{{$user_info_arr->hair}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.shoe_size'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="shoe_size" class="form-control" placeholder="{{trans('validation.attributes.frontend.shoe_size')}}" value="{{$user_info_arr->shoe_size}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.breast_size'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="breast_size" class="form-control" placeholder="{{trans('validation.attributes.frontend.breast_size')}}" value="{{$user_info_arr->breast_size}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.pubic_hair'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="pubic_hair" class="form-control" placeholder="{{trans('validation.attributes.frontend.pubic_hair')}}" value="{{$user_info_arr->pubic_hair}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.appointment'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="appointment" class="form-control" placeholder="{{trans('validation.attributes.frontend.appointment')}}" value="{{$user_info_arr->appointment}}">
                            </div>
                        </div>
                         <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.service_for'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="service_for" class="form-control" placeholder="{{trans('validation.attributes.frontend.service_for')}}" value="{{$user_info_arr->service_for}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.instruction'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="instruction" class="form-control" placeholder="{{trans('validation.attributes.frontend.instruction')}}" value="{{$user_info_arr->instruction}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.minimum_rate'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="minimum_rate" class="form-control" placeholder="{{trans('validation.attributes.frontend.minimum_rate')}}" value="{{$user_info_arr->minimum_rate}}">
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('email', trans('validation.attributes.frontend.currency'), ['class' => 'col-md-4 control-label']) }}
                             <div class="col-md-6">
                                <input name="currency" class="form-control" placeholder="{{trans('validation.attributes.frontend.currency')}}" value="{{$user_info_arr->currency}}">
                            </div>
                        </div>