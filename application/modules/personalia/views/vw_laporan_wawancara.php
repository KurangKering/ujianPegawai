<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Pelamar</title>
	<!-- Tell the browser to be responsive to screen width -->
	<!-- Bootstrap 3.3.6 -->

	<style>
		@page { margin-top: 0px; }
		body {
			font-family: 'Times New Roman';
			font-weight: 400;
			font-size: 14px;
			line-height: 1.42857143;
		}
		#table-laporan {
			border-width: 1px;border-style: solid;border-color: black;border-collapse: collapse;

			margin: 0 auto;
			width: 100%;
			clear: both;
			border-collapse: collapse;
			table-layout: fixed;
			word-wrap:break-word; 


		}
		#table-laporan th {border-width: 1px;padding: 3px;border-style: solid;border-color: black; text-align: center ; text-transform: uppercase}
		#table-laporan td {border-width: 1px;padding: 3px;border-style: solid;border-color: black;}
		.odd  { background-color:#ffffff; }
		.even { background-color:#dddddd; }
		.text-left {
			text-align: left;
		}
		.text-center {
			text-align: center;
		}


	</style>
</head>
<body>
	
	<P class="text-center" style="font-weight: bold; font-size: 14">DAFTAR PELAMAR YANG LULUS PSIKOTEST</P>



	<table  id="table-laporan" width="100%" border="1px">
		<thead>
			<tr>
				<th width="4%" class="text-center">No</th>
				<th width="17%" >NIK</th>
				<th>Nama</th>
				<th>Fakultas</th>
				<th>Sub Bagian</th>
			</tr>
		</thead>
		<tbody>
			<?php if (isset($cetak)): ?>
				<?php $number = 1; ?>
				<?php foreach ($cetak as $key => $pelamar): ?>
					<tr>
						<td class="text-center"><?php echo $number++; ?></td>
						<td class="text-center"><?php echo $pelamar['nik'] ?></td>
						<td class="text-center"><?php echo $pelamar['nama'] ?></td>
						<td class="text-center"><?php echo $pelamar['nama_fakultas'] ?></td>
						<td class="text-center"><?php echo $pelamar['nama_subbag'] ?></td>
					</tr>


				<?php endforeach ?>
			<?php endif ?>

		</tbody>
		<tfoot>

		</tfoot>
	</table>
	<br>
	<hr>


</body>
</html>
