@section('title', 'Meet the Dogs')
<div>

    @if (request()->path() == '/')
        <div id="featured">
            <div class="mx-auto max-w-2xl px-8 py-12 mb-12">

                <div class="py-5 mx-auto block px-4 w-full">
                    <h1 class="mb-10 font-bold text-5xl text-black">
                        {{ config('app.name') }}
                    </h1>

                    <h2 class="my-5 text-2xl text-black font-bold">Meet 19 dogs in urgent need of a forever home.</h2>

                    <p class="my-5 text-lg">The closure of <span class="font-bold">Compassion for Greek paws</span>, one of the best animal <span class="bold">shelters in Greece</span>, is imminent. Leaving the future of their 19 beautiful remaining dogs <span class="bold">in great peril</span>.</p>

                    <p class="my-5 text-lg">With nearby shelters already <span class="font-bold">stretched to the limit</span> their best <span class="font-bold">hope</span> is adoption or finding a place in an overseas shelter.</p>

                    <h3 class="my-5 text-xl text-black font-bold">Can you help?</h3>

                    <p class="my-5 text-lg">Donations and adoptions can help these dogs.<br>
                    Donations will help cover the cost of transportation, bloodwork, passports and other associated essential costs.</p>

                </div>

            </div>
        </div>

    @else
        <div class="mx-auto">
            <h1 class="mb-5">
                {{ $pageTitle ?? '' }}
            </h1>
        </div>
    @endif

    <div class="container mx-auto text-white">
        @include('dogs::livewire/postItems', ['dogs' => $dogs])
    </div>
</div>
