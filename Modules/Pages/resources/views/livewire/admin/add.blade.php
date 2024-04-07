@section('title', 'Add Page')

<div>
    <h1>Add Page</h1>

    @include('errors.messages')

    <div class="my-5">
        <a href="{{ route('admin.pages.index') }}">Page</a>
        <span class="dark:text-gray-200">- Add Page</span>
   </div>

    <x-form wire:submit="store" wire:keydown.enter.prevent="">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input wire:model.blur="title" label="Title" name="title" required />
            <x-form.input wire:model="slug" label="Slug" name="slug" required />
        </div>

        <x-form.ckeditor wire:model="content" name="content" />

        <x-form.submit>Submit</x-form.submit>
    </x-form>

</div>
