@extends('frontend.layouts.master')

@section('content')
    @include('frontend.messenger.partials.flash')

    @each('frontend.messenger.partials.thread', $threads, 'thread', 'frontend.messenger.partials.no-threads')
@stop