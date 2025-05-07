<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessModel extends Model
{
    use HasFactory;
    protected $table = 'access_models';
    protected $primarykey ='id';

    protected $fillable = [
        'name',
           
    ];
}
