<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WhatsappInstance;
use App\Models\WhatsappTemplate;

class WhatsappTemplateController extends Controller
{
    public function index(){
        $templates = WhatsappTemplate::selectRaw(
        '   dealers.id_dealer, 
            dealers.nama_dealer,
            whatsapp_instances.instance_id,
            whatsapp_instances.token,
            whatsapp_templates.template_id,
            whatsapp_templates.namespace,
            whatsapp_templates.template_name'
        )->leftJoin('whatsapp_instances','whatsapp_templates.instance_id','=','whatsapp_instances.instance_id')
        ->leftJoin('dealers','whatsapp_instances.id_dealer','=','dealers.id_dealer')
        ->get();

        if(!is_null($templates)){
            return response([
                'message'=>'Data berhasil ditampilkan',
                'data'=>$templates
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);
    }

    public function create(Request $request){
        $newData = $request->all();

        $newData = WhatsappTemplate::create($newData);
        return response([
            'message'=>'Tambah Whatsapp Template berhasil',
            'data'=>$newData
        ]);
    }

    public function edit(Request $request, $id){
        $template = WhatsappTemplate::find($id);
        if(is_null($template)){
            return response([
                'message' => 'Template tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();

        $template->instance_id = $updateData['instance_id'];
        $template->namespace = $updateData['namespace'];
        $template->template_name = $updateData['template_name'];
        
        
        if($template->save()){
            return response([
                'message'=>'Template berhasil diubah',
                'data'=>$template
            ], 200);
        }

    }

    public function delete(Request $request, $id){
        $template = WhatsappTemplate::find($id);

        if(is_null($template)){
            return response([
                'message' => 'Data tidak ditemukan',
                'data' => null
            ], 404); 
        }

        if($template->delete()){
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
