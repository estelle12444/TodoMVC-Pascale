<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'completed',
        'completed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // protected $casts = [
    //     'completed' => 'boolean',
    //     'completed_at' => 'datetime',
    //     'created_at' => 'datetime',
    //     'updated_at' => 'datetime',
    // ];

}
