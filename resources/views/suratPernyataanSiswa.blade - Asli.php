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
			body { font-family: 'Martel Sans', Bitter, Roboto; }
			.tg  {border-collapse:collapse;border-spacing:0;}
			.tg td{border-color:black;border-style:solid;border-width:0; sans-serif;font-size:14px;
			  overflow:hidden;padding:2px 5px;word-break:normal;}
			.tg th{border-color:black;border-style:solid;border-width:0px; sans-serif;font-size:14px;
			  font-weight:normal;overflow:hidden;padding:5px 5px;word-break:normal;}
			.tg .tg-dbbi{border-color:inherit;font-size:15px;font-weight:bold;text-align:center;vertical-align:top}
			.tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
			.tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
        </style>
    </head>
    <body>
		<table class="tg" style="width:782px;" >
		<!--colgroup>
		<col>
		<col>
		<col>
		<col style="width: 30px">
		<col style="width: 45px">
		<col style="width: 45px">
		<col style="width: 50px">
		<col style="width: 50px">
		<col style="width: 75px">
		</colgroup-->
		<thead>
		  <tr>
			<th class="tg-0pky" colspan="9">Lampiran 1</th>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td class="tg-dbbi" colspan="9">SURAT PERNYATAAN CALON PESERTA DIDIK BARU</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">Yang bertanda tangan di bawah ini :</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">1.</td>
			<td class="tg-0pky" style="width: 220px">Nama</td>
			<td class="tg-0pky" colspan="6">: {{ $nama_lengkap }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">2.</td>
			<td class="tg-0pky" style="width: 220px">NISN</td>
			<td class="tg-0pky" colspan="6">: {{ $nisn }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">3.</td>
			<td class="tg-0pky" style="width: 220px">Tempat/Tanggal Lahir</td>
			<td class="tg-0pky" colspan="6">: {{ $tempat_lahir }}, {{ $tanggal_lahir }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">4.</td>
			<td class="tg-0pky" style="width: 220px">Jenis Kelamin</td>
			<td class="tg-0pky" colspan="6">: 
			@if ($jenis_kelamin == 'L')
				Laki-laki
			@else
				Perempuan
			@endif
			</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">5.</td>
			<td class="tg-0pky" style="width: 220px">Agama</td>
			<td class="tg-0pky" colspan="6">: {{ $agama['agama'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">6.</td>
			<td class="tg-0pky" style="width: 220px">No Pendaftaran</td>
			<td class="tg-0pky" colspan="6">: {{ $status_pendaftar['noRegistrasi'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">7.</td>
			<td class="tg-0pky" style="width: 220px">Diterima di Kelas</td>
			<td class="tg-0pky" colspan="6"></td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">8.</td>
			<td class="tg-0pky" style="width: 220px">Nama Orang Tua</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['nama_ayah'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">9.</td>
			<td class="tg-0pky" style="width: 220px">Pekerjaan Orang Tua</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['pekerjaan_ayah']['pekerjaan'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">10.</td>
			<td class="tg-0pky" style="width: 220px">Agama Orang Tua</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['agama_ayah']['agama'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">11.</td>
			<td class="tg-0pky" style="width: 220px">Nama Wali</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['nama_wali'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">12.</td>
			<td class="tg-0pky" style="width: 220px">Pekerjaan wali</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['pekerjaan_wali']['pekerjaan'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">13.</td>
			<td class="tg-0pky" style="width: 220px">Hubungan dengan Wali</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['hubungan']['hubungan'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">14.</td>
			<td class="tg-0pky" style="width: 220px">Alamat Orang Tua/Wali</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['alamat_ortu_wali'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" style="width: 15px"></td>
			<td class="tg-c3ow" style="width: 25px">15.</td>
			<td class="tg-0pky" style="width: 220px">No. Telepon/HP</td>
			<td class="tg-0pky" colspan="6">: {{ $data_pendaftar['no_hp_wali'] }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9"></td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">Dengan ini kami menyatakan dengan sesungguhnya,bahwa selama di Madrasah ini,</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky">1.</td>
			<td class="tg-0pky" colspan="7">Akan belajar dengan tekun, sungguh-sungguh dan penuh semangat.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky">2.</td>
			<td class="tg-0pky" colspan="7">Akan menjaga nama baik diri sendiri, keluarga, masyarakat dan Madrasah.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky">3.</td>
			<td class="tg-0pky" colspan="7">Sanggup menaati seluruh tata tertib dan peraturan yang berlaku.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky">4.</td>
			<td class="tg-0pky" colspan="7">Siap menerima sanksi sesuai ketentuan Madrasah.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky">5.</td>
			<td class="tg-0pky" colspan="7">Bersedia tidak pindah sekolah/Madrasah selama satu tahun pelajaran.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">Demikian surat pernyataan ini kami buat dengan sebenarnya, dan penuh rasa tanggung jawab.</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="4"></td>
			<td class="tg-0pky" colspan="5">{{ $lokasi_surat }}, {{ $tanggal_surat }}</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky" colspan="8">Mengetahui :</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky" colspan="3">Orang tua/Wali,</td>
			<td class="tg-0pky" colspan="5">Yang membuat pernyataan,</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">
				<br>
			</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="3"></td>
			<td class="tg-0pky" colspan="6">Materai 6000</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9">
				<br>
				<br>
				<br>
			</td>
		  </tr>
		  <tr>
			<td class="tg-0pky"></td>
			<td class="tg-0pky" colspan="3">({{ $data_pendaftar['nama_wali'] }})</td>
			<td class="tg-0pky" colspan="5">({{ $nama_lengkap }})</td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="9"></td>
		  </tr>
		  <tr>
			<td class="tg-0pky" colspan="3"></td>
			<td class="tg-0pky" colspan="6">Barcode di sini</td>
		  </tr>
		</tbody>
		</table>
    </body>
</html>