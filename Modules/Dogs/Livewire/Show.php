<?php

namespace Modules\Dogs\Livewire;

use App\Helpers\Tags;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Dogs\Models\Dog as DogModel;

class Show extends Component
{
    public $dog;

    public $keyFeatures;

    public $description;

    public $content;

    public $tags;

    public function mount($slug): void
    {
        $this->dog = DogModel::where('slug', $slug)->firstOrFail();

        $keyFeatures = $this->dog->key_features;
        if ($keyFeatures !== null) {
            $keyFeatures = Str::markdown($keyFeatures);
        }
        $this->keyFeatures = Tags::get($keyFeatures);

        $description = $this->dog->description;
        if ($description !== null) {
            $description = Str::markdown($description);
        }
        $this->description = Tags::get($description);

        $content = $this->dog->content;
        if ($content !== null) {
            $content = Str::markdown($content);
        }
        $this->content = Tags::get($content);

        $this->tags = $this->dog->tags()->get()->pluck('name')->toArray();
    }

    public function render()
    {
        return view('dogs::livewire.dog')->layout('layouts.front');
    }
}
