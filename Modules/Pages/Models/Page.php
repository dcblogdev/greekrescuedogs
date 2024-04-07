<?php

namespace Modules\Pages\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Pages\Database\Factories\PageFactory;

class Page extends Model
{
    use HasFactory;
    use HasUuid;

    protected $guarded = [];

    protected static function newFactory(): PageFactory
    {
        return PageFactory::new();
    }
}
