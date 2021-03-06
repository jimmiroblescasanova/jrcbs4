<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'annual_license',
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function getFullProgramNameAttribute()
    {
        return $this->attributes['name'] . " " . ($this->attributes['annual_license'] ? 'Anual' : 'Tradicional');
    }
}
