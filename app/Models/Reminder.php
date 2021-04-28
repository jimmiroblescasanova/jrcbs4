<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reminder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['due_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
