<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, Uuid, SoftDeletes;

    protected $table = 'projects';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'date_from',
        'date_to',
        'deadline',
        'dev_time_limit',
        'client_id',
        'trello_board',
        'note',
    ];
}
