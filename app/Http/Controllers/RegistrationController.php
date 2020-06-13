<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Pendaftar;
use App\Prestasi;
use App\Lampiran;
use App\TahunAjaran;
use App\EmailToSend;
use App\EmailSent;
use App\Wilayah;
use App\StatusPendaftar;
use App\Mail\registrasiEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;
use App\TahunAjaranPendaftar;

class RegistrationController extends Controller
{
	protected $prefix_path;
	
	public function  __construct(){
		$this->prefix_path = "public/attachment/";
	}

    public function submitRegistration(Request $request){
		$tahun_ajaran_aktif = TahunAjaran::where('aktif', '1')->first()->id;
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
		$fileFoto = $request->input('fileFoto')['url'];
		$fileLampiran = $request->input('fileLampiran'); //array
		$email = $request->input('email');
		$agama_ayah = $request->input('agama_ayah');
		$agama_ibu = $request->input('agama_ibu');
		$agama_wali = $request->input('agama_wali');
		$uploadList = $request->input('uploadList');
		$deleteList = $request->input('deleteList');
		$peminatan = $request->input('peminatan');
		try{
			// Begin the transaction
			DB::beginTransaction();
			$data_user = [
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
					'foto_path' => str_replace('storage/temporary/foto', 'public/foto', $fileFoto),
					'email' => $email
				];
			if($request->input('id') == null){
				$pendaftar = Pendaftar::create($data_user);
			} else {
				$pendaftar = Pendaftar::updateOrCreate(['id' => $request->input('id')], $data_user);
			}
			if($request->input('id') == null){
				$tahun_ajaran_pendaftar = ['tahun_ajaran_id' => $tahun_ajaran_aktif];
				$pendaftar->tahun_ajaran_pendaftar()->create($tahun_ajaran_pendaftar);
			}
			//$data_pendaftar = DataPendaftar::where(['pendaftar_id' => $pendaftar->id])->first();
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
			$pendaftar->data_pendaftar()->updateOrCreate(['pendaftar_id' => $pendaftar->id], $detail_data_pendaftar);
			for($i=0;$i<count($nilai_akademik_data);$i++){
				$data_akademik = [
					'semester1' => $nilai_akademik_data[$i]['nilai']['semester1'],
					'semester2' => $nilai_akademik_data[$i]['nilai']['semester2'],
					'semester3' => $nilai_akademik_data[$i]['nilai']['semester3'],
					'semester4' => $nilai_akademik_data[$i]['nilai']['semester4'],
					'semester5' => $nilai_akademik_data[$i]['nilai']['semester5'],
					'keterangan' => $nilai_akademik_data[$i]['keterangan'] ?: ''
				];
				$pendaftar->nilai_akademik()->updateOrCreate(['mapel_id' => $nilai_akademik_data[$i]['id']], $data_akademik);
			}
			for($i=0;$i<count($prestasi_non_akademik_data);$i++){
				$data_prestasi = [
					'pendaftar_id' => $pendaftar->id,
					'jenis_lomba' => $prestasi_non_akademik_data[$i]['jenis_lomba'],
					'tingkat' => $prestasi_non_akademik_data[$i]['tingkat'],
					'tempat_pelaksanaan' => $prestasi_non_akademik_data[$i]['tempat_pelaksanaan'],
					'peringkat_juara' => $prestasi_non_akademik_data[$i]['peringkat_juara']
				];
				$pendaftar->prestasi_non_akademik()->updateOrCreate(['id' => $prestasi_non_akademik_data[$i]['id']]);
			}
			// cek file foto, sama atau tidak, jika tidak maka update dan hapus filenya
			// cek file lampiran, jika bertambah atau berkurang
			// semua file temporary dipindahkan jika sukses registrasi
			// semua file dihapus jika ada dalam daftar
			for($i=0;$i<count($uploadList);$i++){
				$path = $uploadList[$i]['path'];
				$data_lampiran = [
					'nama_file' => $uploadList[$i]['nama_file'],
					'jenis_file' => $uploadList[$i]['jenis_file'],
					'path' => str_replace('public/temporary/lampiran', 'public/lampiran', $path),
					'keterangan' => $uploadList[$i]['keterangan'],
				];
				$pendaftar->lampiran()->updateorCreate(['path' => str_replace('public/temporary/lampiran', 'public/lampiran', $path)], $data_lampiran);
			}
			for($i=0;$i<count($deleteList);$i++){
				$filetempdelete = str_replace('storage', 'public', $deleteList[$i]);
				Lampiran::where('path', $filetempdelete)->delete();
			}
			for($i=0;$i<count($peminatan);$i++){
				$pendaftar->peminatan_siswa()->updateOrCreate(['peminatan_id' => $peminatan[$i]['id']]);
			}
			$digits_pin = 5; //inisiasi jumlah digit pin
			$no_reg = strtoupper(Str::random(16)); //inisiasi no registrasi acak
			$pin = rand(pow(10, $digits_pin-1), pow(10, $digits_pin)-1); //inisiasi pin acak
			$status_pendaftar_data = [
				'noRegistrasi' => $no_reg,
				'pin' => $pin
			];
			$result = [
				'pendaftar' => $pendaftar->nama_lengkap,
				'no_reg' => $no_reg,
				'pin' => $pin,
				'email' => $pendaftar->email
			];
			$pendaftar->status_pendaftar()->updateOrCreate($status_pendaftar_data);
			$response = response()->json(["status" => "success", "data" => $result]);
			DB::commit();
			$filefoto_curr = str_replace('storage', 'public', $fileFoto);
			if(strpos($filefoto_curr,'public/temporary') !== false){ //jika sudah ada sebelumnya berarti tidak dieksekusi
				if(Storage::exists($filefoto_curr)){
					Storage::move($filefoto_curr, str_replace('public/temporary/foto', 'public/foto', $filefoto_curr));
				}
			}		
			for($i=0;$i<count($uploadList);$i++){
				$path = $uploadList[$i]['path'];
				if(Storage::exists($path)){
					Storage::move($path, str_replace('public/temporary/lampiran', 'public/lampiran', $path));
				}				
			}
			foreach($deleteList as $filedeletelist){
				$filedelete = str_replace('storage', 'public', $filedeletelist);
				if(Storage::exists($filedelete)){
					Storage::delete($filedelete);
				}
			}
			// Storage::delete($deleteList); // hapus daftar file langsung dgn array
		} catch(Exception $e){
			//Roll back the transaction
			DB::rollBack();
			$filefoto_curr = str_replace('storage', 'public', $fileFoto);
			if(Storage::exists($filefoto_curr)){
				Storage::delete($filefoto_curr);
			}			
			for($i=0;$i<count($uploadList);$i++){
				$path = $uploadList[$i]['path'];
				if(Storage::exists($path)){
					Storage::delete($path);
				}				
			}
			$response = response()->json(["status" => "error"]);
		}
		return $response;
	}
	
