<?php

namespace App\Http\Controllers\Api;
use App\Mail\NotificationEmail;
use App\Mail\NotificationCustomer;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\LogController;
use App\Models\Booking;
use App\Models\Dealer;
use App\Models\Kendaraan;
use App\Models\Log;
use App\Models\WhatsappInstance;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Validator;
use App\Events\BookingAdded;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Storage;


class BookingController extends Controller
{
    //Tampil semua data tanpa filter (Untuk keperluan testing)
    public function index()
    {
        // $bookings = Booking::all();
        // if(count($bookings)>0){
        //     return response([
        //         'message' => 'Data Booking Berhasil Ditampilkan',
        //         'data' => $bookings
        //     ], 200);
        // }
        $bookings = Booking::selectRaw(
            'bookings.kode_booking,
            bookings.nama_customer,
            bookings.no_polisi,
            kendaraans.model_kendaraan,
            dealers.nama_dealer,
            dealers.kode_dealer,
            bookings.tgl_service,
            bookings.jenis_pekerjaan,
            bookings.jenis_layanan,
            bookings.status,
            bookings.created_at')
            ->leftJoin('dealers','bookings.id_dealer','=','dealers.id_dealer')
            ->leftJoin('kendaraans','bookings.id_kendaraan','=','kendaraans.id_kendaraan')
            ->orderBy('created_at','DESC')
            ->get();
        
            if(count($bookings)>0){
                return response([
                    'message' => 'Data Booking Berhasil diperoleh',
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
            'no_rangka',
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
        'no_rangka.required'=>'Nomor rangka kendaraan wajib diisi',
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

        //Simpan gambar
        if(!is_null($request->file('no_rangka_image'))){
            $image = $request->file('no_rangka_image');
            $fileName = Carbon::now()->toDateString().uniqid();
            (Storage::putFileAs('public/no_rangka_image',$image, $fileName.'.'.$image->getClientOriginalExtension()));
            $newBooking['no_rangka_image'] = $fileName.'.'.$image->getClientOriginalExtension();
        }
        
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
            'nama_customer'=>$booking->nama_customer,
            'email_customer'=>$booking->email_customer,
            'no_handphone'=>$booking->no_handphone,
            'no_polisi'=> $booking->no_polisi,
            'model_kendaraan'=>$kendaraan->model_kendaraan,
            'no_rangka_image'=>$booking->no_rangka_image,
            'no_rangka'=>$booking->no_rangka,
            'kode_dealer'=>$dealer->kode_dealer,
            'nama_dealer'=>$dealer->nama_dealer,
            'tgl_service'=>$booking->tgl_service,
            'jenis_pekerjaan'=>$booking->jenis_pekerjaan,
            'jenis_layanan'=>$booking->jenis_layanan,
            'keterangan_customer'=>$booking->keterangan_customer
        ];
        Mail::to($booking->email_customer)->send(new NotificationCustomer($data, $booking->nama_customer));
        $instance = WhatsappInstance::where('id_dealer',$booking->id_dealer)->first();
        /* Comment line 131-134 jika testing di localhhost dan uncomment jika deploy */
        // $users = User::all();
        $users = User::where('id_dealer',$booking->id_dealer)->get();
        foreach($users as $recipient){
            //Email notification ke CCO sesuai cabang
            Mail::to($recipient->email)->send(new NotificationEmail($data, $recipient->nama));
            //Send message ke Whatsapp CCO
            if(!is_null($instance)){
                $template = WhatsappTemplate::where('instance_id', $instance->instance_id,'and')->where('template_name','booking')->first();
                $client = new \GuzzleHttp\Client(['base_uri'=>'https://api.chat-api.com/']);
                $response = $client->request('POST',"instance$template->instance_id/sendTemplate?token=$instance->token",
                [
                    'json' => [
                            'namespace'=>$template->namespace,
                            'template'=>$template->template_name,
                            'language'=> array(
                                    'policy'=>'deterministic',
                                    'code'=>'id'
                            ),
                            'params'=>array([
                                'type'=>'body',
                                'parameters'=>array([
                                    'type'=>'text',
                                    'text'=> $booking->nama_customer
                                ])  
                             ]),
                            'phone'=>'62'.Str::substr($recipient->no_handphone,1)
                        ],
                ]);
            }
        }

        //Format menjadi 628XXXXXXXXX
        $formattedNoHP = $booking->no_handphone;
        $formattedNoHP = Str::substr($formattedNoHP,1);
        $formattedNoHP = '62'.$formattedNoHP;
        
        //Send message ke Whatsapp Customer
        if(!is_null($instance)){
            $template = WhatsappTemplate::where('instance_id', $instance->instance_id,'and')->where('template_name','booking')->first();

            $client = new \GuzzleHttp\Client(['base_uri'=>'https://api.chat-api.com/']);
 
            $response = $client->request('POST',"instance$template->instance_id/sendTemplate?token=$instance->token",
            [
                'json' => [
                        'namespace'=>$template->namespace,
                        'template'=>$template->template_name,
                        'language'=> array(
                                'policy'=>'deterministic',
                                'code'=>'id'
                        ),
                        'params'=>array([
                            'type'=>'body',
                            'parameters'=>array([
                                'type'=>'text',
                                'text'=> $booking->nama_customer
                            ])  
                         ]),
                        'phone'=>$formattedNoHP
                    ],
            ]);
    
            return response([
                'message'=>'Booking berhasil dibuat',
                'data'=>$booking,
                'chat_api'=> json_decode($response->getBody())
            ], 200);
        }else{
            return response([
                'message'=>'Booking berhasil dibuat',
                'data'=>$booking
            ]);
        }
        

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
            bookings.no_rangka,
            dealers.nama_dealer,
            dealers.kode_dealer,
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
        }else{

            return response([
                    'message' => 'Booking tidak ditemukan',
                    'data' => null
            ], 404);
        }
            
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
            'no_rangka',
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
        $booking->no_rangka = $updateBooking['no_rangka'];
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
