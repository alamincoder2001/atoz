<?php

namespace App\Models;

use App\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id')->with('district');
    }
}
