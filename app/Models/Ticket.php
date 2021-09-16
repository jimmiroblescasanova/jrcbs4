<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['ended_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

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

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function scopeOrderByContact($query, $direction = 'desc')
    {
        $query->orderBy(
            Contact::select('name')
                ->whereColumn('contacts.id', 'tickets.contact_id'),
            $direction
        );
    }

    public function scopeOrderByActivity($query, $direction = 'desc')
    {
        $query->orderBy(
            Activity::select('name')
                ->whereColumn('activities.id', 'tickets.activity_id'),
            $direction
        );
    }

    public function scopeOrderByUser($query, $direction = 'desc')
    {
        $query->orderBy(
            User::select('name')
                ->whereColumn('users.id', 'tickets.assigned_to'),
            $direction
        );
    }

}
