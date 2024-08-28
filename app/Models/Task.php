<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'status',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}
