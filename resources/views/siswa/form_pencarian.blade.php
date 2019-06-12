<div id="pencarian">
	{!! Form::open(['url' => 'siswa/cari', 'method' => 'GET']) !!}
	<div class="input-group">
		{!! Form::text('kata_kunci', (!empty($kata_kunci)) ? $kata_kunci : null, ['class' => 'form-control', 'placeholder' => 'Masukkan Nama Siswa']) !!}
		<span class="input-group-btn">
			{!! Form::button('Cari', ['class' => 'btn btn-default', 'type' => 'submit']) !!}
		</span>
	</div>
	{!! Form::close() !!}
</div>