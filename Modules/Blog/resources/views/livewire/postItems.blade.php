<div class="grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
    @foreach($posts as $post)
        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden mb-10">

            @if(!empty($post->image))
                <div class="flex-shrink-0">
                    <a href="{{ route('blog.show', $post) }}" class="block">
                        <img class="w-full object-cover rounded-t-lg" src="{{ url($post->image) }}" alt="{{ $post->image_alt }}">
                    </a>
                </div>
            @endif

            <div class="flex-1 bg-gray-100 text-black p-6 flex flex-col justify-between">
                <div class="flex-1">
                    <a href="{{ route('blog.show', $post) }}" class="block">
                        <h2 class="mt-2 text-xl leading-7 font-semibold">
                            {{ $post->title }}
                        </h2>

                        <div class="mt-3 text-base leading-6 text-black">
                            {!! Str::limit(strip_tags($post->description), 100) !!}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
