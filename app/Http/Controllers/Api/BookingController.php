<?php

namespace App\Http\Controllers\Api;
use App\Mail\NotificationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\LogController;
use App\Models\Booking;
use App\Models\Dealer;
use App\Models\Kendaraan;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use App\Events\BookingAdded;

class BookingController extends Controller
{
    //Tampil semua data tanpa filter (Untuk keperluan testing)
    public function index()
    {
        $bookings = Booking::all();
        if(count($bookings)>0){
            return response([
                'message' => 'Data Booking Berhasil Ditampilkan',
                'data' => $bookings
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);

    }

    //Tambah data booking oleh Customer
    public function create(Request $request)
    {
        $newBooking = $request->all();
        
        //Validasi inputan data
        $validate = Validator::make($newBooking, [
            'nama_customer'=>'required',
            'email_customer',
            'no_handphone'=>'required|numeric|digits_between:1,13|regex:/^((08))/',
            'no_polisi'=>'required',
            'id_kendaraan'=>'required',
            'jenis_transmisi'=>'required',
            'id_dealer'=>'required',
            'tgl_service'=>'required',
            'jenis_pekerjaan'=>'required',
            'jenis_layanan'=>'required'
        ],['nama_customer.required'=>'Nama lengkap wajib diisi',
        'no_handphone.required'=>'Nomor Handphone wajib diisi',
        'no_handphone.digits_between'=>'Format nomor handphone tidak sesuai',
        'no_handphone.regex'=>'Format nomor handphone tidak sesuai',
        'no_polisi.required'=>'Nomor polisi wajib diisi',
        'id_kendaraan.required'=>'Model kendaraan wajib diisi',
        'jenis_transmisi.required'=>'Jenis transmisi kendaraan wajib diisi',
        'id_dealer.required'=>'Pilihan dealer wajib diisi',
        'tgl_service.required'=>'Tanggal service wajib diisi',
        'jenis_kendaraan.required'=>'Jenis pekerjaan wajib diisi',
        'jenis_layanan.required'=>'Jenis layanan wajib diisi']);

        if($validate->fails())
            return response([
                'message' => $validate->errors()
        ]);

        //Generate format kode_booking
        $count = count(Booking::all())+1;
        if($count<=9){
            $formattedNum = Str::padLeft($count, 6,'00000');
        }else if($count>9 && $count<100){
            $formattedNum = Str::padLeft($count, 6,'0000');
        }else if($count>99 && $count<1000){
            $formattedNum = Str::padLeft($count, 6,'000');
        }else if($count>999 && $count<10000){
            $formattedNum = Str::padLeft($count, 6,'00');
        }else if($count>9999 && $count<100000){
            $formattedNum = Str::padLeft($count, 6,'0');
        }
        //Get kode dealer
        $dealer = Dealer::find($request->id_dealer);
        //Get current date in DDMM format 
        $date = Carbon::now()->format('dm');
        //Concatenating kode booking (Contoh: HSB.BOOK.2507.000001)
        $newBooking['kode_booking'] = $dealer->kode_dealer.'.BOOK.'.$date.'.'.$formattedNum;

        //Set status
        $newBooking['status'] = 'New';

        $booking = Booking::create($newBooking);
        
        //Proses logging ke dalam table Logs
        $log['kode_booking'] = $newBooking['kode_booking'];
        $log['detail_log'] = $booking->nama_customer.' membuat booking pada '.$booking->created_at;
        Log::create($log);

        //Get kendaraan
        $kendaraan = Kendaraan::find($request->id_kendaraan);

        //Send email
        $data = [
            'kode_booking'=>$newBooking['kode_booking'],
            'nama_customer'=>$newBooking['nama_customer'],
            'email_customer'=>$newBooking['email_customer'],
        'no_handphone'=>$newBooking['no_handphone'],
            'no_polisi'=> $newBooking['no_polisi'],
            'model_kendaraan'=>$kendaraan->model_kendaraan,
            'jenis_transmisi'=>$newBooking['jenis_transmisi'],
            'kode_dealer'=>$dealer->kode_dealer,
            'nama_dealer'=>$dealer->nama_dealer,
            'tgl_service'=>$newBooking['tgl_service'],
            'jenis_pekerjaan'=>$newBooking['jenis_pekerjaan'],
            'jenis_layanan'=>$newBooking['jenis_layanan'],
            'keterangan_customer'=>$newBooking['keterangan_customer']
        ];
        $users = User::all();
        foreach($users as $recipient){
            Mail::to($recipient->email)->send(new NotificationEmail($data, $recipient->nama));
        }

        //Tidak jadi digunakan
        // broadcast(new BookingAdded($data));

        return response([
            'message'=>'Booking berhasil dibuat',
            'data'=>$booking
        ], 200);

    }

    //Get data booking by kode booking
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
            bookings.tgl_service,
            bookings.jenis_pekerjaan,
            bookings.jenis_layanan,
            bookings.keterangan_customer,
            bookings.status,
            bookings.keterangan_cco,
            bookings.created_at')
            ->leftJoin('dealers','bookings.id_dealer','=','dealers.id_dealer')
            ->leftJoin('kendaraans','bookings.id_kendaraan','=','kendaraans.id_kendaraan')
            ->where('bookings.kode_booking',$id)
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


    //Update data booking oleh CCO
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);
        if(is_null($booking)){
            return response([
                'message'=>'Booking tidak ditemukan',
                'data'=>null
            ],404);
        }
        
        $updateBooking = $request->all();

        //Validasi inputan data
        $validate = Validator::make($updateBooking, [
            'nama_customer'=>'required',
            'email_customer',
            'no_handphone'=>'required|numeric|digits_between:1,13|regex:/^((08))/',
            'no_polisi'=>'required',
            'id_kendaraan'=>'required',
            'jenis_transmisi'=>'required',
            'id_dealer'=>'required',
            'tgl_service'=>'required',
            'jenis_pekerjaan'=>'required',
            'jenis_layanan'=>'required'
        ],['nama_customer.required'=>'Nama lengkap wajib diisi',
        'no_handphone.required'=>'Nomor Handphone wajib diisi',
        'no_handphone.digits_between'=>'Format nomor handphone tidak sesuai',
        'no_handphone.regex'=>'Format nomor handphone tidak sesuai',
        'no_polisi.required'=>'Nomor polisi wajib diisi',
        'id_kendaraan.required'=>'Model kendaraan wajib diisi',
        'jenis_transmisi.required'=>'Jenis transmisi kendaraan wajib diisi',
        'id_dealer.required'=>'Pilihan dealer wajib diisi',
        'tgl_service.required'=>'Tanggal service wajib diisi',
        'jenis_kendaraan.required'=>'Jenis pekerjaan wajib diisi',
        'jenis_layanan.required'=>'Jenis layanan wajib diisi']);
       
        if($validate->fails())
        return response([
            'message' => $validate->errors()
        ]);

        $booking->nama_customer = $updateBooking['nama_customer'];
        $booking->email_customer= $updateBooking['email_customer'];
        $booking->no_handphone = $updateBooking['no_handphone'];
        $booking->no_polisi = $updateBooking['no_polisi'];
        $booking->id_kendaraan = $updateBooking['id_kendaraan'];
        $booking->jenis_transmisi = $updateBooking['jenis_transmisi'];
        $booking->id_dealer = $updateBooking['id_dealer'];
        $booking->tgl_service = $updateBooking['tgl_service'];
        $booking->jenis_pekerjaan = $updateBooking['jenis_pekerjaan'];
        $booking->jenis_layanan = $updateBooking['jenis_layanan'];
        $booking->keterangan_customer = $updateBooking['keterangan_customer'];
        // $booking->keterangan_cco = $updateBooking['keterangan_cco'];

        if($booking->save()){
            //Logging ke tabel Logs
            $log['kode_booking'] = $booking->kode_booking;
            $log['detail_log'] = 'CCO melakukan update data pada '.Carbon::now()->format('Y-m-d H:i:s');
            Log::create($log);

            return response([
                'message'=>'Booking berhasil diupdate',
                'data'=>$booking
            ], 200);
        }

    }

    public function changeStatus(Request $request, $id){
        $booking = Booking::find($id);
        if(is_null($booking)){
            return response([
                'message'=>'Booking tidak ditemukan',
                'data'=>null
            ],404);
        }

        $updateBooking = $request->only(['status','keterangan_cco']);

        $booking->status = $request->status;
        $booking->keterangan_cco = $request->keterangan_cco;

        if($booking->save()){
            //Logging ke tabel Logs
            $log['kode_booking'] = $booking->kode_booking;
            $log['detail_log'] = 'CCO melakukan mengubah status menjadi '.$booking->status.' pada '.Carbon::now()->format('Y-m-d H:i:s');
            Log::create($log);

            return response([
                'message' => 'Berhasil mengubah status booking',
                'data' => $booking
            ], 200);
        }

        return response([
            'message' => 'Gagal mengubah status booking',
            'data'=> null
        ],400);
    }

    public function getBookingLog()
    {
        $logs = Log::all();

        if(count($logs)>0){
            return response([
                'message' => 'Log berhasil ditampilkan',
                'data' => $logs
            ], 200);
        }

        return response([
                'message' => 'Log tidak ditemukan',
                'data' => null
        ], 404);
        
    }

}