	public function tesquery(Request $request){
		try{
			$pendaftar = Pendaftar::find(13);
			//return $pendaftar->tahun_ajaran_pendaftar()->get();
			//return TahunAjaran::where('aktif', '1')->first()->tahun_ajaran;
			//$thn = TahunAjaranPendaftar::where('pendaftar_id', 13)->first()->tahun_ajaran()->where('aktif', '1')->first();
			//return $pendaftar->tahun_ajaran_pendaftar()->first()->tahun_ajaran()->where('aktif', '1')->first();
			return StatusPendaftar::where('status', 3)->get()->pendaftar()->tahun_ajaran_pendaftar()->first()->tahun_ajaran()->where('aktif', '1')->get();
			// return $thn->tahun_ajaran()->get();
		} catch(Exception $e){
			return response()->json(["status" => "error", "message" => $e]);
		}
	}
	
	public function cekPendaftar(Request $request){
		$no_reg = $request->no_registrasi;
		try {
			$pendaftar = StatusPendaftar::where('noRegistrasi', $no_reg);
			if($pendaftar->count()>0){
				return response()->json(['status' => 'success', 'data' => $pendaftar->first()->pendaftar()->first()->nama_lengkap]);
			} else {
				return response()->json(['status' => 'error']);
			}
		} catch (Exception $e){
			return response()->json(['status' => 'error']);
		}
	}
	
