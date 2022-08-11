<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WhatsappInstance;
use App\Models\WhatsappTemplate;

class WhatsappInstanceController extends Controller
{
    public function index(){
        $instances = WhatsappInstance::selectRaw(
            'dealers.id_dealer,
            dealers.nama_dealer,
            whatsapp_instances.instance_id,
            whatsapp_instances.token'
        )->leftJoin('dealers','whatsapp_instances.id_dealer','=','dealers.id_dealer')
        ->get();

        if(!is_null($instances)){
            return response([
                'message'=>'Data berhasil ditampilkan',
                'data'=>$instances
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);
    }


    public function create(Request $request){
        $newData = $request->all();

        $newData = WhatsappInstance::create($newData);
        return response([
            'message'=>'Tambah Whatsapp Instance berhasil',
            'data'=>$newData
        ]);
    }

    public function edit(Request $request, $id){
        $instance = WhatsappInstance::find($id);
        if(is_null($instance)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $instance->id_dealer = $updateData['id_dealer'];
        $instance->token  = $updateData['token'];       
        
        if($instance->save()){
            return response([
                'message'=>'Data berhasil diubah',
                'data'=>$instance
            ], 200);
        }

    }

    public function delete(Request $request, $id){
        $instance = WhatsappInstance::find($id);

        if(is_null($instance)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404); 
        }

        if($instance->delete()){
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
