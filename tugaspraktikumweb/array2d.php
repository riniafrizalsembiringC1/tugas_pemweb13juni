<?php

	$mhs = [
		[
			'nim' => 'A12.2000.00001',
			'nama' => 'Joko',
			'alamat' => 'Semarang'
		],
		[

			'nim' => 'A12.2000.00002',
			'nama' => 'Fulan',
			'alamat' => 'Semarang'
		],
		[

			'nim' => 'A12.2000.00003',
			'nama' => 'Toni',
			'alamat' => 'Jakarta'
		]
	];

?>
<table border=1>
	<tr>
		<td>NIM</td>
		<td>Nama</td>
		<td>Alamat</td>
	</tr>
	<?php
	foreach($mhs as $mahasiswa):
	?>
	<tr>
		<td><?php echo $mahasiswa['nim']?></td>
		<td><?php echo $mahasiswa['nama']?></td>
		<td><?php echo $mahasiswa['alamat']?></td>
	</tr>
	<?php endforeach;?>

</table>