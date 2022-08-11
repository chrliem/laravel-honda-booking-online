<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappInstance extends Model
{
    use HasFactory;

    protected $primaryKey = 'instance_id';
    protected $keyType = 'string';

    protected $fillable = [
        'instance_id',
        'id_dealer',
        'token',
    ];
}
