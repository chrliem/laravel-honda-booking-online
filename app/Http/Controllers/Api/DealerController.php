<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Dealer;
use Illuminate\Http\Request;

class DealerController extends Controller
{

    public function show($id)
    {
        $booking = Booking::where('id_dealer',$id)->orderBy('created_at','DESC')->get();
        
        if(count($booking)>0){
            return response([
                'message' => 'Booking berhasil ditampilkan',
                'data' => $booking
            ], 200);
        }

        return response([
                'message' => 'Booking tidak ditemukan',
                'data' => null
        ], 404);
    }

    public function getDealer($id){
        $dealer = Dealer::find($id);

        if(!is_null($dealer)){
            return response([
                'message' => 'Dealer berhasil ditampilkan',
                'data'=>$dealer
            ],200);
        }

        return response([
            'message' => 'Dealer tidak ditemukan',
            'data' => null
        ], 404);
    }

    public function index(){
        $dealers = Dealer::all();
        if(count($dealers)>0){
            return response([
                'message' => 'Data Dealer Berhasil Diperoleh',
                'data' => $dealers
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);
    }

    public function create(Request $request){
        $newData = $request->all();

        $newData = Dealer::create($newData);
        return response([
            'message'=>'Tambah Dealer berhasil',
            'data'=> $newData
        ], 200);
    }

    public function edit(Request $request, $id){
        $dealer = Dealer::find($id);
        if(is_null($dealer)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $dealer->kode_dealer = $updateData['kode_dealer'];
        $dealer->nama_dealer  = $updateData['nama_dealer'];
        $dealer->alamat_dealer = $updateData['alamat_dealer'];       
        
        if($dealer->save()){
            return response([
                'message'=>'Data berhasil diubah',
                'data'=>$dealer
            ], 200);
        }

    }

    public function delete($id){
        $dealer = Dealer::find($id);

        if(is_null($dealer)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404); 
        }

        if($dealer->delete()){
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
