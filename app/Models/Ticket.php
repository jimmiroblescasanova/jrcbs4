<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['ended_at'];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
