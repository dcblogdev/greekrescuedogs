@section('title', 'Blog')
<div>

    <div id="featured">
        <div class="container max-w-screen-lg mx-auto px-8 py-12 mb-12">

            <div class="py-5 mx-auto block px-4 w-full">
                <h1 class="mb-10 font-bold text-5xl text-black">
                    Blog
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
