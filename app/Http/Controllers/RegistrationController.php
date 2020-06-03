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
use App\Mail\registrasiEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class RegistrationController extends Controller
{
	protected $prefix_path;
	
	public function  __construct(){
		$this->prefix_path = "public/attachment/";
	}

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
		$agama_ayah = $request->input('agama_ayah');
		$agama_ibu = $request->input('agama_ibu');
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
			$data_pendaftar->agama_ayah_id = $agama_ayah;
			$data_pendaftar->agama_ibu_id = $agama_ibu;
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
			$no_reg = strtoupper(Str::random(16));
			$status_pendaftar->noRegistrasi = $no_reg;
			$digits_pin = 5;
			$pin = rand(pow(10, $digits_pin-1), pow(10, $digits_pin)-1);
			$status_pendaftar->pin = $pin;
			$pendaftar->status_pendaftar()->save($status_pendaftar);
			$result = [
				'pendaftar' => $pendaftar->nama_lengkap,
				'no_reg' => $no_reg,
				'pin' => $pin,
				'email' => $pendaftar->email
			];
			$response = response()->json(["status" => "success", "data" => $result]);
			DB::commit();
		} catch(Throwable $e){
			//Roll back the transaction
			DB::rollBack();
			$response = response()->json(["status" => "error"]);
		}
		return $response;
	}
	
		//afterRegistrationSukses
	public function afterRegistrationSukses(Request $request){
		$no_reg = 'AFI3043MSKNZR3YG';
		//$no_reg = $request->no_registrasi;
		try{
			$status_pendaftar = StatusPendaftar::where('noRegistrasi', $no_reg)->first();
			$data = $status_pendaftar->pendaftar()->first()->with(['data_pendaftar','data_pendaftar.hubungan','data_pendaftar.jenis_tinggal','data_pendaftar.jarak','data_pendaftar.transportasi','data_pendaftar.penghasilan','data_pendaftar.pekerjaan_ayah','data_pendaftar.pendidikan_ayah','data_pendaftar.pekerjaan_ibu','data_pendaftar.pendidikan_ibu','data_pendaftar.pekerjaan_wali','data_pendaftar.pendidikan_wali','data_pendaftar.agama_ayah','data_pendaftar.agama_ibu','data_pendaftar.agama_wali','agama','hobi','cita_cita','status_pendaftar','pendaftar_kelas.kelas'])->first();
			$data['lokasi_surat'] = env('TEMPAT_PERSURATAN');
			$data['tanggal_surat'] = date("d-m-Y");
			$data['nama_kepala'] = env('NAMA_KEPALA_SEKOLAH');
			$data['nip_kepala'] = env('NIP_KEPALA_SEKOLAH');
			try{
				$surat_pernyataan_siswa = $this->suratPernyataanSiswa($data);
				$surat_pernyataan_wali = $this->suratPernyataanWali($data);
				if(($surat_pernyataan_siswa == 'success') && ($surat_pernyataan_wali == 'success')){
					$attachments = [
						$this->prefix_path.'Surat_Pernyataan_Siswa_NoRegistrasi_'.$data["status_pendaftar"]["noRegistrasi"].'.pdf',
						$this->prefix_path.'Surat_Pernyataan_Wali_NoRegistrasi_'.$data["status_pendaftar"]["noRegistrasi"].'.pdf'
					];
					if($data['email']!=null){
						$sending_email = $this->kirimAttachment($data, $attachments);
						if($sending_email == 'success'){
							return response()->json(['status' => 'success']);
						} else {
							return response()->json(['status' => 'error']);
						}
					} else {
						return response()->json(['status' => 'success']);
					}					
				} else {
					return response()->json(['status' => 'error']);
				}
			} catch(Exception $e){
				return response()->json(['status' => 'error', 'message' => $e]);
			}
		} catch(Exception $e){
			return response()->json(['status' => 'error', 'message' => $e]);
		}
	}
	
	//kirim attachment
	public function kirimAttachment($data, $attachments){
		$object_to_send = [
			'data' => $data,
			'attachments' => $attachments
		];
		try{
			Mail::to($object_to_send['data']['email'])->send(new registrasiEmail($object_to_send));
			return 'success';
		} catch(Exception $e){
			return 'error';
		}
	}
	
	public function suratPernyataanSiswa($data){
        $pdf = PDF::loadView('suratPernyataanSiswa', $data)->setPaper('A4', 'portrait')->setWarnings(false);
		$file_name=$this->prefix_path.'Surat_Pernyataan_Siswa_NoRegistrasi_'.$data["status_pendaftar"]["noRegistrasi"].'.pdf';
		$isExist = Storage::exists($file_name);
		if($isExist!=1){
			$status = Storage::put($file_name, $pdf->output());
			if($status==1){
				$response = 'success';
			} else {
				$response = 'error';
			}
		} else {
			$response = 'success';
		}
		return $response;
		//now()->addMinutes(1), //menyimpan di server selama 15 menit, setelah itu expired
	}
	
	public function suratPernyataanWali($data){
		$pdf = PDF::loadView('suratPernyataanWali', $data)->setPaper('A4', 'portrait')->setWarnings(false);
		$file_name = $this->prefix_path.'Surat_Pernyataan_Wali_NoRegistrasi_'.$data["status_pendaftar"]["noRegistrasi"].'.pdf';
        $isExist = Storage::exists($file_name);
		if($isExist!=1){
			$status = Storage::put($file_name, $pdf->output());
			if($status==1){
				$response = 'success';
			} else {
				$response = 'error';
			}
		} else {
			$response = 'success';
		}
		return $response;
	}
}




