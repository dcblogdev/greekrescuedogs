@section('title', 'Inspiring Stories')
@section('meta')
<meta name='description' content='A Laravel and PHP Blog talking about Laravel, Livewire, AlpineJs and related stacks'>

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->full() }}">
<meta property="og:title" content="A Laravel and PHP Blog - {{ config('app.name') }}">
<meta property="og:description" content="A Laravel and PHP Blog talking about Laravel, Livewire, AlpineJs and related stacks">
<meta property="og:image" content="{{ url('/') }}/social.png">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:creator" content="@dcblogdev" />
<meta name="twitter:url" content="{{ url()->full() }}">
<meta name="twitter:title" content="A Laravel and PHP Blog - {{ config('app.name') }}">
<meta name="twitter:description" content="A Laravel and PHP Blog talking about Laravel, Livewire, AlpineJs and related stacks">
<meta name="twitter:image" content="{{ url('/') }}/social.png">
@stop

<div>

    <div id="featured">
        <div class="container max-w-screen-lg mx-auto px-8 py-12 mb-12">

            <div class="py-5 mx-auto block px-4 w-full">
                <h1 class="mb-10 font-bold text-5xl text-black">
                    Inspiring Stories
                </h1>

            </div>

        </div>
    </div>

    <div class="container">

        <div class="mx-auto">
            <h1 class="mb-5">
                {{ $pageTitle ?? '' }}
            </h1>
        </div>

        <div class="text-white">
            @include('blog::livewire/postItems', ['posts' => $posts])
        </div>
    </div>

</div>
