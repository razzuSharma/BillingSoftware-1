<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLedger extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'sales_type',
        'invoice_no',
        'dr',
        'cr',
        'balance',
        'customer_id',
        'user_id',
    ];
}
