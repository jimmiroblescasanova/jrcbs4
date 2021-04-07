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

    public function setRfcAttribute($rfc)
    {
        return $this->attributes['rfc'] = Str::upper($rfc);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
