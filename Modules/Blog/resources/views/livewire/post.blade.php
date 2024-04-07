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

    <div class="container max-w-screen-lg pb-16 mx-auto">

        <div class="flex items-center mb-6">

            <div class="ml-3">
                <div class="flex text-sm leading-5 text-gray-500 dark:text-gray-200">
                    <time datetime="{{ $post->created_at }}">{{ date('jS M Y h:i A', strtotime($post->created_at)) }}</time>
                </div>
            </div>

        </div>

        <article class="mx-auto">

            @auth
                <a href="{{ url("admin/blog/edit/$post->id") }}">Edit</a>
            @endauth

            <p>
                @foreach($post->cats as $cat)
                    <a href="{{ url('categories/'.$cat->slug) }}" class="bg-primary text-gray-200 text-sm p-2 rounded">{{ $cat->title }}</a>
                @endforeach
            </p>

            @if($toc)
                <div id="toc" class="my-5 p-5 border border-gray-500 rounded-lg">
                    <h2>Table of Contents</h2>
                    {!! $toc !!}
                </div>
            @endif

            <div id="mainContent">
                {!! $content !!}
            </div>

        </article>

        <div class='flex flex-wrap mt-10 -mx-2'>

                <div class="w-full p-2 md:w-1/2">

                    @if (isset($previous))
                    <div class="bg-primary p-2 rounded h-15">
                        <a href="{{ url($previous->slug) }}" class="text-white">
                            <div>
                                <div class="font-bold">
                                    Previous Post
                                </div>
                                <div class="text-sm">
                                    {{ $previous->title }}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                </div>

                <div class="w-full p-2 md:w-1/2">
                    @if (isset($next))
                    <div class="bg-primary p-2 rounded h-15">
                        <a href="{{ url($next->slug) }}" class="text-white">
                            <div class="text-right">
                                <div class="font-bold">
                                    Next Post
                                </div>
                                <div class="text-sm">
                                    {{ $next->title }}
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>

            </div>

    </div>

</div>
