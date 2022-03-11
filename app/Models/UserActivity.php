<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory, Uuid;

    protected $table = 'user_activities';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'type',
        'page',
        'activity_description',
        'user_id',
    ];
}
