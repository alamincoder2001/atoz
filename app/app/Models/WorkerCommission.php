<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerCommission extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_id','payment_type','amount','payment_date','note','last_payment','worker_id','given_by'];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function givenBy()
    {
        return $this->belongsTo(Admin::class, 'given_by', 'id');
    }
}
