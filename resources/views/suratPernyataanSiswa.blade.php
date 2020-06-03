<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Surat Pernyataan Siswa</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<!--link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /-->
		<!--script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script-->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
			@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bitter:ital,wght@0,400;0,700;1,400&family=Martel+Sans:wght@300;700&family=Roboto:ital,wght@0,100;0,300;0,500;0,700;1,100;1,300&display=swap');
			table { font-family: Bitter, Roboto;font-size:12px; }
			table tr td{border-color:inherit;vertical-align:top}
        </style>
    </head>
    <body>
		<table style="width:100%;" >
		<thead>
		  <tr>
			<th style="width:5%"></th>
			<th style="width:4%"></th>
			<th style="width:41%"></th>
			<th style="width:10%"></th>
			<th style="width:10%"></th>
			<th style="width:10%"></th>
			<th style="width:10%"></th>
			<th style="width:10%"></th>
			<th style="width:10%"></th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td colspan="4">Lampiran 1<br></td>
			<td colspan="5">Barcode<br></td>
		  </tr>
		  <tr>
			<td colspan="9"><center><strong>SURAT PERNYATAAN CALON PESERTA DIDIK BARU</strong></center><br></td>
		  </tr>
		  <tr>
			<td colspan="9">Yang bertanda tangan di bawah ini :</td>
		  </tr>
		  <tr>
			<td></td>
			<td>1.</td>
			<td>Nama</td>
			<td colspan="6">: {{ $nama_lengkap }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>2.</td>
			<td>NISN</td>
			<td colspan="6">: {{ $nisn }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>3.</td>
			<td>Tempat/Tanggal Lahir</td>
			<td colspan="6">: {{ $tempat_lahir }}, {{ date('d-m-Y', strtotime($tanggal_lahir)) }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>4.</td>
			<td>Jenis Kelamin</td>
			<td colspan="6">: 
			@if ($jenis_kelamin == 'L')
				Laki-laki
			@else
				Perempuan
			@endif
			</td>
		  </tr>
		  <tr>
			<td></td>
			<td>5.</td>
			<td>Agama</td>
			<td colspan="6">: {{ $agama['agama'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>6.</td>
			<td>No Pendaftaran</td>
			<td colspan="6">: {{ $status_pendaftar['noRegistrasi'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>7.</td>
			<td>Diterima di Kelas</td>
			<td colspan="6">: {{ $pendaftar_kelas['kelas']['nama_kelas'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>8.</td>
			<td>Nama Orang Tua</td>
			<td colspan="6">: {{ $data_pendaftar['nama_ayah'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>9.</td>
			<td>Pekerjaan Orang Tua</td>
			<td colspan="6">: {{ $data_pendaftar['pekerjaan_ayah']['pekerjaan'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>10.</td>
			<td>Agama Orang Tua</td>
			<td colspan="6">: {{ $data_pendaftar['agama_ayah']['agama'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>11.</td>
			<td>Nama Wali</td>
			<td colspan="6">: {{ $data_pendaftar['nama_wali'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>12.</td>
			<td>Pekerjaan wali</td>
			<td colspan="6">: {{ $data_pendaftar['pekerjaan_wali']['pekerjaan'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>13.</td>
			<td>Hubungan dengan Wali</td>
			<td colspan="6">: {{ $data_pendaftar['hubungan']['hubungan'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>14.</td>
			<td>Alamat Orang Tua/Wali</td>
			<td colspan="6">: {{ $data_pendaftar['alamat_ortu_wali'] }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td>15.</td>
			<td>No. Telepon/HP</td>
			<td colspan="6">: {{ $data_pendaftar['no_hp_wali'] }}</td>
		  </tr>
		  <tr>
			<td colspan="9">Dengan ini kami menyatakan dengan sesungguhnya,bahwa selama di Madrasah ini,</td>
		  </tr>
		  <tr>
			<td></td>
			<td>1.</td>
			<td colspan="7">Akan belajar dengan tekun, sungguh-sungguh dan penuh semangat.</td>
		  </tr>
		  <tr>
			<td></td>
			<td>2.</td>
			<td colspan="7">Akan menjaga nama baik diri sendiri, keluarga, masyarakat dan Madrasah.</td>
		  </tr>
		  <tr>
			<td></td>
			<td>3.</td>
			<td colspan="7">Sanggup menaati seluruh tata tertib dan peraturan yang berlaku.</td>
		  </tr>
		  <tr>
			<td></td>
			<td>4.</td>
			<td colspan="7">Siap menerima sanksi sesuai ketentuan Madrasah.</td>
		  </tr>
		  <tr>
			<td></td>
			<td>5.</td>
			<td colspan="7">Bersedia tidak pindah sekolah/Madrasah selama satu tahun pelajaran.</td>
		  </tr>
		  <tr>
			<td colspan="9">Demikian surat pernyataan ini kami buat dengan sebenarnya, dan penuh rasa tanggung jawab.</td>
		  </tr>
		  <tr>
			<td colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td colspan="4"></td>
			<td colspan="5">{{ $lokasi_surat }}, {{ $tanggal_surat }}</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="8">Mengetahui :</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="4">Orang tua/Wali,</td>
			<td colspan="4">Yang membuat pernyataan,</td>
		  </tr>
		  <tr>
			<td colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td colspan="4"></td>
			<td colspan="2" style="border:1px solid #000;">
				<br>
				<center>Materai 6000</center>
				<br>
			</td>
			<td colspan="3"></td>
		  </tr>
		  <tr>
			<td colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="4"><strong>({{ $data_pendaftar['nama_wali'] }})</strong></td>
			<td colspan="4"><strong>({{ $nama_lengkap }})</strong></td>
		  </tr>
		</tbody>
		</table>
    </body>
</html>