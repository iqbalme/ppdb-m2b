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
		$nilai_akademik_data = $request->input('nilai_akademik'); //array
		$fileFotoPath = $request->input('fileFotoPath')[0];
		$fileLampiranPath = $request->input('fileLampiranPath'); //array
		$email = $request->input('email');
		$agama_ayah = $request->input('agama_ayah');
		$agama_ibu = $request->input('agama_ibu');
		$agama_wali = $request->input('agama_wali');
		try{
			// Begin the transaction
			DB::beginTransaction();
			if($request->id == null){
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
			} else {
				$pendaftar = Pendaftar::updateOrCreate(['id' => $request->id],[
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
			}
			$data_pendaftar = DataPendaftar::firstOrCreate(['pendaftar_id' => $request->id]);
			$detail_data_pendaftar = [
				'no_peserta_un' => $no_peserta_un,
				'total_nilai_un' => $total_nilai_un,
				'tanggal_kelulusan' => $tanggal_kelulusan,
				'nama_sekolah_asal' => $nama_sekolah_asal,
				'status_sekolah_asal' => $status_sekolah_asal,
				'npsn_sekolah_asal' => $npsn_sekolah_asal,
				'lokasi_sekolah_asal' => $lokasi_sekolah_asal,
				'jenis_tempat_tinggal_id' => $jenis_tempat_tinggal,
				'alamat' => $alamat_tinggal,
				'kel_id' => $kelurahan,
				'kode_pos' => $kodepos,
				'jarak_rumah_madrasah_id' => $jarak_rumah_madrasah,
				'transportasi_id' => $transportasi,
				'no_kk' => $no_kk,
				'nama_ayah' => $nama_ayah,
				'nik_ayah' => $nik_ayah,
				'no_hp_ayah' => $no_hp_ayah,
				'pekerjaan_ayah_id' => $pekerjaan_ayah,
				'pendidikan_ayah_id' => $pendidikan_ayah,
				'nama_ibu_kandung' => $nama_ibu,
				'nik_ibu_kandung' => $nik_ibu,
				'no_hp_ibu_kandung' => $no_hp_ibu,
				'pekerjaan_ibu_id' => $pekerjaan_ibu,
				'pendidikan_ibu_id' => $pendidikan_ibu,
				'penghasilan_id' => $penghasilan_perbulan,
				'nama_wali' => $nama_lengkap_wali,
				'nik_wali' => $nik_wali,
				'tanggal_lahir_wali' => $tanggal_lahir_wali,
				'pekerjaan_wali_id' => $pekerjaan_wali,
				'pendidikan_wali_id' => $pendidikan_wali,
				'hubungan_wali_id' => $hubungan_dengan_wali,
				'no_hp_wali' => $no_hp_wali,
				'alamat_ortu_wali' => $alamat_tinggal,
				'no_kip' => $no_kip,
				'agama_ayah_id' => $agama_ayah,
				'agama_ibu_id' => $agama_ibu,
				'agama_wali_id' => $agama_wali
			];
			$data_pendaftar->fill($detail_data_pendaftar)->save();
			for($i=0;$i<count($nilai_akademik_data);$i++){
				$data_akademik = [
					'semester1' => $nilai_akademik_data[$i]['nilai']['semester1'],
					'semester2' => $nilai_akademik_data[$i]['nilai']['semester2'],
					'semester3' => $nilai_akademik_data[$i]['nilai']['semester3'],
					'semester4' => $nilai_akademik_data[$i]['nilai']['semester4'],
					'semester5' => $nilai_akademik_data[$i]['nilai']['semester5'],
					'keterangan' => $nilai_akademik_data[$i]['keterangan']
				];
				$nilai_akademik = NilaiAkademik::firstOrCreate(['pendaftar_id' => $request->id, 'mapel_id' => $nilai_akademik_data[$i]['id']]);
				$nilai_akademik->fill($data_akademik)->save();
			}
			$pendaftar->prestasi_non_akademik()->delete();
			$prestasi_non_akademik = [];
			foreach ($prestasi_non_akademik_data as $prestasi_non_akademik_data_detail) {
				$prestasi_non_akademik[] = new Prestasi($prestasi_non_akademik_data_detail);
			}
			$pendaftar->prestasi_non_akademik()->saveMany($prestasi_non_akademik);
			// for($i=0;$i<count($fileLampiranPath);$i++){
				// $lampiran = Lampiran::where('pendaftar_id', $request->id);
				// $lampiran->nama_file = $fileLampiranPath[$i]['filename'];
				// $lampiran->path = $fileLampiranPath[$i]['url'];
				// $lampiran->jenis_file = $fileLampiranPath[$i]['jenis_file'];
				// $lampiran->keterangan = $fileLampiranPath[$i]['keterangan'];
				// $pendaftar->lampiran()->updateOrCreate(['pendaftar_id' => $request->id], $lampiran->toArray());
			// }
			if($request->id == null){
				$status_pendaftar = new StatusPendaftar;
				$no_reg = strtoupper(Str::random(16));
				$status_pendaftar->noRegistrasi = $no_reg;
				$digits_pin = 5;
				$pin = rand(pow(10, $digits_pin-1), pow(10, $digits_pin)-1);
				$status_pendaftar->pin = $pin;
				$pendaftar->status_pendaftar()->updateOrCreate(['pendaftar_id' => $request->id], $status_pendaftar->toArray());
				$result = [
					'pendaftar' => $pendaftar->nama_lengkap,
					'no_reg' => $no_reg,
					'pin' => $pin,
					'email' => $pendaftar->email
				];
			} else {
				$status_pendaftar = StatusPendaftar::where('pendaftar_id', $request->id)->first();
				$result = [
					'pendaftar' => $pendaftar->nama_lengkap,
					'no_reg' => $status_pendaftar->noRegistrasi,
					'pin' => $status_pendaftar->pin,
					'email' => $pendaftar->email
				];
			}
			$response = response()->json(["status" => "success", "data" => $result]);
			DB::commit();
		} catch(Exception $e){
			//Roll back the transaction
			DB::rollBack();
			$response = response()->json(["status" => "error"]);
		}
		return $response;
	}
	
	public function tesquery(Request $request){
		$prestasi_non_akademik_data = $request->input('prestasi_non_akademik'); //array
		try{
			$pendaftar = Pendaftar::find(13);
			$pendaftar->prestasi_non_akademik()->delete();
			$prestasi_non_akademik = [];
			foreach ($prestasi_non_akademik_data as $prestasi_non_akademik_data_detail) {
				$prestasi_non_akademik[] = new Prestasi($prestasi_non_akademik_data_detail);
			}
			return $pendaftar->prestasi_non_akademik()->saveMany($prestasi_non_akademik);
		} catch(Exception $e){
			return response()->json(["status" => "error", "message" => $e]);
		}
	}
	
	
	//afterRegistrationSukses
	public function afterRegistrationSuksesPdf(Request $request){
		$response = $this->afterRegistrationSukses($request);
		if($response['status'] = 'success'){
			$data = $response['data'];
			try{
				$data['lokasi_surat'] = env('TEMPAT_PERSURATAN');
				$data['tanggal_surat'] = date("d-m-Y");
				$data['nama_kepala'] = env('NAMA_KEPALA_SEKOLAH');
				$data['nip_kepala'] = env('NIP_KEPALA_SEKOLAH');
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
		} else {
			return response()->json(['status' => 'error']);
		}
	}
	
	public function afterRegistrationSukses(Request $request){
		//$no_reg = 'WODQYO15ILN2JXA0';
		$no_reg = $request->no_registrasi;
		try{
			$status_pendaftar = StatusPendaftar::where('noRegistrasi', $no_reg);
			if($status_pendaftar->count()>0){
				$id_pendaftar = $status_pendaftar->first()->pendaftar_id;
				$data = Pendaftar::where('id', $id_pendaftar)->with(['data_pendaftar','data_pendaftar.hubungan','data_pendaftar.jenis_tinggal','data_pendaftar.jarak','data_pendaftar.transportasi','data_pendaftar.penghasilan','data_pendaftar.pekerjaan_ayah','data_pendaftar.pendidikan_ayah','data_pendaftar.pekerjaan_ibu','data_pendaftar.pendidikan_ibu','data_pendaftar.pekerjaan_wali','data_pendaftar.pendidikan_wali','data_pendaftar.agama_ayah','data_pendaftar.agama_ibu','data_pendaftar.agama_wali','agama','hobi','cita_cita','status_pendaftar','pendaftar_kelas.kelas','nilai_akademik','nilai_akademik.mapel','prestasi_non_akademik','lampiran'])->first();
				$response = ['status' => 'success', 'data' => $data];
			} else {
				$response = ['status' => 'error'];
			}			
		} catch(Exception $e){
			$response = ['status' => 'error', 'message' => $e];
		}
		return $response;
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




