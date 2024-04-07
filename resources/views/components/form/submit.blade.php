<x-button
    type="submit"
    id="submit"
    aria-live="polite"
    {{ $attributes->merge(['class' => 'btn btn-primary']) }}
>
    {{ $slot }}
</x-button>
