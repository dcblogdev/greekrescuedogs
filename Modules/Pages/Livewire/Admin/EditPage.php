<?php

namespace Modules\Pages\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;
use Modules\Pages\Models\Page;

#[Title('Edit Page')]
class EditPage extends Component
{
    public Page $page;

    public $title;

    public $slug;

    public $content;

    protected array $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function mount(): void
    {
        $this->title = $this->page->title;
        $this->slug = $this->page->slug;
        $this->content = $this->page->content;
    }

    public function render(): View
    {
        abort_if_cannot('edit_pages');

        return view('pages::livewire.admin.edit');
    }

    public function updated($propertyName): void
    {
        if ($propertyName == 'title') {
            $this->slug = Str::slug($this->title);
        }

        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        $this->page->update([
            'title' => $this->title,
            'slug' => Str::slug($this->slug),
            'content' => $this->content,
        ]);

        add_user_log([
            'title' => 'Updated page: '.$this->title,
            'link' => route('admin.pages.edit', $this->page),
            'reference_id' => auth()->id(),
            'section' => 'Page',
            'type' => 'Update',
        ]);

        flash('Page updated')->success();

        return redirect(route('admin.pages.edit', $this->page));
    }
}
