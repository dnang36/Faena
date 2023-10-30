<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cus_name',
        'email',
        'address',
        'phone_number',
        'note',
        'status',
        'voucher_id'
    ];
    public function voucher(){
        return $this->hasOne(Voucher::class, 'id', 'voucher_id');
    }
    public function cart(){
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
}
