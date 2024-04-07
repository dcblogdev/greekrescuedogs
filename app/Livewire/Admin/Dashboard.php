<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Title;
use Livewire\Component;
use Modules\Products\Models\Purchase;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        abort_if_cannot('view_dashboard');

        return view('livewire.admin.dashboard');
    }
}
