<?php

namespace Modules\Pages\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Modules\Pages\Models\Page;

#[Title('Create Page')]
class AddPage extends Component
{
    public $title;

    public $slug;

    public $content;

    protected array $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function render(): View
    {
        abort_if_cannot('add_pages');

        return view('pages::livewire.admin.add');
    }

    public function updated($propertyName): void
    {
        if ($propertyName == 'title') {
            $this->slug = Str::slug($this->title);
        }

        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        $page = Page::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
        ]);

        add_user_log([
            'title' => 'Create page: '.$this->title,
            'link' => route('admin.pages.edit', $page),
            'reference_id' => auth()->id(),
            'section' => 'Pages',
            'type' => 'Create',
        ]);

        flash('Page created')->success();

        return redirect(route('admin.pages.index'));
    }
}
