<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'phone_number',
        'tanggalLahir',
        'reminder_date',
        'expire_date',
    ];

}
