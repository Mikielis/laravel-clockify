<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, Uuid;

    protected $table = 'projects';

    protected $keyType = 'string';

    public $incrementing = false;
}
