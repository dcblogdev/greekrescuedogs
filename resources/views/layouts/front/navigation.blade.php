<header class="relative wrapper bg-gray !bg-[rgba(246,247,249)]">
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container xl:flex-row lg:flex-row !flex-nowrap items-center">

            <div class="navbar-brand">
                <a href="/">
                    <img class="h-12" src="{{ url('images/logo.png') }}" alt="{{ config('app.name') }}">
                </a>
            </div>

            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">

                <div class="offcanvas-header xl:hidden lg:hidden flex items-center justify-between flex-row p-6">
                    <h3 class="text-white xl:text-[1.5rem] !text-[calc(1.275rem_+_0.3vw)] !mb-0">
                        {{ config('app.name') }}
                    </h3>
                    <button
                        type="button"
                        class="btn-close btn-close-white mr-[-0.75rem] m-0 p-0 leading-none text-[#343f52] transition-all duration-[0.2s] ease-in-out border-0 motion-reduce:transition-none before:text-[1.05rem] before:content-['\ed3b'] before:w-[1.8rem] before:h-[1.8rem] before:leading-[1.8rem] before:shadow-none before:transition-[background] before:duration-[0.2s] before:ease-in-out before:flex before:justify-center before:items-center before:m-0 before:p-0 before:rounded-[100%] hover:no-underline bg-inherit before:bg-[rgba(255,255,255,.08)] before:font-Unicons hover:before:bg-[rgba(0,0,0,.11)] focus:outline-0"
                        data-bs-dismiss="offcanvas" aria-label="Close">
                    </button>
                </div>

                <div class="offcanvas-body xl:!ml-auto lg:!ml-auto flex  flex-col !h-full">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/">Meet the Dogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="/blog">Inspiring Stories</a></li>
                        <li class="nav-item"><a class="nav-link" href="/adoption-process">Adoption Process</a></li>
                        <li class="nav-item"><a class="nav-link" href="/contact">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="navbar-other w-full !flex !ml-auto">
                <ul class="navbar-nav !flex-row !items-center !ml-auto">
                    <li class="nav-item hidden xl:block lg:block md:block">
                        <a href="/donate" class="btn btn-sm btn-primary text-white !bg-[#3f78e0] border-[#3f78e0] hover:text-white hover:bg-[#3f78e0] hover:border-[#3f78e0] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#3f78e0] active:border-[#3f78e0] disabled:text-white disabled:bg-[#3f78e0] disabled:border-[#3f78e0] !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">Donate</a>
                    </li>
                    <li class="nav-item xl:hidden lg:hidden">
                        <button class="hamburger offcanvas-nav-btn"><span></span></button>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>
