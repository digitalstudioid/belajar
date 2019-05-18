<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap_3_3_6/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}">

	{{-- Komentar --}}
	<!-- [if lt IE 9]>
		<script src="{{ asset('public/js/html5shiv_3_7_3.min.js') }}"></script>
		<script src="{{ asset('public/js/respond_1_4_2.min.js') }}"></script>
	<![endif] -->
</head>
<body>
	<!--Mendeteksi halaman. Namun cara ini kurang bagus sehingga kita pindahkan ke BelajarServiceProvider
	<?php
	$halaman = '';
	if (Request::segment(1) == 'siswa') {
		$halaman = 'siswa';
	}
	if (Request::segment(1) == 'about') {
		$halaman = 'about';
	} 
	?>-->

	<div class="container">
		@include('navbar')
		@yield('main')
	</div>	

	@yield('footer')

	<script src="{{ asset('public/js/jquery_3_3_1.min.js"></script>
	<script src="{{ asset('public/bootstrap_3_3_6/js/bootstrap.min.js"></script>
</body>
</html>