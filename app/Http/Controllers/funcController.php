<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agama;
use App\Hobi;
use App\CitaCita;
use App\JenisTinggal;
use App\Transportasi;
use App\Jarak;
use App\Pekerjaan;
use App\Pendidikan;
use App\Penghasilan;
use App\Hubungan;
use App\Wilayah;
use App\Mapel;
use Illuminate\Support\Facades\DB;
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
	
	public function uploadImageRegistration(Request $request)
    {
        if ($request->hasFile('upload')) {
            try {
                $file = $request->file('upload'); //SIMPAN SEMENTARA FILENYA KE VARIABLE
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
                //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
                $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();

				if($request->jenis_file == 'foto'){
					$temp_path = 'uploads/foto';
				} else {
					$temp_path = 'uploads/lampiran';
				}
                $file->move(public_path($temp_path), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS
				$url = asset($temp_path.'/' . $fileName);				

                $response = response()->json(["status" => "success", "url" => $url, "fileName" => $fileName]);
            } catch (Exception $e) {
                $response = response()->json(["status" => "error", "error" => ["message" => $e]]);
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
                $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //KITA GET ORIGINAL NAME-NYA
                //KEMUDIAN GENERATE NAMA YANG BARU KOMBINASI NAMA FILE + TIME
                $fileName = $fileName . '_' . time() . '.' . $file->getClientOriginalExtension();
				$jenis_file = $request->input('jenis_file');
				$keterangan = $request->input('keterangan');
				if($request->jenis_file == 'foto'){
					$temp_path = 'uploads/foto';
				} else {
					$temp_path = 'uploads/lampiran';
				}
                $file->move(public_path($temp_path), $fileName); //SIMPAN KE DALAM FOLDER PUBLIC/UPLOADS
				$url = asset($temp_path.'/' . $fileName);				

                $response = response()->json(["status" => "success", "url" => $url, "fileName" => $fileName, "jenis_file" => $jenis_file, "keterangan" => $keterangan]);
            } catch (Exception $e) {
                $response = response()->json(["status" => "error", "error" => ["message" => $e]]);
            }
            //SET HEADERNYA
            @header('Content-type: application/json; charset=utf-8');
            return $response;
        }
    }
	
	public function hapusFileDokumen(Request $request){
		$path = public_path().'/uploads/'.$request->jenis_file.'/'.$request->filename;
		// hapus file
		try{			
			unlink($path);
			$response = response()->json(["status" => "success", "message" => "berhasil"]);
		} catch (Exception $e) {
			//$response = $e->errorInfo[1];
			$response = response()->json(["status" => "error", "error" => ["message" => $e]]);
		}
		return $response;
	}
	
	public function jumlah_pendaftar(){
		$jml = DB::table('t_pendaftar')->count();
		return response()->json(['jumlah_pendaftar' => $jml]);
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

    public function set_informasi(Request $request){
        // return Agama::all();
    }

    public function edit_informasi(Request $request){
        // return Agama::all();
    }

    public function delete_informasi(Request $request){
        // return Agama::all();
    }
}
