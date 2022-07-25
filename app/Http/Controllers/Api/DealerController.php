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
        $booking = Booking::selectRaw(
            'bookings.kode_booking,
            bookings.nama_customer,
            bookings.email_customer,
            bookings.no_handphone,
            bookings.no_polisi,
            kendaraans.model_kendaraan,
            bookings.jenis_transmisi,
            dealers.nama_dealer,
            dealers.kode_dealer,
            bookings.jenis_transmisi,
            bookings.tgl_booking,
            bookings.jenis_pekerjaan,
            bookings.jenis_layanan,
            bookings.keterangan_customer,
            bookings.status,
            bookings.keterangan_cco,
            bookings.created_at')
            ->leftJoin('dealers','bookings.id_dealer','=','dealers.id_dealer')
            ->leftJoin('kendaraans','bookings.id_kendaraan','=','kendaraans.id_kendaraan')
            ->where('bookings.id_dealer',$id)
            ->get();
        
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


}
