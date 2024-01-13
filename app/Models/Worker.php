<?php

namespace App\Models;

use App\Thana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Worker extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['worker_code', 'name', 'father_name', 'mother_name', 'mobile', 'password', 'nid', 'commission', 'category_id', 'manager_id', 'district_id', 'thana_id', 'present_address', 'permanent_address', 'description', 'reference', 'status', 'image', 'nid_front_img', 'nid_back_img','payment_receive'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function manager()
    {
        return $this->belongsTo(Admin::class, 'manager_id', 'id');
    }
    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id')->with('district');
    }
}
