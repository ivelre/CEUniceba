<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>@yield('title')</title>
	<link rel="icon" href="{{ asset('/') }}images/buo.png">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	 <!-- Compiled and minified CSS -->
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/vendor.css') }}"  media="screen,projection"/>
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <style type="text/css">
  	.full-modal{
  		height: 100%; width: 100%;top:0% !important; max-height: 100%
  	}
  </style>

</head>
<body>
	<header>
		@include('private.admin.layouts.menu')
	</header>

	<main>
		@yield('content')
	</main>
	<br>

	<!-- Parallax -->
	<div class="parallax-container valign-wrapper hide-on-small-only">
		<div class="section no-pad-bot">
			<div class="container">
			<div class="row center valign-wrapper" style="margin: auto;">
				<h5 class="header col s12 light shadow-text"><i>Yo soy UNICEBA</i></h5>
			</div>
			</div>
		</div>
		<div class="parallax"><img src="{{ asset('/') }}images/footer.jpg"></div>
	</div>

	<footer class="page-footer blue darken-2">
		@include('private.admin.layouts.footer')
	</footer>
	

	<!-- Compiled and minified JavaScript -->
	<script> var public_path = "{{ asset('/') }}"; </script>
	<script src="{{ asset('/js/vendor.js') }}"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
	@yield('script')
	@yield('inline-script')
</body>
</html>