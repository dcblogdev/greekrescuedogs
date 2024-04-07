<div class="grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
    @foreach($dogs as $dog)
        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden mb-10">

            @if(!empty($dog->image))
                <div class="flex-shrink-0">
                    <a href="{{ route('dogs.show', $dog) }}" class="block">
                        <img class="w-full object-cover rounded-t-lg" src="{{ url($dog->image) }}" alt="{{ $dog->image_alt }}">
                    </a>
                </div>
            @endif

            <div class="flex-1 bg-gray-100 text-black p-6 flex flex-col justify-between">
                <div class="flex-1">
                    <a href="{{ route('dogs.show', $dog) }}" class="block">
                        <p class="mt-2 text-xl text-black">
                            {{ $dog->title }}
                        </p>

                        <div class="mt-3 text-base leading-6 text-black">
                            {!! Str::limit(strip_tags($dog->description), 100) !!}
                        </div>

                        <ul class="grid grid-cols-3 mt-3">
                            <li>{{ $dog->sex }}</li>
                            <li>Age {{ $dog->age }}</li>
                            <li>{{ $dog->weight }}</li>
                        </ul>
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    {!! $dogs->links() !!}
</div>
