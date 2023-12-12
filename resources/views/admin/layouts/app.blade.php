<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	@vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body class="admin-body bg-dark">
	@include('shared/navbar')
	<div class="content-wrapper bg-light">
		<div class="container-fluid w-75">
			<div class="row">
				<div class="col">
					@include('shared/alerts')
					<x-card class='my-3'>
						@yield('content')
					</x-card>
				</div>
			</div>
		</div>
	</div>
  @include('shared/footer')
</body>
</html>