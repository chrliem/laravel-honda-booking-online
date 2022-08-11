<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    use HasFactory;

    protected $primaryKey = 'template_id';

    protected $fillable = [
        'template_id',
        'instance_id',
        'namespace',
        'template_name',
    ];
}
