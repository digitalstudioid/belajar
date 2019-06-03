@extends('template')

@section('main')
	<div id="siswa">
		<h2>Siswa</h2>
		
		@include('_partial.flash_message')
		
		<!-- PHP NATIVE VERSION
		<?php if (!empty($siswa)):?>
			<u1>
				<?php foreach($siswa as $anak): ?>
					<li><?= $anak ?></li>
				<?php endforeach ?>
			</u1>
		<?php else: ?>
			<p>Tidak ada data siswa.</p>
		<?php endif ?> -->

		<!-- BLADE VERSION
		@if (!empty($siswa))
		 <ul>
		 	@foreach($siswa as $anak)
		 		<li>{{ $anak }}</li>
		 	@endforeach
		 </ul>
		@else
			<p>Tidak ada data siswa.</p>
		@endif  -->

		<div class="top-nav">
			<div>
				<a href="siswa/create" class="btn btn-primary">Tambah Siswa</a>
			</div>			
		</div>

		@if (!empty($siswa_list))
			<table class="table">
				<thead>
					<tr>
						<th>NISN</th>
						<th>Nama</th>
						<th>Tgl. Lahir</th>
						<th>JK</th>
						<th>Telepon</th>
						<th>Kelas</th>
						<th>Hobi</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($siswa_list as $siswa): ?>
						<tr>
							<td>{{ $siswa->nisn }}</td>
							<td>{{ $siswa->nama }}</td>
							<!-- <td>{{ $siswa->tanggal_lahir }}</td> -->
							<td>{{ $siswa->tanggal_lahir->format('d-m-Y') }}</td><!--karena tanggal lahir sudah menjadi instance carbon-->
							<td>{{ $siswa->jenis_kelamin }}</td>
							<td>{{ !empty($siswa->telepon->nomor_telepon) ? $siswa->telepon->nomor_telepon : '-' }}</td>
							<td>{{ $siswa->kelas->nama_kelas }}</td>
							<td>
								@foreach($siswa->hobi as $item)
									<span>{{ $item->nama_hobi }}</span>,
								@endforeach
							</td>
							<td>
								<div class="box-button">
									{{ link_to('siswa/' . $siswa->id, 'Detail', ['class' => 'btn btn-success btn-sm']) }}
								</div>

								<div class="box-button">
									{{ link_to('siswa/' . $siswa->id . '/edit', 'Edit', ['class' => 'btn btn-warning btn-sm']) }}
								</div>

								<div class="box-button">
									{!! Form::open(['method' => 'DELETE', 'action' => ['SiswaController@destroy', $siswa->id]]) !!}
									{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
									{!! Form::close() !!}
								</div>								
							</td>							
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		@else
			<p>Tidak ada data siswa.</p>
		@endif

		<!--
		<div class="table-bottom">
			<div class="pull-left">
				<strong>Jumlah : {{ $jumlah_siswa }} Siswa</strong>
			</div>
			<div class="pull-right">
				Pagination
			</div>
		</div>-->

		<div class="table-nav">
			<div class="jumlah-data">
				<strong> Jumlah : {{ $jumlah_siswa }} Siswa</strong>
			</div>
			<div class="paging">
				{{ $siswa_list->links() }}
			</div>
		</div>
	</div>
@stop

@section('footer')
	@include('footer')
@stop
