@section('title', 'Edit Dog')
<div>
    <h1>Edit Dog</h1>

    <div class="flex justify-between my-5">
        <div>
            <a href="{{ route('admin.dogs.index') }}">Dogs</a>
            <span class="dark:text-gray-200">- Edit Dog</span>
        </div>
        <div>
            <a href="{{ route('dogs.show', $dog->slug) }}">View Dog</a>
        </div>
   </div>

    <x-form wire:submit="update" wire:keydown.enter.prevent="">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-form.input wire:model="title" label="Title" name="title" required />
            <x-form.input wire:model="slug" label="Slug" name="slug" required />
            <x-form.select :data="$genders" wire:model="sex" label="Sex" name="sex" />
            <x-form.input wire:model="weight" label="Weight" name="weight" />
            <x-form.date wire:model="dob" label="Date of Birth" name="dob" />
            <div>
                <x-form.checkbox wire:model="vaccinated" label="Vaccinated" name="vaccinated" />
                <x-form.checkbox wire:model="microChipped" label="Micro chipped" name="microChipped" />
                <x-form.checkbox wire:model="sprayed" label="Spayed/Neutered" name="sprayed" />
            </div>

            <div>
                <x-form.input type="file" wire:model="image" label="Image" name="image" />
                @if ($image)
                    <p>Image Preview:</p>
                    <p><img style="height: 200px;" src="{{ $image->temporaryUrl() }}"></p>
                @elseif($exitingImage !='')
                    <p><img src="{{ url($exitingImage) }}"></p>
                @endif
            </div>

            <div>
                <p>Personality Traits</p>
                @foreach($traits as $traitItem)
                    <div class="flex">
                        <x-form.checkbox wire:model="{{ $traitItem }}" label="{{ $traitItem }}" name="traitItem" required />
                        <button type="button" wire:click="removeTrait('{{ $traitItem }}')"><i class="fa fa-times"></i></button>
                    </div>
                @endforeach

                <div class="flex mt-1 w-full">
                    <input
                        type="text"
                        wire:model="trait"
                        wire:keydown.enter="addTrait"
                        name="trait"
                        class="w-9/10 p-1 border focus:outline-none">
                    <button type="button" wire:click="addTrait" class="bg-primary text-white py-1.5 px-2 rounded-r-md">
                        <i class="fa fa-plus"></i> Add Trait
                    </button>
                </div>

            </div>

        </div>

        <x-form.ckeditor wire:model="keyFeatures" label="Key Features" name="keyFeatures" />
        <x-form.ckeditor wire:model="description" name="description" required />
        <x-form.ckeditor wire:model="content" name="content" required />

        <x-form.submit class="mt-5">Submit</x-form.submit>
    </x-form>

</div>
