<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrialRequest extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'message',
        'status',
    ];
}
