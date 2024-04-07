<?php

namespace Modules\Blog\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Post;

class Archives extends Component
{
    public function render()
    {
        $archives = Post::selectRaw('year(display_at) year')->groupBy('year')->orderByRaw('min(display_at) desc')->get();

        return view('blog::livewire.archives', compact('archives'))->layout('layouts.front');
    }
}
