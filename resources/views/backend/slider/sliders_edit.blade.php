@extends ('backend.layouts.master')

@section ('title', trans('Edit Slider'))

@section('page-header')
    <h1>
        {{ trans('Edit Slider') }}  
    </h1>
@endsection

@section('content')
   {!! Form::open(['url' => ((isset($slider_edit[0]->id)) ? ('admin/sliders/edit/store/'.$slider_edit[0]->id) : route("sliderEditStore")),'class' => 'form-horizontal','id'=>'myform' , 'files'=>true, 'role' => 'form', 'method' => 'post']) !!}
    
	<div class="form-group">
        {!! Form::label('Title', trans('Title'), ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('title', (isset($slider_edit[0]->title) ? $slider_edit[0]->title :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter Slider Name')]) !!}
        </div>
    </div><!--form control-->

    <div class="form-group">
        {!! Form::label('Description', trans('Description'), ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::textarea('description', (isset($slider_edit[0]->description) ? $slider_edit[0]->description :''), ['class' => 'form-control validate[required]', 'placeholder' => trans('Enter your description')]) !!}
        </div>
    </div><!--form control-->

    <div class="form-group">
        {!! Form::label('Url', trans('Url'), ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
            {!! Form::text('url', (isset($slider_edit[0]->url) ? $slider_edit[0]->url :''), ['class' => 'form-control', 'placeholder' => trans('Enter your Youtube Url')]) !!}
        </div>
    </div><!--form control-->

    <div class="form-group">
        {!! Form::label('Image', trans('Image'), ['class' => 'col-lg-2 control-label']) !!}
        <div class="col-lg-10">
             <img src="{!! URL::to('img/slider').'/'.$slider_edit[0]->image!!}" class='user-profile-image' style="height:100px;">
            {!! Form::hidden('old_image', (isset($slider_edit[0]->image) ? $slider_edit[0]->image :''), ['class' => '', 'placeholder' => trans('')]) !!}
            {!! Form::file('image', null, ['class' => 'form-control validate[required]']) !!}
        </div>
    </div><!--form control-->

    <div class="form-group">
        {!! Form::label('Active', trans('Active'), ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <input type="checkbox" value="1" name="confirmed" {{ $slider_edit[0]->is_active == 'Y' ? 'checked' : ''}} />
            </div>
    </div><!--form control-->	

    <div class="well">
        <div class="pull-left">
            <a href="{{ URL::previous() }}"
               class="btn btn-danger btn-xs">{{ trans('Back') }}</a>
        </div>

        <div class="pull-right">
            <input type="submit" class="btn btn-success btn-xs" value="{{ trans('Save') }}"/>
        </div>
        <div class="clearfix"></div>
    </div><!--well-->

    {!! Form::close() !!}
   
@stop