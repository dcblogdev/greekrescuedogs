<?php

namespace Modules\Dogs\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Dogs\Database\Factories\DogFactory;
use Spatie\Tags\HasTags;

class Dog extends Model
{
    use HasFactory;
    use HasTags;
    use HasUuid;

    protected $guarded = [];

    protected $casts = [
        'dob' => 'date',
    ];

    protected static function newFactory(): DogFactory
    {
        return DogFactory::new();
    }

    public function getAgeAttribute(): int
    {
        return $this->dob->diffInYears(now());
    }
}
