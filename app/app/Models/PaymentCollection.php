<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCollection extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','payment_type','amount','payment_date','note','last_payment','worker_id','receive_by'];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function receiveBy()
    {
        return $this->belongsTo(Admin::class, 'receive_by', 'id');
    }
}
