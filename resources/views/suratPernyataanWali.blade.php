<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Surat Pernyataan Wali</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<!--link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet" /-->
		<!--script src="{{ mix('js/app.js') }}" type="text/javascript" defer></script-->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
			@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Bitter:ital,wght@0,400;0,700;1,400&family=Martel+Sans:wght@300;700&family=Roboto:ital,wght@0,100;0,300;0,500;0,700;1,100;1,300&display=swap');
			body { font-family: 'Martel Sans', Bitter, Roboto; }
			table tr td {border-color:inherit;vertical-align:top}
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
		<td colspan="4">Lampiran 2<br></td>
		<td colspan="5">Barcode<br></td>
	</tr>
  <tr>
    <td colspan="9"><center><strong>SURAT PERNYATAAN ORANG TUA / WALI</strong></center><br></td>
  </tr>
  <tr>
    <td colspan="9">Yang bertanda tangan di bawah ini :</td>
  </tr>
  <tr>
    <td></td>
	<td>1.</td>
	<td>Nama Orang Tua/Wali</td>
	<td colspan="6">: {{ $data_pendaftar['nama_wali'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>2.</td>
	<td>Pekerjaan Orang Tua/Wali</td>
	<td colspan="6">: {{ $data_pendaftar['pekerjaan_wali']['pekerjaan'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>3.</td>
	<td>Alamat Orang Tua/Wali</td>
	<td colspan="6">: {{ $data_pendaftar['alamat_ortu_wali'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>4.</td>
	<td>No. Telepon Orang Tua/Wali</td>
	<td colspan="6">: {{ $data_pendaftar['no_hp_wali'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>5.</td>
	<td>Agama Orang Tua/Wali</td>
	<td colspan="6">: {{ $data_pendaftar['agama_wali']['agama'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>6.</td>
	<td>Nama Peserta Didik</td>
	<td colspan="6">: {{ $nama_lengkap }}</td>
  </tr>
  <tr>
    <td></td>
	<td>7.</td>
	<td>Jenis Kelamin Peserta Didik</td>
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
	<td>8.</td>
	<td>Diterima di Kelas</td>
	<td colspan="6">: {{ $pendaftar_kelas['kelas']['nama_kelas'] }}</td>
  </tr>
  <tr>
    <td></td>
	<td>9.</td>
	<td>Hubungan dengan Peserta Didik</td>
	<td colspan="6">: {{ $data_pendaftar['hubungan']['hubungan'] }}</td>
  </tr>
  <tr>
    <td colspan="9"></td>
  </tr>
  <tr>
    <td colspan="9">Saya selaku orang tua/wali dari peserta didik tersebut diatas, menyatakan dengan sesungguhnya :</td>
  </tr>
  <tr>
    <td></td>
	<td>1.</td>
    <td colspan="7" style="max-width:742px">Bersedia membimbing dan mengawasi peserta didik di atas untuk menaati Tata Tertib MA Negeri 2 Bulukumba.</td>
  </tr>
  <tr>
    <td></td>
	<td>2.</td>
    <td colspan="7" style="max-width:742px">Tidak keberatan apabila peserta didik di atas menerima sanksi sesuai dengan ketentuan MA Negeri 2 Bulukumba.</td>
  </tr>
  <tr>
    <td></td>
	<td>3.</td>
    <td colspan="7" style="max-width:742px;word-break:break-word">Tidak akan memindahkan peserta didik tersebut diatas selama satu tahun pelajaran.</td>
  </tr>
  <tr>
    <td colspan="9">Demikian surat pernyataan ini saya buat dengan sebenarnya, dan penuh rasa tanggung jawab.</td>
  </tr>
  <tr>
    <td colspan="9">
		<br>
	</td>
  </tr>
  <tr>
    <td colspan="5"></td>
    <td colspan="4">{{ $lokasi_surat }}, {{ $tanggal_surat }}</td>
  </tr>
  <tr>
    <td colspan="9">
		<br>
	</td>
  </tr>
  <tr>
    <td></td>
    <td colspan="4">Mengetahui :</td>
    <td colspan="4">Yang Membuat Pernyataan,</td>
  </tr>
  <tr>
    <td></td>
    <td colspan="4"><strong>Kepala MA Negeri 2 Bulukumba,</strong></td>
    <td colspan="4"><strong>Orang Tua/Wali,</strong></td>
  </tr>
  <tr>
    <td colspan="9">
		<br>
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
		<br>
	</td>
  </tr>
  <tr>
    <td></td>
    <td colspan="4"><strong><u>({{ $nama_kepala }})</u><br>NIP. {{ $nip_kepala }}</strong></td>
    <td colspan="4"><strong>({{ $data_pendaftar['nama_wali'] }})</strong><br><font style="color:white">.</font></td>
  </tr>
</tbody>
</table>
</body>
</html>