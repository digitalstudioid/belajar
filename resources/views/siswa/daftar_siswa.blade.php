<div id="siswa">
	<h2>Siswa</h2>
	
	<?php if (!empty($siswa)):?>
		<u1>
			<?php foreach($siswa as $anak): ?>
				<li><?= $anak ?></li>
			<?php endforeach ?>
		</u1>
	<?php else: ?>
		<p>Tidak ada data siswa.</p>
	<?php endif ?>
</div>