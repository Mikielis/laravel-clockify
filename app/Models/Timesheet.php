<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'timesheet';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'date_from',
        'date_to',
        'dev_time',
        'project_id',
        'user_id',
    ];
}
