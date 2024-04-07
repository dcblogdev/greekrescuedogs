<?php

namespace Modules\Dogs\Livewire\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Dogs\Models\Dog;

#[Title('Create Dog')]
class AddDog extends Component
{
    use WithFileUploads;

    public $title;

    public $slug;

    public $image;

    public $keyFeatures;

    public $description;

    public $content;

    public $traits = [];

    public $trait;

    public $sex;

    public $genders;

    public $weight;

    public $dob;

    public $vaccinated = true;

    public $microChipped = true;

    public $sprayed = true;

    protected array $rules = [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
    ];

    public function render(): View
    {
        abort_if_cannot('add_dogs');

        $this->genders = [
            'Male' => 'Male',
            'Female' => 'Female',
        ];

        return view('dogs::livewire.admin.add');
    }

    public function updated($propertyName): void
    {
        if ($propertyName == 'title') {
            $this->slug = Str::slug($this->title);
        }

        $this->validateOnly($propertyName);
    }

    public function store(): Redirector|RedirectResponse
    {
        $this->validate();

        $dog = Dog::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'sex' => $this->sex,
            'weight' => $this->weight,
            'dob' => $this->dob ?? date('Y-m-d H:i:s', strtotime($this->dob)),
            'vaccinated' => $this->vaccinated,
            'micro_chipped' => $this->microChipped,
            'sprayed' => $this->sprayed,
            'key_features' => $this->keyFeatures,
            'description' => $this->description,
            'content' => $this->content,
        ]);

        if (! empty($this->image)) {
            $name = $this->slug.'.png';
            $img = Image::make($this->image)->encode('png')->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();

            Storage::disk('images')->put('dogs/'.$name, $img);

            $dog->update(['image' => 'images/dogs/'.$name]);
        }

        $dog->syncTags($this->traits);

        add_user_log([
            'title' => 'Create dog: '.$this->title,
            'link' => route('admin.dogs.edit', $dog),
            'reference_id' => auth()->id(),
            'section' => 'Dogs',
            'type' => 'Create',
        ]);

        flash('Dog created')->success();

        return redirect(route('admin.dogs.index'));
    }

    public function addTrait(): void
    {
        if ($this->trait != '') {
            $this->traits[] = $this->trait;
            $this->trait = '';
        }
    }

    public function removeTrait($trait): void
    {
        $this->traits = array_diff($this->traits, [$trait]);
    }
}
