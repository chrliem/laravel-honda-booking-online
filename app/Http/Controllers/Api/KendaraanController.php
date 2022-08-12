<?php

namespace App\Http\Controllers\Api;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class KendaraanController extends Controller
{
    public function index(){
        $kendaraans = Kendaraan::all();
        if(count($kendaraans)>0){
            return response([
                'message' => 'Data Kendaraan Berhasil Diperoleh',
                'data' => $kendaraans
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);
    }
    
    
    public function getKendaraan($id){
        $kendaraan = Kendaraan::find($id);

        if(!is_null($kendaraan)){
            return response([
                'message' => 'Kendaraan berhasil ditampilkan',
                'data'=>$kendaraan
            ],200);
        }

        return response([
            'message' => 'Kendaraan tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function create(Request $request){
        $newData = $request->all();

        $newData = Kendaraan::create($newData);
        return response([
            'message'=>'Tambah Kendaraan berhasil',
            'data'=> $newData
        ], 200);
    }

    public function edit(Request $request, $id){
        $kendaraan = Kendaraan::find($id);
        if(is_null($kendaraan)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $kendaraan->model_kendaraan = $updateData['model_kendaraan'];

        if($kendaraan->save()){
            return response([
                'message'=>'Data berhasil diubah',
                'data'=>$kendaraan
            ], 200);
        }

    }

    public function delete($id){
        $kendaraan = Kendaraan::find($id);

        if(is_null($kendaraan)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404); 
        }

        if($kendaraan->delete()){
            return response([
                'message' => 'Data berhasil dihapus',
                'data' => null
            ],200);
        }

        return response([
            'message' => 'Gagal menghapus data',
            'data' => null
        ], 400); 
    }
    
}
