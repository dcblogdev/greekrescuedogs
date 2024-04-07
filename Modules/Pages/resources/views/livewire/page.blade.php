@section('title', $page->title)

@section('meta')
    <meta itemprop="name" content="{{ $page->title }}">
    <meta property="article:published_time" content="{{ $page->created_at }}"/>
    <meta property="article:modified_time" content="{{ $page->updated_at }}"/>
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url($page->slug) }}">
    <meta property="og:title" content="{{ $page->title }}">
    <!-- Twitter -->
    <meta name="twitter:url" content="{{ url($page->slug) }}">
    <meta name="twitter:title" content="{{ $page->title }}">
    <link rel="canonical" href='{{ url($page->slug) }}'>
@stop

<div>

    <div id="featured">
        <div class="container max-w-screen-lg mx-auto px-8 py-12 mb-12">

            <div class="py-5 mx-auto block px-4 w-full">
                <h1 class="mb-10 font-bold text-5xl text-black">
                    {{ $page->title }}
                </h1>

                @auth
                    <p><a href="{{ url("admin/pages/edit/$page->id") }}">Edit</a></p>
                @endauth

            </div>

        </div>
    </div>

    <div class="container max-w-screen-lg pb-16 mx-auto">

        <div class="prose lg:prose-xl">
            {!! $content !!}
        </div>

    </div>

</div>
