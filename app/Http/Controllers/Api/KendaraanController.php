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

    
}
