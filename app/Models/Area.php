<?php

namespace App\Models;

use App\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function upazila()
    {
        return $this->belongsTo(Thana::class, 'upazila_id', 'id');
    }
}
