@section('title', 'Edit Post')
<div>
    <h1>Edit Post</h1>

    <div class="flex justify-between my-5">
        <div>
            <a href="{{ route('admin.blog.index') }}">Posts</a>
            <span class="dark:text-gray-200">- Edit Post</span>
        </div>
        <div>
            <a href="{{ route('blog.show', $post->slug) }}">View Post</a>
        </div>
   </div>

    <x-form wire:submit.prevent="update">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <x-form.input wire:model="title" label="Title" name="title" required />
            <x-form.input wire:model="slug" label="Slug" name="slug" required />
            <x-form.datetime wire:model="displayAt" label="Display At (Post won't be displayed until this date/time has passed)" required name="displayAt" />
            <div>
                <x-form.input type="file" wire:model="image" label="Image" name="image" />
                @if ($image)
                    <p>Image Preview:</p>
                    <p><img style="height: 200px;" src="{{ $image->temporaryUrl() }}"></p>
                @elseif($exitingImage !='')
                    <p><img src="{{ url($exitingImage) }}"></p>
                @endif
            </div>
            <x-form.select :data="$authors" wire:model="authorId" label="Author" placeholder="Select an author" required />
        </div>

        @foreach($traits as $traitItem)
            <x-form.checkbox wire:model="{{ $traitItem }}" label="{{ $traitItem }}" name="traitItem" required />
        @endforeach

        <p>Add Trait</p>
        <x-form.input wire:model="trait" label="Trait" name="trait" required />
        <x-button type="button" wire:click="addTrait">Add Trait</x-button>

        <x-form.ckeditor wire:model="description" name="description" required />
        <x-form.ckeditor wire:model="content" name="content" required />

        <p><label>Categories</label></p>
        @foreach($categories as $category)
            <x-form.checkbox-row :data="$category" wireName="categoriesArray" wire:key="{{ $category->id }}" />
        @endforeach

        <x-form.submit>Submit</x-form.submit>
    </x-form>

</div>
