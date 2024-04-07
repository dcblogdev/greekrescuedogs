<?php

namespace Modules\Dogs\Livewire;

use App\Helpers\Tags;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Dogs\Models\Dog as DogModel;

class Show extends Component
{
    public $dog;

    public $previous;

    public $next;

    public $keyFeatures;
    public $description;
    public $content;

    public $toc;

    public $latestPosts;

    public $tags;

    public function mount($slug): void
    {
        $this->dog = DogModel::where('slug', $slug)->firstOrFail();
        $this->previous = DogModel::where('created_at', '<', $this->dog->created_at)->orderBy('created_at', 'desc')->first();
        $this->next = DogModel::where('created_at', '>', $this->dog->created_at)->orderBy('created_at')->first();

        $keyFeatures = $this->dog->key_features;
        $keyFeatures = Str::markdown($keyFeatures);
        $this->keyFeatures = Tags::get($keyFeatures);

        $description = $this->dog->description;
        $description = Str::markdown($description);
        $this->description = Tags::get($description);

        $content = $this->dog->content;
        $content = Str::markdown($content);
        $this->content = Tags::get($content);

        $this->tags = $this->dog->tags()->get()->pluck('name')->toArray();
    }

    public function render()
    {
        return view('dogs::livewire.dog')->layout('layouts.front');
    }
}
