<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    use HasFactory, Uuid;

    protected $table = 'timesheet';

    protected $keyType = 'string';

    public $incrementing = false;
}
