@section('title', 'Edit Page')
<div>
    <h1>Edit Page</h1>

    <div class="flex justify-between my-5">
        <div>
            <a href="{{ route('admin.pages.index') }}">Pages</a>
            <span class="dark:text-gray-200">- Edit Page</span>
        </div>
        <div>
            <a href="{{ route('pages.show', $page->slug) }}">View Page</a>
        </div>
   </div>

    <x-form wire:submit.prevent="update">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-form.input wire:model="title" label="Title" name="title" required />
            <x-form.input wire:model="slug" label="Slug" name="slug" required />
        </div>

        <x-form.ckeditor wire:model="content" name="content" required />

        <x-form.submit class="mt-5">Submit</x-form.submit>
    </x-form>

</div>
