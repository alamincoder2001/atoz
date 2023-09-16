<?php

namespace App\Models;

use App\District;
use App\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Technician extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ["id"];

    public function district()
    {
        return $this->belongsTo(District::class, "district_id", "id");
    }
    public function upazila()
    {
        return $this->belongsTo(Thana::class, "thana_id", "id");
    }
}
