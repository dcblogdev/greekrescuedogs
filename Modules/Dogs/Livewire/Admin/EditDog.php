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

#[Title('Edit Dog')]
class EditDog extends Component
{
    use WithFileUploads;

    public Dog $dog;

    public $title;

    public $slug;

    public $image;

    public $exitingImage;

    public $keyFeatures;

    public $description;

    public $content;

    public $traits = [];

    public $trait = '';

    public $sex;

    public $genders;

    public $weight;

    public $dob;

    public $vaccinated;

    public $microChipped;

    public $sprayed;

    protected array $rules = [
        'title' => 'required',
        'description' => 'required',
        'content' => 'required',
        'image' => 'nullable|mimes:jpg,png,gif,webp',
    ];

    public function mount(): void
    {
        $this->title = $this->dog->title;
        $this->slug = $this->dog->slug;
        $this->sex = $this->dog->sex;
        $this->weight = $this->dog->weight;
        $this->vaccinated = $this->dog->vaccinated;
        $this->microChipped = $this->dog->micro_chipped;
        $this->sprayed = $this->dog->sprayed;
        $this->dob = $this->dog->dob ?? $this->dog->dob->format('d-m-Y');
        $this->exitingImage = $this->dog->image;
        $this->keyFeatures = $this->dog->key_features;
        $this->description = $this->dog->description;
        $this->content = $this->dog->content;
        //dd($this->dog->tags);
        //$this->traits = $this->dog->tags->pluck('name')->toArray();

        $this->genders = [
            'Male' => 'Male',
            'Female' => 'Female',
        ];
    }

    public function render(): View
    {
        abort_if_cannot('edit_dogs');

        return view('dogs::livewire.admin.edit');
    }

    public function updated($propertyName): void
    {
        if ($propertyName == 'title') {
            $this->slug = Str::slug($this->title);
        }

        $this->validateOnly($propertyName);
    }

    public function update(): Redirector
    {
        $this->validate();

        $this->dog->update([
            'title' => $this->title,
            'slug' => Str::slug($this->slug),
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
            if (file_exists($this->exitingImage)) {
                Storage::disk('images')->delete($this->exitingImage);
            }

            $name = $this->slug.'.png';
            $img = Image::make($this->image)->encode('png')->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream();

            Storage::disk('images')->put('dogs/'.$name, $img);

            $this->dog->update(['image' => 'images/dogs/'.$name]);
        }

        $this->dog->syncTags($this->traits);

        add_user_log([
            'title' => 'Updated dog: '.$this->title,
            'link' => route('admin.dogs.edit', $this->dog),
            'reference_id' => auth()->id(),
            'section' => 'Dog',
            'type' => 'Update',
        ]);

        flash('Dog updated')->success();

        return redirect(route('admin.dogs.edit', $this->dog));
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