	//afterRegistrationSukses
	public function afterRegistrationSuksesPdf(Request $request){
		$response = $this->afterRegistrationSukses($request);
		if($response['status'] = 'success'){
			$data = $response['data'];
			try{
				$surat_pernyataan_siswa = $this->suratPernyataanSiswa($data);
				$surat_pernyataan_wali = $this->suratPernyataanWali($data);
				$kartu_registrasi = $this->kartuRegistrasi($data);
				if(($surat_pernyataan_siswa == 'success') && ($surat_pernyataan_wali == 'success') && ($kartu_registrasi == 'success')){
					if($data['email']!=null){ // fungsi kirim email
						$this->scheduleEmailSending($data);
						return response()->json(['status' => 'success']);						
					} else { // jika tidak ada email
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
	
	public function scheduleEmailSending($data){
		try{
			$is_sent = EmailSent::where(['pendaftar_id' => $data['id'],
				'email' => $data['email']]);
			if($is_sent->count() == 0){
				$to_send = EmailToSend::updateOrCreate([
					'pendaftar_id' => $data['id'],
					'email' => $data['email'],
					'data' => json_encode($data)
				]);
			}
		} catch(Exception $e){
			$this->scheduleEmailSending($data);
		}
	}
	
	//public function afterRegistrationSukses($no_reg){ // testing only
	public function afterRegistrationSukses(Request $request){
		//$no_reg = 'WODQYO15ILN2JXA0'; // for testing only
		$no_reg = $request->no_registrasi;
		try{
			$status_pendaftar = StatusPendaftar::where('noRegistrasi', $no_reg);
			if($status_pendaftar->count()>0){
				$id_pendaftar = $status_pendaftar->first()->pendaftar_id;
				$data = Pendaftar::where('id', $id_pendaftar)->with(['data_pendaftar','data_pendaftar.hubungan','data_pendaftar.jenis_tinggal','data_pendaftar.jarak','data_pendaftar.transportasi','data_pendaftar.penghasilan','data_pendaftar.pekerjaan_ayah','data_pendaftar.pendidikan_ayah','data_pendaftar.pekerjaan_ibu','data_pendaftar.pendidikan_ibu','data_pendaftar.pekerjaan_wali','data_pendaftar.pendidikan_wali','data_pendaftar.agama_ayah','data_pendaftar.agama_ibu','data_pendaftar.agama_wali','agama','hobi','cita_cita','status_pendaftar','pendaftar_kelas.kelas','nilai_akademik','nilai_akademik.mapel','prestasi_non_akademik','lampiran','peminatan'])->first();
				$data_surat = [
					'lokasi_surat' => env('TEMPAT_PERSURATAN'),
					'tanggal_surat' => date("d-m-Y"),
					'nama_kepala' => env('NAMA_KEPALA_SEKOLAH'),
					'nip_kepala' => env('NIP_KEPALA_SEKOLAH')
				];
				$new_data = array_merge_recursive($data->toArray(), $data_surat);
				$response = ['status' => 'success', 'data' => $new_data];
			} else {
				$response = ['status' => 'error'];
			}			
		} catch(Exception $e){
			$response = ['status' => 'error', 'message' => $e];
		}
		return $response;
	}

	//public function kartuRegistrasi(){ // for testing only
	public function kartuRegistrasi($data){
		//$data = $this->afterRegistrationSukses('WODQYO15ILN2JXA0')['data']; // for testing only
		$propinsi = Wilayah::where('kode', substr($data['data_pendaftar']['kel_id'], 0, 2))->first()->nama;
		$kabupaten = Wilayah::where('kode', substr($data['data_pendaftar']['kel_id'], 0, 4))->first()->nama;
		$kecamatan = Wilayah::where('kode', substr($data['data_pendaftar']['kel_id'], 0, 6))->first()->nama;
		$kelurahan = Wilayah::where('kode', $data['data_pendaftar']['kel_id'])->first()->nama;		
		$data_wilayah = [
			'propinsi' => $propinsi,
			'kabupaten' => $kabupaten,
			'kecamatan' => $kecamatan,
			'kelurahan' => $kelurahan
		];
		$new_data = array_merge($data, $data_wilayah);
        $pdf = PDF::loadView('kartuPendaftaran', $new_data)->setPaper('A4', 'portrait')->setWarnings(false);
		//return $new_data; // for testing only
		//return $pdf->stream(); // for testing only
		//die; // for testing only
		$file_name=$this->prefix_path.'Kartu_Registrasi_No_'.$data["status_pendaftar"]["noRegistrasi"].'.pdf';
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
	
	//public function suratPernyataanSiswa(){ // for testing only
	public function suratPernyataanSiswa($data){
		$pdf = PDF::loadView('suratPernyataanSiswa', $data)->setPaper('A4', 'portrait')->setWarnings(false);
		//return $pdf->stream(); // for testing only
		//die; // for testing only
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
	
	//public function suratPernyataanWali(){ // for testing only
	public function suratPernyataanWali($data){
		$pdf = PDF::loadView('suratPernyataanWali', $data)->setPaper('A4', 'portrait')->setWarnings(false);
		//return $pdf->stream(); // for testing only
		//die; // for testing only
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




