@if(isset($siswa))
	{!! Form::hidden('id', $siswa->id) !!}
@endif

<!--<div class="form-group">
	{!! Form::label('nisn', 'NISN :', ['class' => 'control-label']) !!}
	{!! Form::text('nisn', null, ['class' => 'form-control']) !!}
	
	@if ($errors->has('nisn'))
		<span class="help-block">{{ $errors->first('nisn') }}</span>
	@endif
</div>-->
@if($errors->any())
	<div class="form-group {{ $errors->has('nisn') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('nisn', 'NISN :', ['class' => 'control-label']) !!}
	{!! Form::text('nisn', null, ['class' => 'form-control']) !!}
	
	@if ($errors->has('nisn'))
		<span class="help-block">{{ $errors->first('nisn') }}</span>
	@endif
</div>

<!--<div class="form-group">
	{!! Form::label('nama', 'Nama :', ['class' => 'control-label']) !!}
	{!! Form::text('nama', null, ['class' => 'form-control']) !!}
	@if ($errors->has('nama'))
		<span class="help-block">{{ $errors->first('nama') }}</span>
	@endif
</div>-->
@if($errors->any())
	<div class="form-group {{ $errors->has('nama') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('nama', 'Nama :', ['class' => 'control-label']) !!}
	{!! Form::text('nama', null, ['class' => 'form-control']) !!}
	@if ($errors->has('nama'))
		<span class="help-block">{{ $errors->first('nama') }}</span>
	@endif
</div>

<!--<div class="form-group">
	{!! Form::label('tanggal_lahir', 'Tanggal Lahir :', ['class' => 'control-label']) !!}
	{!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}-->
	<!--{!! Form::date('tanggal_lahir', !empty($siswa) ? $siswa->tanggal_lahir->format('Y-m-d'): null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}<!--karena tanggal lahir sudah menjadi instance carbon-->
	<!--@if ($errors->has('tanggal_lahir'))
		<span class="help-block">{{ $errors->first('tanggal_lahir') }}</span>
	@endif
</div>-->
@if($errors->any())
	<div class="form-group {{ $errors->has('tanggal_lahir') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('tanggal_lahir', 'Tanggal Lahir :', ['class' => 'control-label']) !!}
	<!--{!! Form::date('tanggal_lahir', null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}-->
	{!! Form::date('tanggal_lahir', !empty($siswa) ? $siswa->tanggal_lahir->format('Y-m-d'): null, ['class' => 'form-control', 'id' => 'tanggal_lahir']) !!}<!--karena tanggal lahir sudah menjadi instance carbon-->
	@if ($errors->has('tanggal_lahir'))
		<span class="help-block">{{ $errors->first('tanggal_lahir') }}</span>
	@endif
</div>

<!--<div class="form-group">
	{!! Form::label('jenis_kelamin', 'Jenis Kelamin :', ['class' => 'control-label']) !!}
	<div class="radio">
		<label>{!! Form::radio('jenis_kelamin', 'L') !!} Laki-laki</label>
	</div>
	<div class="radio">
		<label>{!! Form::radio('jenis_kelamin', 'P') !!} Perempuan</label>
	</div>
	@if ($errors->has('jenis_kelamin'))
		<span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
	@endif
</div>-->
@if($errors->any())
	<div class="form-group {{ $errors->has('jenis_kelamin') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('jenis_kelamin', 'Jenis Kelamin :', ['class' => 'control-label']) !!}
	<div class="radio">
		<label>{!! Form::radio('jenis_kelamin', 'L') !!} Laki-laki</label>
	</div>
	<div class="radio">
		<label>{!! Form::radio('jenis_kelamin', 'P') !!} Perempuan</label>
	</div>
	@if ($errors->has('jenis_kelamin'))
		<span class="help-block">{{ $errors->first('jenis_kelamin') }}</span>
	@endif
</div>

@if($errors->any())
	<div class="form-group {{ $errors->has('nomor_telepon') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('nomor_telepon', 'Telepon :', ['class' => 'control-label']) !!}
	{!! Form::text('nomor_telepon', null, ['class' => 'form-control']) !!}
	@if ($errors->has('nomor_telepon'))
		<span class="help-block">{{ $errors->first('nomor_telepon') }}</span>
	@endif
</div>

@if($errors->any())
	<div class="form-group {{ $errors->has('id_kelas') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('id_kelas', 'Kelas :', ['class' => 'control-label']) !!}
	@if(count($list_kelas) > 0)
		{!! Form::select('id_kelas', $list_kelas, null, ['class' => 'form-control', 'id' => 'id_kelas', 'placeholder' => 'Pilih Kelas']) !!}
	@else
		<p>Tidak ada pilihan kelas, silahkan buat kelas dahulu</p>
	@endif
	@if ($errors->has('id_kelas'))
		<span class="help-block">{{ $errors->first('id_kelas') }}</span>
	@endif
</div>

@if($errors->any())
	<div class="form-group {{ $errors->has('hobi_siswa') ? 'has-error' : 'has-success' }}">
@else
	<div class="form-group">
@endif
	{!! Form::label('hobi_siswa', 'Hobi :', ['class' => 'control-label']) !!}
	@if(count($list_hobi) > 0)
		@foreach($list_hobi as $key => $value)
			<div class="checkbox">
				<label>{!! Form::checkbox('hobi_siswa[]', $key, null) !!} {{ $value }}</label>
			</div>
		@endforeach
	@else
		<p>Tidak ada pilihan hobi, silahkan buat hobi dahulu</p>
	@endif
</div>

<div class="form-group">
	{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>