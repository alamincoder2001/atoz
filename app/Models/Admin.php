<?php

namespace App\Models;

use App\Thana;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function thana()
    {
        return $this->belongsTo(Thana::class, 'thana_id', 'id')->with('district');
    }

    public static function checkGroupName($group, $access)
    {
        $check = false;
        $permission = Permission::where('group_name', $group)->get()->pluck('permissions');
        $accessAll = $access->where('group_name', $group);
        if (count($permission) == count($accessAll)) {
            $check = true;
        } else {
            $check = false;
        }

        return $check;
    }
    public static function checkAll($access)
    {
        $check = false;
        $permission = Permission::get();
        if (count($permission) == count($access)) {
            $check = true;
        } else {
            $check = false;
        }

        return $check;
    }
}
