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

}
