<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable=[
        'c_name',
        'c_email',
        'c_subject',
        'c_message',
        'ip',
        'status'

    ];
}
