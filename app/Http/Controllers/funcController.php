<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agama;
use App\Hobi;
use App\Kelas;
use App\CitaCita;
use App\JenisTinggal;
use App\Transportasi;
use App\Jarak;
use App\Pekerjaan;
use App\PendaftarKelas;
use App\Pendidikan;
use App\Penghasilan;
use App\Hubungan;
use App\Lampiran;
use App\Wilayah;
use App\Mapel;
use App\Info;
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
	
	public function uploadLampiran(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
				$jenis_file = $request->input('jenis_file');
				$keterangan = $request->input('keterangan') ? $request->input('keterangan') : null;
				if($request->jenis_file == 'foto'){
					$temp_path = 'public/foto/';
				} else {
					$temp_path = 'public/lampiran/';
				}
				$path = $file->store($temp_path);
				$fileName = ltrim($path, $temp_path);
				$full_path = Storage::url($path);
				$response = response()->json(["status" => "success", "url" => $full_path, "fileName" => $fileName, "jenis_file" => $jenis_file, "keterangan" => $keterangan]);
            } catch (Exception $e) {
                $response = response()->json(["status" => "error", "message" => $e]);
            }
            //SET HEADERNYA
            @header('Content-type: application/json; charset=utf-8');
            return $response;
        }
    }
	
	public function hapusFileDokumen(Request $request){
		$file = '/public/'.$request->jenis_file.'/'.$request->filename;
		Storage::delete($file);
	}
	
	public function updateLampiranUser(Request $request){
		try{
			Lampiran::updateOrCreate(['pendaftar_id' => $request->id],[
				'nama_file' => $request->input('nama_file'),
				'path' => $request->input('path'),
				'jenis_file' => $request->input('jenis_file'),
				'keterangan' => $request->input('keterangan')
			]);
			$response = response()->json(["status" => "success"]);
		} catch (Exception $e) {
			$response = response()->json(["status" => "error", "message" => $e]);
		}
		return $response;
	}	
	
	public function hapusLampiranUser(Request $request){
		try{
			$lampiran = Lampiran::where(['nama_file' => $request->input('nama_file')]);
			if($lampiran->count()>0){
				$lampiran->first()->delete();
				$response = response()->json(["status" => "success"]);
			} else {
				$response = response()->json(["status" => "error"]);
			}			
		} catch (Exception $e) {
			$response = response()->json(["status" => "error", "message" => $e]);
		}
		return $response;
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

    public function hobi(){
        return Hobi::all();
    }

    public function cita_cita(){
        return CitaCita::all();
    }

    public function jenis_tinggal(){
        return JenisTinggal::all();
    }

    public function transportasi(){
        return Transportasi::all();
    }
	
    public function hubungan(){
        return Hubungan::all();
    }

	public function kelas(){
        return Kelas::all();
    }
	
    public function jarak(){
        return Jarak::all();
    }

    public function pekerjaan(){
        return Pekerjaan::all();
    }

    public function pendidikan(){
        return Pendidikan::all();
    }

    public function penghasilan(){
        return Penghasilan::all();
    }
	
	public function mapel(){
        return Mapel::all();
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
	
	public function clearAttachment(){
		try{
			$prefix_path = 'public/attachment/';
			$list = Storage::allFiles($prefix_path);
			for($i=0;$i<count($list);$i++){
				$last_modified = Storage::lastModified($list[$i]);
				if((time()-$last_modified)>900){ //1 menit = 60
					//$waktu[] = 'time:'.time().',modified:'.$last_modified.',selisih:'.(time()-$last_modified);
					Storage::delete($list[$i]);
				}
			}
			return response()->json(['status' => 'success']);
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

}
