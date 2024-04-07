@section('title', $dog->title)

@section('meta')
    <meta itemprop="name" content="{{ $dog->title }}">
    <meta itemprop="description" content="{!! strip_tags(Str::limit($dog->description, 100)) !!}">
    @if (!empty($dog->image))
        <meta itemprop="image" content="{{ url($dog->image) }}">
    @endif
    <meta name='description' content='{!! strip_tags(Str::limit($dog->description, 100)) !!}'>
    <meta property="article:published_time" content="{{ $dog->created_at }}"/>
    <meta property="article:modified_time" content="{{ $dog->updated_at }}"/>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url($dog->slug) }}">
    <meta property="og:title" content="{{ $dog->title }}">
    <meta property="og:description" content="{!! strip_tags(Str::limit($dog->description, 100)) !!}">
    @if (!empty($dog->image))
        <meta property="og:image" content="{{ url(trim($dog->image)) }}">
    @endif
    <!-- Twitter -->
    <meta name="twitter:url" content="{{ url($dog->slug) }}">
    <meta name="twitter:title" content="{{ $dog->title }}">
    <meta name="twitter:description" content="{!! strip_tags(Str::limit($dog->description, 100)) !!}">
    @if (!empty($dog->image))
        <meta name="twitter:image" content="{{ url(trim($dog->image)) }}">
    @endif
    <link rel="canonical" href='{{ url($dog->slug) }}'>
@stop

<div>

    <div id="featured">
        <div class="container max-w-screen-lg mx-auto px-8 py-12 mb-12">

            <div class="py-5 mx-auto block px-4 w-full">
                <h1 class="mb-10 font-bold text-5xl text-black">
                    {{ config('app.name') }}
                </h1>

                <h2 class="font-bold text-3xl text-black">Meet {{ $dog->title }}</h2>

                @auth
                    <p><a href="{{ url("admin/dogs/edit/$dog->id") }}">Edit</a></p>
                @endauth

            </div>

        </div>
    </div>

    <div class="container max-w-screen-lg pb-16 mx-auto">

        <div class="overflow-hidden mb-10 px-8 py-4 rounded-lg">

            <div class="grid grid-cols-2">

                <div>
                    @if(!empty($dog->image))
                        <div class="flex-shrink-0">
                            <a href="{{ route('dogs.show', $dog) }}" class="block">
                                <img class="w-full object-cover rounded-t-lg" src="{{ url($dog->image) }}"
                                     alt="{{ $dog->image_alt }}">
                            </a>
                        </div>
                    @endif
                </div>

                <div class="px-5">

                    <div class="bg-gray-100 rounded-lg p-5">
                        <h2 class="font-bold text-xl mb-5 text-black">{{ $dog->title }}</h2>

                        {!! $description !!}

                    </div>

                    <div class="p-1">
                        <ul class="grid grid-cols-2 pl-0 list-none bullet-bg bullet-soft-green !mb-0">
                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>{{ $dog->sex }}</span></li>
                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>
                                @if($dog->vaccinated)
                                    Vaccinated
                                @endif
                            </span></li>

                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>{{ $dog->weight }}</span></li>
                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>
                                @if($dog->micro_chipped)
                                    Micro Chipped
                                @endif
                            </span></li>

                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>{{ $dog->age }}</li>
                            <li class="relative flex items-center"><span class="pr-[.75rem]"><i class="uil uil-check w-4 h-4 text-[0.8rem] leading-none tracking-[normal] !text-center flex justify-center items-center !bg-[#def4ee] !text-[#45c4a0] rounded-[100%] top-[0.2rem] before:content-['\e9dd'] before:align-middle before:table-cell"></i></span><span>
                                @if($dog->sprayed)
                                    Spayed/Neutered
                                @endif
                            </span></li>
                        </ul>


                    </div>

                </div>

            </div>

            <div class="my-5">
                @foreach($tags as $tag)
                    {{ $tag }}
                @endforeach
            </div>

            <div>
                <h2>Key Features</h2>

                {!! $keyFeatures !!}
            </div>


            <div class="prose lg:prose-xl">
                <h2>Content</h2>
                {!! $content !!}
            </div>

        </div>

    </div>

</div>´
