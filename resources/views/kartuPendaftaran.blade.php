<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cetak Kartu Registrasi</title>
		<style type="text/css">
		.tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
		.tg td{background-color:#fff;border-color:black;border-style:solid;border-width:0px;color:#333;
		  font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:3px 5px;word-break:normal;}
		.tg th{background-color:#f0f0f0;border-color:#ccc;border-style:solid;border-width:1px;color:#333;
		  font-family:Arial, sans-serif;font-size:14px;font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
		.bold { font-weight: bold; }
		.text-center { text-align: center; }
		.vmiddle { vertical-align:middle; }
		.subtable {
			border: 1px solid #000;
		}
		.page-break {
			page-break-after: always;
		}
		/* table { page-break-inside:auto }
		tr    { page-break-inside:avoid; page-break-after:auto } */
		</style>
    </head>
    <body>
		<table style="width: 100%;" class="tg">
		<thead>
		  <!--tr>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>
			<th style="width:5%"></th>			
		  </tr-->
		  <tr>
			<td></td>
			<td colspan="2">
				<img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" width="90px">
			</td>
			<td colspan="14" class="text-center" style="margin-bottom:1px;line-height:130%;font-size:13px;">
			<b>KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
			KANTOR KEMENTERIAN AGAMA KABUPATEN BULUKUMBA<br>
			MADRASAH ALIYAH NEGERI 2 BULUKUMBA</b><br>
			Jl. Matahari No. 21 Bulukumba, Telp. 0413-81118
			</td>
			<td colspan="2" style="text-align:right">
				<img src="https://1.bp.blogspot.com/-vm63HsKrQ_A/Xt-_xsf0O1I/AAAAAAAADTI/yUF8OfoBJNMG4qz6ATpi49eHQs--MjjvwCLcBGAsYHQ/s320/lambang_m2b.png" width="90px">
			</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20" style="height:3px;"></td>
		  </tr>
		  <tr>
			<td colspan="20" style="border-top:2px solid #000;"><br></td>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td></td>
			<td colspan="18" class="bold text-center">FORMULIR CALON PESERTA DIDIK BARU</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold text-center">TAHUN PELAJARAN 2020/2021</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="9" class="bold">No. Registrasi: {{ $status_pendaftar['noRegistrasi']}}</td>
			<td></td>
			<td></td>
			<td colspan="3"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">INFORMASI PRIBADI</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Nama Lengkap</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $nama_lengkap }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NIS Lokal</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $nis_lokal}}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NISN</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $nisn }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NIK</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $nik }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Tempat Lahir</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $tempat_lahir }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Tanggal Lahir</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ date('d-m-Y', strtotime($tanggal_lahir)) }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Agama</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $agama['agama'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Jenis Kelamin</td>
			<td class="text-center">:</td>
			<td colspan="6">@if ($jenis_kelamin == 'L')
				Laki-laki
			@else
				Perempuan
			@endif</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Hobi</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $hobi['hobi'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Cita-cita</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $cita_cita['cita_cita'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
			<tr>
			<td></td>
			<td></td>
			<td colspan="6">Jumlah Saudara</td>
			<td class="text-center">:</td>
			<td>{{ $jumlah_saudara }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="3">Anak ke : {{ $anak_ke }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">INFORMASI PENDIDIKAN</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Nama Sekolah/Madrasah</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nama_sekolah_asal'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Status</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ ucwords($data_pendaftar['status_sekolah_asal']) }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NPSN</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['npsn_sekolah_asal'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Lokasi</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['lokasi_sekolah_asal'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">No Peserta UN</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['no_peserta_un'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Total Nilai UN</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['total_nilai_un'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Tanggal Kelulusan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ date('d-m-Y', strtotime($data_pendaftar['tanggal_kelulusan'])) }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">NILAI AKADEMIK</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td rowspan="2" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">No</td>
			<td colspan="4" rowspan="2" class="subtable bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Mata Pelajaran</td>
			<td colspan="5" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Nilai Kognitif Semester</td>
			<td colspan="3" rowspan="2" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Rata-rata</td>
			<td colspan="3" rowspan="2" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Ket</td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td style="border-right:1px solid #000;"></td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">I</td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">II</td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">III</td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">IV</td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">V</td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
			@foreach ($nilai_akademik as $nilai)
				<tr>
					<td></td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $loop->iteration }}</td>
					<td colspan="4" class="vmiddle" style="border:1px solid #000;">{{ $nilai['mapel']['nama_mapel']}}</td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $nilai['semester1'] }}</td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $nilai['semester2'] }}</td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $nilai['semester3'] }}</td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $nilai['semester4'] }}</td>
					<td class="text-center vmiddle" style="border:1px solid #000;">{{ $nilai['semester5'] }}</td>
					<td colspan="3" class="vmiddle text-center" style="border:1px solid #000;">{{ $nilai['avg'] }}</td>
					<td colspan="3" style="border:1px solid #000;">{{ $nilai['keterangan'] }}</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			@endforeach
		  </tbody>
		  </table>
		  <div class="page-break"></div>
		  <table style="width: 100%;" class="tg">
			<thead>
				<tr>
					<td></td>
					<td colspan="2" width="10%">
						<img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" width="90px">
					</td>
					<td colspan="14" width="70%" class="text-center" style="margin-bottom:1px;line-height:130%;">
					<b>KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
					KANTOR KEMENTERIAN AGAMA KABUPATEN BULUKUMBA<br>
					MADRASAH ALIYAH NEGERI 2 BULUKUMBA</b><br>
					Jl. Matahari No. 21 Bulukumba, Telp. 0413-81118
					</td>
					<td colspan="2" width="10%" style="text-align:right">
						<img src="https://1.bp.blogspot.com/-vm63HsKrQ_A/Xt-_xsf0O1I/AAAAAAAADTI/yUF8OfoBJNMG4qz6ATpi49eHQs--MjjvwCLcBGAsYHQ/s320/lambang_m2b.png" width="90px">
					</td>
					<td width></td>
				  </tr>
				  <tr>
					<td colspan="20" style="height:3px;"></td>
				  </tr>
				  <tr>
					<td colspan="20" style="border-top:2px solid #000;"><br></td>
				  </tr>
			</thead>
			<tbody>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">PRESTASI NON AKADEMIK</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">No</td>
			<td colspan="6" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Jenis Lomba/Kompetisi</td>
			<td colspan="2" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Tingkat</td>
			<td colspan="5" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Tempat Pelaksanaan</td>
			<td colspan="3" class="bold text-center vmiddle" style="border:1px solid #000;background-color:#d4dcff;">Peringkat</td>
			<td></td>
			<td></td>
		  </tr>
		  @if (count($prestasi_non_akademik) === 0)
			  <tr>
				<td></td>
				<td colspan="17" class="vmiddle text-center"  style="border:1px solid #000;">Tidak ada data</td>
				<td></td>
				<td></td>
			  </tr>
		  @else
			@foreach ($prestasi_non_akademik as $prestasi)
		  <tr>
			<td></td>
			<td class="text-center vmiddle" style="border:1px solid #000;">{{ $loop->iteration }}</td>
			<td colspan="6" class="vmiddle" style="border:1px solid #000;">{{ $prestasi['jenis_lomba'] }}</td>
			<td colspan="2" class="text-center vmiddle" style="border:1px solid #000;">{{ $prestasi['tingkat'] }}</td>
			<td colspan="5" class="vmiddle" style="border:1px solid #000;">{{ $prestasi['tempat_pelaksanaan'] }}</td>
			<td colspan="3" class="text-center vmiddle" style="border:1px solid #000;">{{ $prestasi['peringkat_juara'] }}</td>
			<td></td>
			<td></td>
		  </tr>
			@endforeach
		@endif
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">INFORMASI TEMPAT TINGGAL</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Jenis Tempat Tinggal</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['jenis_tinggal']['jenis_tempat_tinggal'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Alamat</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['alamat'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Propinsi</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $propinsi }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Kab/Kota</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $kabupaten }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Kecamatan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $kecamatan }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Desa/Kelurahan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $kelurahan }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Kode Pos</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['kode_pos'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Jarak Tempat Tinggal</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['jarak']['jarak'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Transportasi</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['transportasi']['transportasi'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">INFORMASI ORANG TUA</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">No. KK</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['no_kk'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Penghasilan rata-rata per bulan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['penghasilan']['penghasilan'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Nama Ayah</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nama_ayah'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NIK</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nik_ayah'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pekerjaan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pekerjaan_ayah']['pekerjaan'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pendidikan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pendidikan_ayah']['pendidikan'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">No HP</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['no_hp_ayah']  ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Nama Ibu Kandung</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nama_ibu_kandung'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NIK</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nik_ibu_kandung'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pekerjaan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pekerjaan_ibu']['pekerjaan'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pendidikan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pendidikan_ibu']['pendidikan'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">No HP</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['no_hp_ibu_kandung'] ?: '-' }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">INFORMASI WALI</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Nama Lengkap</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nama_wali'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Tanggal Lahir</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ date('d-m-Y', strtotime($data_pendaftar['tanggal_lahir_wali'])) }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">NIK</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['nik_wali'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pendidikan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pendidikan_wali']['pendidikan'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td></td>
			<td colspan="6">Pekerjaan</td>
			<td class="text-center">:</td>
			<td colspan="6">{{ $data_pendaftar['pekerjaan_wali']['pekerjaan'] }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  </tbody>
		  </table>
		  <div class="page-break"></div>
		  <table style="width: 100%;" class="tg">
			<thead>
				<tr>
					<td></td>
					<td colspan="2" width="10%">
						<img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Kementerian_Agama_new_logo.png" width="90px">
					</td>
					<td colspan="14" width="70%" class="text-center" style="margin-bottom:1px;line-height:130%;">
					<b>KEMENTERIAN AGAMA REPUBLIK INDONESIA<br>
					KANTOR KEMENTERIAN AGAMA KABUPATEN BULUKUMBA<br>
					MADRASAH ALIYAH NEGERI 2 BULUKUMBA</b><br>
					Jl. Matahari No. 21 Bulukumba, Telp. 0413-81118
					</td>
					<td colspan="2" width="10%" style="text-align:right">
						<img src="https://1.bp.blogspot.com/-vm63HsKrQ_A/Xt-_xsf0O1I/AAAAAAAADTI/yUF8OfoBJNMG4qz6ATpi49eHQs--MjjvwCLcBGAsYHQ/s320/lambang_m2b.png" width="90px">
					</td>
					<td width></td>
				  </tr>
				  <tr>
					<td colspan="20" style="height:3px;"></td>
				  </tr>
				  <tr>
					<td colspan="20" style="border-top:2px solid #000;"><br></td>
				  </tr>
			<tbody>
		  <tr>
			<td></td>
			<td colspan="6" class="bold">PILIHAN PEMINATAN/JURUSAN</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  @foreach ($peminatan as $data_peminatan)
		  <tr>
			<td></td>
			<td colspan="18">{{ $loop->iteration }}. {{ $data_peminatan['peminatan'] }} ({{ $data_peminatan['keterangan'] }})</td>
			<td></td>
		  </tr>
		  @endforeach
		  <tr>
			<td></td>
			<td colspan="18"><i>(Peminatan yang dipilih harus sepengetahuan orang tua dengan mempertimbangkan nilai sebelumnya)</i></td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18" class="bold">PENERIMA BANTUAN PIP/BSM</td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="18">No. KIP : {{ $data_pendaftar['no_kip'] ?: '-' }}</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="3">Mengetahui,</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="8" class="bold">Orang Tua/Wali Calon Peserta Didik</td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="7" class="bold">Calon Peserta Didik</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td colspan="7">
				<br>
			</td>
			<td colspan="4" style="text-align:right"><img src="{{ str_replace('public', 'storage', $foto_path) }}" width="100px"></td>
			<td colspan="9"></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td></td>
			<td colspan="8" class="bold">{{ strtoupper($data_pendaftar['nama_wali']) }}</td>
			<td></td>
			<td></td>
			<td></td>
			<td colspan="7" class="bold">{{ strtoupper($nama_lengkap) }}</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td colspan="20"><br></td>
		  </tr>
		  <tr>
			<td colspan="15"></td>
			<td colspan="4">
				{!!DNS2D::getBarcodeHTML(env('APP_URL').'/status/'.$status_pendaftar['noRegistrasi'], 'QRCODE',4,4)!!}
			</td>
			<td></td>
		  </tr>
		  <tr>
			<td colspan="15"></td>
			<td colspan="4" style="font-size:11px">
				<i>&nbsp;&nbsp;Scan untuk lihat status</i>
			</td>
			<td></td>
		  </tr>
		</tbody>
		</table>
		<script type="text/php">
			if ( isset($pdf) ) {
				$font = Font_Metrics::get_font("helvetica", "bold");
				$pdf->page_text(72, 18, "Header: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
			}
		</script>
    </body>
</html>
