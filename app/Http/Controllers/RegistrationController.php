<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Pendaftar;
use App\DataPendaftar;
use App\NilaiAkademik;
use App\Prestasi;
use App\Lampiran;
use App\StatusPendaftar;

class RegistrationController extends Controller
{
    public function submitRegistration(Request $request){
		$nama_lengkap = $request->input('nama_lengkap');
		$nis_lokal = $request->input('nis_lokal');
		$nisn = $request->input('nisn');
		$nik = $request->input('nik');
		$tempat_lahir = $request->input('tempat_lahir');
		$tanggal_lahir = $request->input('tanggal_lahir');
		$agama = $request->input('agama');
		$jenis_kelamin = $request->input('jenis_kelamin');
		$hobi = $request->input('hobi');
		$cita_cita = $request->input('cita_cita');
		$jml_saudara = $request->input('jml_saudara');
		$anak_ke = $request->input('anak_ke');
		$jenis_tempat_tinggal = $request->input('jenis_tempat_tinggal');
		$alamat_tinggal = $request->input('alamat_tinggal');
		// $propinsi = $request->input('propinsi');
		// $kabupaten = $request->input('kabupaten');
		// $kecamatan = $request->input('kecamatan');
		$kelurahan = $request->input('kelurahan');
		$kodepos = $request->input('kodepos');
		$transportasi = $request->input('transportasi');
		$jarak_rumah_madrasah = $request->input('jarak_rumah_madrasah');
		$no_kip = $request->input('no_kip');
		$nama_sekolah_asal = $request->input('nama_sekolah_asal');
		$status_sekolah_asal = $request->input('status_sekolah_asal');
		$npsn_sekolah_asal = $request->input('npsn_sekolah_asal');
		$lokasi_sekolah_asal = $request->input('lokasi_sekolah_asal');
		$no_kk = $request->input('no_kk');
		$nama_ayah = $request->input('nama_ayah');
		$nik_ayah = $request->input('nik_ayah');
		$pekerjaan_ayah = $request->input('pekerjaan_ayah');
		$pendidikan_ayah = $request->input('pendidikan_ayah');
		$no_hp_ayah = $request->input('no_hp_ayah');
		$nama_ibu = $request->input('nama_ibu');
		$nik_ibu = $request->input('nik_ibu');
		$pekerjaan_ibu = $request->input('pekerjaan_ibu');
		$pendidikan_ibu = $request->input('pendidikan_ibu');
		$no_hp_ibu = $request->input('no_hp_ibu');
		$penghasilan_perbulan = $request->input('penghasilan_perbulan');
		$nama_lengkap_wali = $request->input('nama_lengkap_wali');
		$tanggal_lahir_wali = $request->input('tanggal_lahir_wali');
		$nik_wali = $request->input('nik_wali');
		$no_hp_wali = $request->input('no_hp_wali');
		$pendidikan_wali = $request->input('pendidikan_wali');
		$pekerjaan_wali = $request->input('pekerjaan_wali');
		$hubungan_dengan_wali = $request->input('hubungan_dengan_wali');
		$no_peserta_un = $request->input('no_peserta_un');
		$total_nilai_un = $request->input('total_nilai_un');
		$tanggal_kelulusan = $request->input('tanggal_kelulusan');
		$prestasi_non_akademik_data = $request->input('prestasi_non_akademik'); //array
		$nilai_akademik_data = $request->input('nilai_akademik');; //array
		$fileFotoPath = $request->input('fileFotoPath');
		$fileLampiranPath = $request->input('fileLampiranPath'); //array
		$email = $request->input('email');
		try{
			// Begin the transaction
			DB::beginTransaction();		
			$pendaftar = Pendaftar::create([
				'nama_lengkap' => $nama_lengkap,
				'nis_lokal' => $nis_lokal,
				'nisn' => $nisn,
				'nik' => $nik,
				'tempat_lahir' => $tempat_lahir,
				'tanggal_lahir' => $tanggal_lahir,
				'agama_id' => $agama,
				'jenis_kelamin' => $jenis_kelamin,
				'hobi_id' =>  $hobi,
				'cita_cita_id' => $cita_cita,
				'jumlah_saudara' => $jml_saudara,
				'anak_ke' => $anak_ke,
				'foto_path' => $fileFotoPath,
				'email' => $email
			]);

			$data_pendaftar = new DataPendaftar;
			$data_pendaftar->no_peserta_un = $no_peserta_un;
			$data_pendaftar->total_nilai_un = $total_nilai_un;
			$data_pendaftar->tanggal_kelulusan = $tanggal_kelulusan;
			$data_pendaftar->nama_sekolah_asal = $nama_sekolah_asal;
			$data_pendaftar->status_sekolah_asal = $status_sekolah_asal;
			$data_pendaftar->npsn_sekolah_asal = $npsn_sekolah_asal;
			$data_pendaftar->lokasi_sekolah_asal = $lokasi_sekolah_asal;
			$data_pendaftar->jenis_tempat_tinggal_id = $jenis_tempat_tinggal;
			$data_pendaftar->alamat = $alamat_tinggal;
			$data_pendaftar->kel_id = $kelurahan;
			$data_pendaftar->kode_pos = $kodepos;
			$data_pendaftar->jarak_rumah_madrasah_id = $jarak_rumah_madrasah;
			$data_pendaftar->transportasi_id = $transportasi;
			$data_pendaftar->no_kk = $no_kk;
			$data_pendaftar->nama_ayah = $nama_ayah;
			$data_pendaftar->nik_ayah = $nik_ayah;
			$data_pendaftar->no_hp_ayah = $no_hp_ayah;
			$data_pendaftar->pekerjaan_ayah_id = $pekerjaan_ayah;
			$data_pendaftar->pendidikan_ayah_id = $pendidikan_ayah;
			$data_pendaftar->nama_ibu_kandung = $nama_ibu;
			$data_pendaftar->nik_ibu_kandung = $nik_ibu;
			$data_pendaftar->no_hp_ibu_kandung = $no_hp_ibu;
			$data_pendaftar->pekerjaan_ibu_id = $pekerjaan_ibu;
			$data_pendaftar->pendidikan_ibu_id = $pendidikan_ibu;
			$data_pendaftar->penghasilan_id = $penghasilan_perbulan;
			$data_pendaftar->nama_wali = $nama_lengkap_wali;
			$data_pendaftar->nik_wali = $nik_wali;
			$data_pendaftar->tanggal_lahir_wali = $tanggal_lahir_wali;
			$data_pendaftar->pekerjaan_wali_id = $pekerjaan_wali;
			$data_pendaftar->pendidikan_wali_id = $pendidikan_wali;
			$data_pendaftar->hubungan_wali_id = $hubungan_dengan_wali;
			$data_pendaftar->no_hp_wali = $no_hp_wali;
			$data_pendaftar->alamat_ortu_wali = $alamat_tinggal;
			$data_pendaftar->no_kip = $no_kip;
			$pendaftar->data_pendaftar()->save($data_pendaftar);
			for($i=0;$i<count($nilai_akademik_data);$i++){
				$nilai_akademik = new NilaiAkademik;
				$nilai_akademik->mapel_id = $nilai_akademik_data[$i]['id'];
				$nilai_akademik->semester1 = $nilai_akademik_data[$i]['nilai']['semester1'];
				$nilai_akademik->semester2 = $nilai_akademik_data[$i]['nilai']['semester2'];
				$nilai_akademik->semester3 = $nilai_akademik_data[$i]['nilai']['semester3'];
				$nilai_akademik->semester4 = $nilai_akademik_data[$i]['nilai']['semester4'];
				$nilai_akademik->semester5 = $nilai_akademik_data[$i]['nilai']['semester5'];
				$nilai_akademik->keterangan = $nilai_akademik_data[$i]['keterangan'];
				$pendaftar->nilai_akademik()->save($nilai_akademik);
			}
			for($i=0;$i<count($prestasi_non_akademik_data);$i++){
				$prestasi_non_akademik = new Prestasi;
				$prestasi_non_akademik->jenis_lomba = $prestasi_non_akademik_data[$i]['jenis_lomba'];
				$prestasi_non_akademik->tempat_pelaksanaan = $prestasi_non_akademik_data[$i]['tempat_pelaksanaan'];
				$prestasi_non_akademik->tingkat = $prestasi_non_akademik_data[$i]['tingkat'];
				$prestasi_non_akademik->peringkat_juara = $prestasi_non_akademik_data[$i]['peringkat_juara'];
				$pendaftar->prestasi_non_akademik()->save($prestasi_non_akademik);
			}
			for($i=0;$i<count($fileLampiranPath);$i++){
				$lampiran = new Lampiran;
				$lampiran->nama_file = $fileLampiranPath[$i]['filename'];
				$lampiran->path = $fileLampiranPath[$i]['url'];
				$lampiran->jenis_file = $fileLampiranPath[$i]['jenis_file'];
				$lampiran->keterangan = $fileLampiranPath[$i]['keterangan'];
				$pendaftar->lampiran()->save($lampiran);
			}
			$status_pendaftar = new StatusPendaftar;
			$status_pendaftar->noRegistrasi = strtoupper(Str::random(16));
			$pendaftar->status_pendaftar()->save($status_pendaftar);
			DB::commit();
			$response = response()->json(["status" => "success", "data" => $data_pendaftar]);
		} catch(Throwable $e){
			//Roll back the transaction
			DB::rollBack();
			$response = response()->json(["status" => "error"]);
		}
		return $response;
	}
}




