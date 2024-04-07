<?php

namespace Modules\Dogs\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Dogs\Database\Factories\DogFactory;
use Spatie\Tags\HasTags;

class Dog extends Model
{
    use HasFactory;
    use HasTags;
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'dob' => 'date:Y-m-d',
    ];

    protected static function newFactory(): DogFactory
    {
        return DogFactory::new();
    }

    public function getDobAttribute($value): ?string
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getAgeAttribute(): int
    {
        return Carbon::parse($this->dob)->diffInYears(now());
    }
}
