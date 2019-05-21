@extends('template')

@section('main')
	<div id="siswa">
		<h2>Tambah Siswa</h2>

		<!--@include('errors.form_error_list') pesan error dipindahkan di setiap fieldnya-->

		<!--Versi Standar
		<form action="{{ url('siswa') }}" method="POST">
		
		Versi LaravelCollective-->
		{!! Form::open(['url' => 'siswa', 'files' => true]) !!}


			{{ csrf_field() }}

			<!--SYNTAX STANDARD --------------------------------------------------------------
			<div class="form-group">				
				<label for="nisn" class="control-label">NISN</label>
				<input type="text" name="nisn" id="nisn" class="form-control">
			</div>

			<div class="form-group">
				<label for="nama" class="control-label">Nama</label>
				<input type="text" name="nama" id="nama" class="form-control">
			</div>

			<div class="form-group">				
				<label for="tanggal_lahir" class="control-label">Tanggal Lahir</label>
				<input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
			</div>

			<div class="form-group">
				<label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
				<div class="radio">
					<label><input type="radio" name="jenis_kelamin" value="L" id="jenis_kelamin"> Laki-laki</label>
				</div>
				<div class="radio">
					<label><input type="radio" name="jenis_kelamin" value="P" id="jenis_kelamin"> Perempuan</label>
				</div>
			</div>

			<div class="form-group">
				<input type="submit" class="btn btn-primary form-control" value="Tambah Siswa">
			</div>-->

			<!--SYNTAX LARAVELCOLLECTIVE --------------------------------------------------------
			<div class="form-group">				
				{!! Form::label('nisn', 'NISN :', ['class' => 'control-label']) !!}
				{!! Form::text('nisn', null, ['class' => 'form-control', 'id' => 'nisn']) !!}
			</div>

			<div class="form-group">				
				{!! Form::label('nama', 'Nama :', ['class' => 'control-label']) !!}
				{!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
			</div>

			<div class="form-group">				
				{!! Form::label('tanggal_lahir', 'Tanggal Lahir :', ['class' => 'control-label']) !!}
				{!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('jenis_kelamin', 'Jenis Kelamin :', ['class' => 'control-label']) !!}
				<div class="radio">
					<label>{!! Form::radio('jenis_kelamin', 'L') !!} Laki-laki</label>
				</div>
				<div class="radio">
					<label>{!! Form::radio('jenis_kelamin', 'P') !!} Perempuan</label>
				</div>
			</div>

			<div class="form-group">
				{!! Form::submit('Tambah Siswa', ['class' => 'btn btn-primary form-control']) !!}
			</div>-->


			<!-- SYNTAK DIATAS DIGANTI DENGAN TEMPLATE -->
			@include('siswa.form', ['submitButtonText' => 'Tambah Siswa'])	
			
		<!--</form>-->
		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('footer')
@stop