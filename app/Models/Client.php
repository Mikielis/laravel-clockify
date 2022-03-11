<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, Uuid;

    protected $table = 'clients';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'name',
        'country',
        'city',
        'postcode',
        'street',
        'house_number'
    ];
}
