<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="_token" content="{{ csrf_token() }}" />

<title>@yield('title', app_name())</title>

<!-- Meta -->
<meta name="description" content="@yield('meta_description', app_name())">
<meta name="author" content="@yield('meta_author', 'WDP Technologies Pvt. Ltd.')">
@yield('meta')

{!! Html::style('css/font-awesome.min.css') !!}
{!! Html::style('css/bootstrap.css') !!}
{!! Html::style('css/validationEngine.jquery.css') !!}
{!! Html::style('css/owl.carousel.css') !!}
{!! Html::style('css/owl.theme.css') !!}
{!! Html::style('css/scrollToTop.css') !!}
{!! Html::style('css/easing.css') !!}
{!! Html::style('css/jquery.mCustomScrollbar.css') !!}
{!! Html::style('css/style.css') !!}





     

        

<!-- Scripts -->
{!! Html::script('js/vendor/jquery/jquery-2.1.4.min.js') !!}
{!! Html::script('js/vendor/bootstrap/bootstrap.min.js') !!}
{!! Html::script('js/vendor/jquery/jquery-scrollToTop.js') !!}
 {!! Html::script('js/vendor/jquery/jquery.validationEngine.js') !!}
{!! Html::script('js/vendor/jquery/jquery.validationEngine-en.js') !!}
{!! Html::script('js/vendor/jquery/owl.carousel.min.js') !!}
{!! Html::script('js/vendor/jquery/jquery.mCustomScrollbar.concat.min.js') !!}
<style>
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 767px)
   {
.navbar-default .navbar-nav .open .dropdown-menu > li > a{
	color: #fff!important;
}
   }

</style>

<?php /* <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> */ ?>

<?php
/* 
<!-- Styles -->
@yield('before-styles-end')

{{ Html::style(elixir('css/frontend.css')) }} 
*/
?>
<!-- Check if the language is set to RTL, so apply the RTL layouts -->
@langRTL
	{!! Html::style(elixir('css/rtl.css')) !!}
@endif
<?php
/* 
@yield('after-styles-end')

<!-- Fonts -->
{{ Html::style('https://fonts.googleapis.com/css?family=Lato:100,300,400,700') }}
*/
?>