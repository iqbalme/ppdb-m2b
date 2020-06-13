<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agama;
use App\Hobi;
use App\Kelas;
use App\Setting;
use App\CitaCita;
use App\TahunAjaran;
use App\TahunAjaranPendaftar;
use App\JenisTinggal;
use App\Transportasi;
use App\Jarak;
use App\Pekerjaan;
use App\PendaftarKelas;
use App\Pendidikan;
use App\Penghasilan;
use App\Hubungan;
use App\Peminatan;
use App\Lampiran;
use App\Wilayah;
use App\Mapel;
use App\Info;
use App\User;
use App\JadwalPpdb;
use App\Pendaftar;
use App\Visitors;
use App\StatusPendaftar;
use App\Mail\kontakEmail;
use App\Mail\registrasiEmail;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class funcController extends Controller
{
    public function uploadImage(Request $request)
    {
        //JIKA ADA DATA YANG DIKIRIMKAN
        if ($request->hasFile('upload')) {
            try {
                $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
                //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
                $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

                $file->move(public_path('uploads'), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS

                //KEMUDIAN KITA BUAT RESPONSE KE CKEDITOR
                // $ckeditor = $request->input('CKEditorFuncNum');
                $url = asset('uploads/' . $fileName); 
                // $msg = 'Image uploaded successfully'; 
                //DENGNA MENGIRIMKAN INFORMASI URL FILE DAN MESSAGE
                // $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";

                $response = response()->json(["url" => $url, "uploaded" => 1, "fileName" => $fileName]);
            } catch (Exception $e) {
                $response = response()->json(["error" => ["message" => $e]]);
            }
            //SET HEADERNYA
            @header('Content-type: application/json; charset=utf-8');
            return $response;
        }
    }
	
	//upload foto
	public function uploadFoto(Request $request){
		try{
			$foto = $request->file('foto');
			$foto_path = $foto->store('public/temporary/foto');
			$response = response()->json(["status" => "success", "url" => $foto_path]);
		} catch (Exception $e) {
			$response = response()->json(["status" => "error", "message" => $e]);
		}
		//SET HEADERNYA
		@header('Content-type: application/json; charset=utf-8');
		return $response;
	}
	
	public function uploadLampiran(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
				$jenis_file = $request->input('jenis_file');
				$keterangan = $request->input('keterangan') ? $request->input('keterangan') : null;
				$path = $file->store('public/temporary/lampiran');
				$response = response()->json(["status" => "success", "url" => $path]);
            } catch (Exception $e) {
                $response = response()->json(["status" => "error", "message" => $e]);
            }
            //SET HEADERNYA
            @header('Content-type: application/json; charset=utf-8');
            return $response;
        } else {
			return response()->json(["status" => "error"]);
		}
    }
	
	public function hapusFile(Request $request){
		$file = $request->input('file');
		if(Storage::exists($file)){
			Storage::delete($file);
		}		
	}
	
	public function cekPin(Request $request){
		$pin = StatusPendaftar::where(['noRegistrasi' => $request->input('no_registrasi'), 'pin' => $request->input('pin')]);
		if($pin->count()>0){
			return response()->json(["status" => "success"]);
		} else {
			return response()->json(["status" => "error"]);
		}
	}
	
	public function jumlah_pendaftar(){
		$jml = DB::table('t_pendaftar')->count();
		return response()->json(['jumlah_pendaftar' => $jml]);
	}
	
	public function jumlah_tervalidasi(){
		$jml = StatusPendaftar::where('status', 2)->count();
		return response()->json(['tervalidasi' => $jml]);
	}
	
	public function jumlah_lulus(){
		$jml = StatusPendaftar::where('status', 3)->count();
		
		return response()->json(['lulus' => $jml]);
	}

    public function agama(){
        //return Agama::all();
		return Agama::orderBy('id', 'asc')->get();
    }

	public function setting(){
        return Setting::all();
    }
	
	public function simpanSetting(Request $request){
        $id = $request->input('id');
		$setting = $request->input('setting');
		$value = $request->input('value');
		if($id==null){
			$res = Setting::create(['nama_setting' => $setting]);
		} else {
			$res = Setting::updateOrCreate(['id' => $id], ['nama_setting' => $setting, 'value' => $value]);
		}
		return $res;
    }
	
	public function hapusSetting($id){
        $setting = Setting::find($id);
		$res = $setting->delete();
		return $res;
    }

    public function hobi(){
        return Hobi::all();
    }
	
	public function simpanHobi(Request $request){
        $id = $request->input('id');
		$hobi = $request->input('hobi');
		if($id==null){
			$res = Hobi::create(['hobi' => $hobi]);
		} else {
			$res = Hobi::updateOrCreate(['id' => $id], ['hobi' => $hobi]);
		}
		return $res;
    }
	
	public function hapusHobi($id){
        $hobi = Hobi::find($id);
		$res = $hobi->delete();
		return $res;
    }

    public function cita_cita(){
        return CitaCita::all();
    }
	
	public function simpanCita(Request $request){
        $id = $request->input('id');
		$cita_cita = $request->input('cita_cita');
		if($id==null){
			$res = CitaCita::create(['cita_cita' => $cita_cita]);
		} else {
			$res = CitaCita::updateOrCreate(['id' => $id], ['cita_cita' => $cita_cita]);
		}
		return $res;
    }
	
	public function hapusCita($id){
        $cita_cita = CitaCita::find($id);
		$res = $cita_cita->delete();
		return $res;
    }

    public function jenis_tinggal(){
        return JenisTinggal::all();
    }
	
	public function transportasi(){
        return Transportasi::all();
    }
	
	public function simpanTransportasi(Request $request){
        $id = $request->input('id');
		$transportasi = $request->input('transportasi');
		if($id==null){
			$res = Transportasi::create(['transportasi' => $transportasi]);
		} else {
			$res = Transportasi::updateOrCreate(['id' => $id], ['transportasi' => $transportasi]);
		}
		return $res;
    }
	
	public function simpanProfil(Request $request){
        $username = 'admin';
		$name = 'admin';
		$password = $request->input('password');
		$res = User::updateOrCreate(['username' => $username, 'name' => $name], ['password' => bcrypt($password)]);
		return $res;
    }
	
	public function hapusTransportasi($id){
        $transportasi = Transportasi::find($id);
		$res = $transportasi->delete();
		return $res;
    }

    public function peminatan(){
        return Peminatan::all();
    }
	
	public function simpanPeminatan(Request $request){
        $id = $request->input('id');
		$peminatan = $request->input('peminatan');
		if($id==null){
			$res = peminatan::create(['peminatan' => $peminatan]);
		} else {
			$res = peminatan::updateOrCreate(['id' => $id], ['peminatan' => $peminatan]);
		}
		return $res;
    }
	
	public function hapusPeminatan($id){
        $peminatan = peminatan::find($id);
		$res = $peminatan->delete();
		return $res;
    }
	
    public function hubungan(){
        return Hubungan::all();
    }

	public function kelas(){
        return Kelas::all();
    }
	
	public function simpanKelas(Request $request){
        $id = $request->input('id');
		$kelas = $request->input('kelas');
		if($id==null){
			$res = kelas::create(['kelas' => $kelas]);
		} else {
			$res = kelas::updateOrCreate(['id' => $id], ['kelas' => $kelas]);
		}
		return $res;
    }
	
	public function hapusKelas($id){
        $kelas = kelas::find($id);
		$res = $kelas->delete();
		return $res;
    }
	
    public function jarak(){
        return Jarak::all();
    }
	
	public function simpanJarak(Request $request){
        $id = $request->input('id');
		$jarak = $request->input('jarak');
		if($id==null){
			$res = jarak::create(['jarak' => $jarak]);
		} else {
			$res = jarak::updateOrCreate(['id' => $id], ['jarak' => $jarak]);
		}
		return $res;
    }
	
	public function hapusJarak($id){
        $jarak = jarak::find($id);
		$res = $jarak->delete();
		return $res;
    }
	
	public function TahunAjaran(){
        return TahunAjaran::all();
    }
	
	public function simpanTahunAjaran(Request $request){
        $id = $request->input('id');
		$tahun_ajaran = $request->input('tahun_ajaran');
		if($id==null){
			$res = TahunAjaran::create(['tahun_ajaran' => $tahun_ajaran]);
		} else {
			$res = TahunAjaran::updateOrCreate(['id' => $id], ['tahun_ajaran' => $tahun_ajaran]);
		}
		return $res;
    }
	
	public function hapusTahunAjaran($id){
        $tahun_ajaran = TahunAjaran::find($id);
		$res = $tahun_ajaran->delete();
		return $res;
    }

    public function pekerjaan(){
        return Pekerjaan::all();
    }
	
	public function simpanPekerjaan(Request $request){
        $id = $request->input('id');
		$pekerjaan = $request->input('pekerjaan');
		if($id==null){
			$res = Pekerjaan::create(['pekerjaan' => $pekerjaan]);
		} else {
			$res = Pekerjaan::updateOrCreate(['id' => $id], ['pekerjaan' => $pekerjaan]);
		}
		return $res;
    }
	
	public function hapusPekerjaan($id){
        $pekerjaan = Pekerjaan::find($id);
		$res = $pekerjaan->delete();
		return $res;
    }

    public function pendidikan(){
        return Pendidikan::all();
    }
	
	public function simpanPendidikan(Request $request){
        $id = $request->input('id');
		$pendidikan = $request->input('pendidikan');
		if($id==null){
			$res = Pendidikan::create(['pendidikan' => $pendidikan]);
		} else {
			$res = Pendidikan::updateOrCreate(['id' => $id], ['pendidikan' => $pendidikan]);
		}
		return $res;
    }
	
	public function hapusPendidikan($id){
        $pendidikan = Pendidikan::find($id);
		$res = $pendidikan->delete();
		return $res;
    }

    public function penghasilan(){
        return Penghasilan::all();
    }
	
	public function simpanPenghasilan(Request $request){
        $id = $request->input('id');
		$penghasilan = $request->input('penghasilan');
		if($id==null){
			$res = penghasilan::create(['penghasilan' => $penghasilan]);
		} else {
			$res = penghasilan::updateOrCreate(['id' => $id], ['penghasilan' => $penghasilan]);
		}
		return $res;
    }
	
	public function hapusPenghasilan($id){
        $penghasilan = penghasilan::find($id);
		$res = $penghasilan->delete();
		return $res;
    }
	
	public function mapel(){
        return Mapel::all();
    }
	
	public function simpanMapel(Request $request){
        $id = $request->input('id');
		$mapel = $request->input('mapel');
		if($id==null){
			$res = mapel::create(['nama_mapel' => $mapel]);
		} else {
			$res = mapel::updateOrCreate(['id' => $id], ['nama_mapel' => $mapel]);
		}
		return $res;
    }
	
	public function hapusMapel($id){
        $mapel = mapel::find($id);
		$res = $mapel->delete();
		return $res;
    }

    public function propinsi(){
        //query
		$propinsi = DB::select(DB::raw("SELECT * FROM t_wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama"));
		return response()->json($propinsi);
        // SELECT kode,nama FROM t_wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama //get provinsi
        // SELECT * FROM t_wilayah WHERE LEFT(kode,2)='73' AND CHAR_LENGTH(kode)=4 ORDER BY nama  // get kabupaten
        // SELECT * FROM t_wilayah WHERE LEFT(kode,4)='7311' AND CHAR_LENGTH(kode)=6 ORDER BY nama  // get kecamatan
        // SELECT * FROM t_wilayah WHERE LEFT(kode,6)='731107' AND CHAR_LENGTH(kode)=10 ORDER BY nama // get kelurahan
    }
	
	public function kabupaten($id){
		$kabupaten = DB::select(DB::raw("SELECT * FROM t_wilayah WHERE LEFT(kode,2)=".$id." AND CHAR_LENGTH(kode)=4 ORDER BY nama"));
		return response()->json($kabupaten);
	}	
	
	public function kecamatan($id){
		$kabupaten = DB::select(DB::raw("SELECT * FROM t_wilayah WHERE LEFT(kode,4)=".$id." AND CHAR_LENGTH(kode)=6 ORDER BY nama"));
		return response()->json($kabupaten);
	}
	
	public function kelurahan($id){
		$kabupaten = DB::select(DB::raw("SELECT * FROM t_wilayah WHERE LEFT(kode,6)=".$id." AND CHAR_LENGTH(kode)=10 ORDER BY nama"));
		return response()->json($kabupaten);
	}

    public function edit_informasi(Request $request){
		$informasi = $request->input('informasi');
		// Retrieve info by name, or create it if it doesn't exist...
		$info = Info::updateOrCreate(
			['id' => 1],
			['informasi' => $informasi]
		);
		return response()->json(['status' => 'success', 'data' => $info]);
    }

	public function info(){
		try{
			$info = Info::firstOrCreate(['id' => 1]);
			return response()->json(['status' => 'success', 'data' => $info]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}		
	}
	
	public function status(Request $request){
		$str_cari = $request->input('pencarian');
		$pendaftar = Pendaftar::select(['id','nama_lengkap', 'tempat_lahir', 'tanggal_lahir'])->where('nama_lengkap', 'like', '%' . $str_cari . '%')->with('status_pendaftar:pendaftar_id,noRegistrasi,status')->get();
		$status_pendaftar = StatusPendaftar::select('pendaftar_id', 'noRegistrasi', 'status')->where('noRegistrasi', 'like', '%' . $str_cari . '%')->with('pendaftar:id,nama_lengkap,tempat_lahir,tanggal_lahir')->get();
		$data = [];
		for($i=0;$i<$pendaftar->count();$i++){
			array_push($data, [
				'id' => $pendaftar[$i]->id,
				'nama_lengkap' => $pendaftar[$i]->nama_lengkap,
				'tempat_lahir' => $pendaftar[$i]->tempat_lahir,
				'tanggal_lahir' => $pendaftar[$i]->tanggal_lahir,
				'noRegistrasi' => $pendaftar[$i]->status_pendaftar->noRegistrasi,
				'status' => $pendaftar[$i]->status_pendaftar->status
			]);
		}
		for($i=0;$i<$status_pendaftar->count();$i++){
			array_push($data, [
				'id' => $status_pendaftar[$i]->pendaftar_id,
				'nama_lengkap' => $status_pendaftar[$i]->pendaftar->nama_lengkap,
				'tempat_lahir' => $status_pendaftar[$i]->pendaftar->tempat_lahir,
				'tanggal_lahir' => $status_pendaftar[$i]->pendaftar->tanggal_lahir,
				'noRegistrasi' => $status_pendaftar[$i]->noRegistrasi,
				'status' => $status_pendaftar[$i]->status
			]);
		}
		$unique_data = array_unique($data, SORT_REGULAR);
		//return $unique_data;
		return response()->json($unique_data);
	}
	
	public function updatestatus(Request $request){
		$id = $request->input('id');
		$status = $request->input('status');
		$status_pendaftar = StatusPendaftar::where('pendaftar_id', $id)->update(['status' => $status]);
		return response()->json(['status' => 'success', 'data' => $status_pendaftar]);
	}
	
	public function kirimpesan(Request $request){
		$data = [
			'nama_pengirim' => $request->input('nama_pengirim'),
			'email' => $request->input('email'),
			'subjek' => $request->input('subjek'),
			'konten' => $request->input('konten')
		];
		$status = '';
		try{
			Mail::to(env('MAIL_REPLYTO_ADDRESS', 'manduabulukumba@gmail.com'))->send(new kontakEmail($data));
			$status = 'success';
		} catch(Exception $e){
			$status = 'error';
			return response()->json(['status' => 'error']);
		}
		if (Mail::failures()) {
			$status = 'error';
        }else{
			$status = 'success';
        }
		return response()->json(['status' => $status]);
	}
	
	public function jadwal_ppdb(){
		try{
			$date_now=date_create('now');
			date_add($date_now,date_interval_create_from_date_string("30 days"));
			$waktu_akhir = date_format($date_now,"Y-m-d");
			$jadwal = JadwalPpdb::firstOrCreate(['id' => 1], ['waktu_mulai' => date("Y-m-d"), 'waktu_akhir' => $waktu_akhir]);
			return response()->json(['status' => 'success', 'data' => $jadwal]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}		
    }
	
	public function setwaktu(Request $request){
		try{
			$jadwal = JadwalPpdb::updateOrCreate(
			['id' => 1],
			['waktu_mulai' => $request->waktu_mulai, 'waktu_akhir' => $request->waktu_akhir]);
			return response()->json(['status' => 'success', 'data' => $jadwal]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}		
	}
	
	public function getAnalytics(){
		try{
			//retrieve visitors and pageview data for the current day and the last 30 days
			$analyticsData = Analytics::fetchTotalVisitorsAndPageViews(Period::days(30));
			$total = 0;
			for($i=0;$i<count($analyticsData);$i++){
				$total += $analyticsData[$i]['pageViews'];
			}
			return response()->json(['status' => 'success', 'data' => $total]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}		
	}
	
	public function getBrowserAnalytics(){
		try{
			$analyticsData = Analytics::fetchTopBrowsers(Period::days(30));
			return response()->json(['status' => 'success', 'data' => $analyticsData]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}	
	}
	
	public function analytic(){
		return response()->json(Analytics::getAnalyticsService());
	}
	
	public function getVisitors(Request $request){
		try{
			$visitors = Visitors::firstOrCreate(
				['ip' => $request->ip()]
			);
			$total = Visitors::all();
			return response()->json(['status' => 'success', 'data' => $total->count()]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}	
	}
	
	public function setKelasPendaftar(Request $request){
		try{
			$kelas_pendaftar = PendaftarKelas::updateOrCreate(
				['pendaftar_id' => $request->input('id')],
				[
					'kelas_id' => $request->input('kelas_id'),
					'nis' => $request->input('nis')	
				]
			);
			return response()->json(['status' => 'success']);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}	
	}
	
	public function deleteKelasPendaftar(Request $request){
		try{
			$kelas_pendaftar = PendaftarKelas::where('pendaftar_id', $request->input('id'))->delete();
			return response()->json(['status' => 'success']);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}	
	}
	
	public function cekKelasPendaftar(Request $request){
		try{
			$kelas_pendaftar = PendaftarKelas::where('pendaftar_id', $request->input('id'));
			if($kelas_pendaftar->count()>0){
				$data = $kelas_pendaftar->first();
			} else {
				$data = null;
			}
			return response()->json(['status' => 'success', 'data' => $data]);
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}	
	}
	
	public function isPinValid(Request $request){
		try{
			$pin = StatusPendaftar::where(['noRegistrasi' => $request->input('no_reg'), 'pin' => $request->input('pin')]);
			if($pin->count()>0){
				return response()->json(['status' => 'success']);
			} else {
				return response()->json(['status' => 'error']);
			}
		} catch(Exception $e){
			return response()->json(['status' => 'error']);
		}
	}
	
	public function bersihkanData(){
		try{
			DB::table('t_status_pendaftar')->delete();
			DB::table('t_prestasi_non_akademik')->delete();
			DB::table('t_nilai_akademik')->delete();
			DB::table('t_pendaftar_kelas')->delete();
			DB::table('t_peminatan_siswa')->delete();
			DB::table('t_email_sent')->delete();
			DB::table('t_email_to_send')->delete();
			DB::table('t_lampiran')->delete();
			DB::table('t_tahun_ajaran_pendaftar')->delete();
			DB::table('t_data_pendaftar')->delete();
			DB::table('t_pendaftar')->delete();
			$files =   Storage::allFiles('/public/');

			// Delete Files
			Storage::delete($files);
			return 'success';
		} catch(Exception $e){
			return 'error';
		}
	}

}
