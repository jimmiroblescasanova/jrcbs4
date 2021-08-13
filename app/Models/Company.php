<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('id', 'LIKE', '%' . $search . '%')
            ->orWhere('name', 'LIKE', '%' . $search . '%')
            ->orWhere('rfc', 'LIKE', '%' . $search . '%');
    }

    public static function report($show)
    {
        switch ($show) {
            case 1:
                return static::query()->doesntHave('contacts');
            case 2:
                return static::query()->has('contacts')->with('contacts');
            default:
                return static::query();
        }
    }

    public function setRfcAttribute($rfc)
    {
        $this->attributes['rfc'] = Str::upper($rfc);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::upper($value);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }
}
