<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionPayment extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id','payment_type','amount','payment_date','note','previous_due','manager_id','receive_by'];

    public function manager()
    {
        return $this->belongsTo(Admin::class);
    }

    public function receiveBy()
    {
        return $this->belongsTo(Admin::class, 'receive_by', 'id');
    }
}
