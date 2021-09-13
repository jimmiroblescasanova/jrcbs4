<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
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
            ->orWhere('rfc', 'LIKE', '%' . $search . '%')
            ->orWhere('tradeName', 'LIKE', '%' . $search . '%');
    }

    public static function excludeInactive()
    {
        return static::query()->where('inactive', '=', 0);
    }

    public static function qReportContacts($show): \Illuminate\Database\Eloquent\Builder
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

    public static function qReportPrograms($show, $programs): \Illuminate\Database\Eloquent\Builder
    {
        switch ($show) {
            case 1:
                return static::query()->whereHas('programs', function (Builder $query) use ($programs) {
                    $query->whereIn('id', $programs);
                })->with('programs');
            case 2:
                return static::query()->whereDoesntHave('programs', function (Builder $query) use ($programs) {
                    $query->whereIn('id', $programs);
                })->with('programs');
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

    public function setTradeNameAttribute($value)
    {
        $this->attributes['tradeName'] = Str::upper($value);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Company::class,'childrenOf');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class, 'childrenOf');
    }
}
