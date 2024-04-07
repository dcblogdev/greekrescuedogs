<?php

namespace Modules\Pages\Livewire;

use App\Helpers\Tags;
use Illuminate\Support\Str;
use Livewire\Component;
use Modules\Pages\Models\Page as PageModel;

class Show extends Component
{
    public $page;
    public $content;

    public function mount($slug): void
    {
        $this->page = PageModel::where('slug', $slug)->firstOrFail();
        $content = $this->page->content;
        $content = Str::markdown($content);
        $this->content = Tags::get($content);
    }

    public function render()
    {
        return view('pages::livewire.page')->layout('layouts.front');
    }
}
