@props([
    'required' => '',
    'type' => 'text',
    'name' => '',
    'label' => '',
    'value' => '',
])

@if ($label === 'none')

@elseif ($label === '')
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

<div class="mb-5">
    @if ($label !='none')
        <label for="{{ $name }}" class="block text-sm font-medium leading-5 mb-2 text-gray-700 dark:text-gray-200">{{ $label }} @if ($required != '') <span aria-hidden="true" class="error">*</span>@endif</label>
    @endif
    <div class="rounded-md shadow-sm">
        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ $slot }}"
            {{ $required }}
            {{ $attributes->twMerge([
                'class' => implode(' ', [
                    'block
                    w-full
                    dark:bg-gray-500 dark:text-gray-200 dark:placeholder-gray-200
                    rounded-md shadow-sm
                    py-2 px-3
                    sm:text-sm
                    border
                    focus:outline-none focus:border-blue-500',
                    $errors->has($name) ? 'border-red-500' : 'border-gray-300',
                ])
            ]) }}
            @if(isset($errors))
                @error($name)
                    aria-invalid="true"
                    aria-description="{{ $message }}"
                @enderror
            @endif
            >
        @error($name)
            <p class="text-red-500 dark:text-red-300" aria-live="assertive">{{ $message }}</p>
        @enderror
    </div>
</div>

