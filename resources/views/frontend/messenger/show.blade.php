@extends('frontend.layouts.master')

@section('content')
    <div class="col-md-6">
        <h1>{{ $thread->subject }}</h1>
        @each('frontend.messenger.partials.messages', $thread->messages, 'message')

        @include('frontend.messenger.partials.form-message')
    </div>
@stop