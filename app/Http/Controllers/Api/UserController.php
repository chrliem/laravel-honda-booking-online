<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;


class UserController extends Controller
{
    //Tampil semua data user oleh IT
    public function index(){
        $users = User::selectRaw('users.id,
            users.nama, 
            users.email,    
            dealers.nama_dealer,
            users.id_dealer,
            users.id_role,
            users.no_handphone,
            roles.role')
        ->leftJoin('dealers','users.id_dealer','=','dealers.id_dealer')
        ->leftJoin('roles','users.id_role','=','roles.id')
        ->get();
        if(!is_null($users)){
            return response([
                'message' => 'Data User berhasil ditampilkan',
                'data' => $users
            ], 200);
        }

        return response([
            'message' => 'Belum ada data',
            'data' => null
        ], 404);
    }


    //Ubah password
    public function changePassword(Request $request, $id){
        $user = User::find($id);
        if(is_null($user)){
            return response([
                'message' => 'User tidak ditemukan',
                'data' => null
            ], 404);
        }

        $newPass = $request->all();

        $newPass['password'] = bcrypt($request->password);

        $user->password = $newPass['password'];

        if($user->save()){
            return response([
                'message'=>'Password berhasil diubah',
                'data'=>$user
            ], 200);
        }
    }

    public function delete(Request $request, $id){
        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User tidak ditemukan',
                'data' => null
            ], 404); 
        }

        if($user->delete()){
            return response([
                'message' => 'User berhasil dihapus',
                'data' => null
            ],200);
        }

        return response([
            'message' => 'Gagal menghapus user',
            'data' => null
        ], 400); 
    }

    public function edit(Request $request, $id){
        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User tidak ditemukan',
                'data' => null
            ], 404); 
        }

        $updateData = $request->only(['nama','email','id_dealer','no_handphone']);

        $user->nama = $updateData['nama'];
        $user->email = $updateData['email'];
        $user->id_dealer = $updateData['id_dealer'];
        $user->no_handphone = $updateData['no_handphone'];

        if($user->save()){
            return response([
                'message'=>'User berhasil diubah',
                'data'=>$user
            ], 200);
        }
    }
    
}
