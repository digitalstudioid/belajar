@extends('template')

@section('main')
	<div id="siswa">
		<h2>Edit Siswa</h2>

		<!--Syntax ini tidak menampilkan data yang ingin diedit
		{!! Form::open(['url' => 'siswa/' . $siswa->id . '/update', 'method' => 'PATCH']) !!}-->
		{!! Form::model($siswa, ['method' => 'PATCH', 'files' => true, 'action' => ['SiswaController@update', $siswa->id]]) !!}

			<!--
			<div class="form-group">
				{!! Form::label('nisn', 'NISN :', ['class' => 'control-label']) !!}
				{!! Form::text('nisn', null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('nama', 'Nama :', ['class' => 'control-label']) !!}
				{!! Form::text('nama', null, ['class' => 'form-control']) !!}
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
				{!! Form::submit('Update Siswa', ['class' => 'btn btn-primary form-control']) !!}
			</div> -->

			<!-- SYNTAK DIATAS DIGANTI DENGAN TEMPLATE -->
			@include('siswa.form', ['submitButtonText' => 'Update Siswa'])	

		{!! Form::close() !!}
	</div>
@stop

@section('footer')
	@include('footer')
@stop