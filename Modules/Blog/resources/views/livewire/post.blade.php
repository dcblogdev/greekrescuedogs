@section('title', $post->title)

@section('meta')
<meta itemprop="name" content="{{ $post->title }}">
<meta itemprop="description" content="{!! strip_tags(Str::limit($post->description, 100)) !!}">
@if (!empty($post->image))
<meta itemprop="image" content="{{ url($post->image) }}">
@endif
<meta name='description' content='{!! strip_tags(Str::limit($post->description, 100)) !!}'>
<meta property="article:published_time" content="{{ $post->created_at }}" />
<meta property="article:modified_time" content="{{ $post->updated_at }}" />
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url($post->slug) }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{!! strip_tags(Str::limit($post->description, 100)) !!}">
@if (!empty($post->image))
    <meta property="og:image" content="{{ url(trim($post->image)) }}">
@endif
<!-- Twitter -->
<meta name="twitter:url" content="{{ url($post->slug) }}">
<meta name="twitter:title" content="{{ $post->title }}">
<meta name="twitter:description" content="{!! strip_tags(Str::limit($post->description, 100)) !!}">
@if (!empty($post->image))
    <meta name="twitter:image" content="{{ url(trim($post->image)) }}">
@endif
<link rel="canonical" href='{{ url($post->slug) }}'>
<link rel="webmention" href='https://webmention.io/dcblog.dev/webmention'>
<link rel="pingback" href="https://webmention.io/dcblog.dev/xmlrpc" />
<link rel="pingback" href="https://webmention.io/webmention?forward={{ url($post->slug) }}" />
@stop

<div>

    <div id="featured">
        <div class="container max-w-screen-lg mx-auto px-8 py-12 mb-12">

            <div class="py-5 mx-auto block px-4 w-full">
                <h1 class="mb-10 font-bold text-5xl text-black">
                    {{ $post->title }}
                </h1>

            </div>

        </div>
    </div>

    <article class="mx-auto max-w-2xl">

        @auth
            <a href="{{ url("admin/blog/edit/$post->id") }}">Edit</a>
        @endauth

        <div id="mainContent" class="p-5">
            {!! $content !!}
        </div>

    </article>

</div>
