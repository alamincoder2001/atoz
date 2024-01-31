<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HowToOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'title', 'description', 'title_two', 'description_two','title_three', 'description_three', 'video_link','thumbnail'];
}
