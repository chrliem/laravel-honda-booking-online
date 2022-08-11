<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_booking';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_booking',
        'nama_customer',
        'email_customer',
        'no_handphone',
        'no_polisi',
        'id_kendaraan',
        'no_rangka',
        'id_dealer',
        'tgl_service',
        'jam_service',
        'jenis_pekerjaan',
        'jenis_layanan',
        'keterangan_customer',
        'status',
        'keterangan_cco'
    ];
    
    public function getCreatedAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->$attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAttribute(){
        if(!is_null($this->attributes['update_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }

}
