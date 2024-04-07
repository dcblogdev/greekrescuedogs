<script src="{{ url('js/ckeditor/ckeditor.js') }}"></script>

@props([
    'name' => '',
    'label' => '',
    'required' => false
])

@if ($label == '')
    @php
        //remove underscores from name
        $label = str_replace('_', ' ', $name);
        //detect subsequent letters starting with a capital
        $label = preg_split('/(?=[A-Z])/', $label);
        //display capital words with a space
        $label = implode(' ', $label);
        //uppercase first letter and lower the rest of a word
        $label = ucwords(strtolower($label));
    @endphp
@endif
<div wire:ignore class="mt-5">
    @if ($label !='none')
        <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700 dark:text-gray-200">{{ $label }} @if ($required != '') <span aria-hidden="true" class="error">*</span>@endif</label>
    @endif
    <textarea
        x-data
        x-init="
            editor = CKEDITOR.replace($refs.item);
            editor.on('change', function(event){
                @this.set('{{ $name }}', event.editor.getData());
            })
        "
        x-ref="item"
{{--        @error($name)--}}
{{--            aria-invalid="true"--}}
{{--            aria-description="{{ $message }}"--}}
{{--        @enderror--}}
        {{ $attributes }}
    >
        {{ $slot }}
    </textarea>
</div>
@error($name)
    <p class="text-red-500 dark:text-red-300" aria-live="assertive">{{ $message }}</p>
@enderror
