<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_no',
        'name',
        'phone',
        'email',
        'companyName',
        'address',
        'country',
        'city',
        'postal_zip',
        'notes',
        ];
}
