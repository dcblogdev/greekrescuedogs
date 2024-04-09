<?php

namespace Modules\Dogs\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Dogs\Models\Dog;

class Index extends Component
{
    public function render(): View
    {
        $dogs = Dog::latest()->paginate(50);

        return view('dogs::livewire.index', compact('dogs'))->layout('layouts.front');
    }
}
