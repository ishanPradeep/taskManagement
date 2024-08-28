<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLevel extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'scope'
    ];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }
}
