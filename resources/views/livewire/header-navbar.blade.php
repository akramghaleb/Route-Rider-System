<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <nav id="header" class="fixed w-full z-30 top-0 text-white">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"
                    href="{{ route('/') }}" id="brandname">
                    {{ __('site.title') }}
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center p-1 text-pink-800 hover:text-gray-900 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
                id="nav-content">
                @if(auth()->user() == null )
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a href="{{ $locale== 'en' ? 'locale/ar' : 'locale/en' }}" class="toggleColour inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="/admin">{{ __('site.lang') == 'ar' ? 'English' : 'عربي' }}</a>
                    </li>
                </ul>

                <a href="/admin" id="navAction"
                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    {{ __('site.Login') }}
                </a>
                <div class="pl-2"></div>
                <a href="/admin/register" id="navAction"
                    class="mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded-full mt-4 lg:mt-0 py-4 px-8 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
                    {{ __('site.Register') }}
                </a>
                @else
                <ul class="lg:flex justify-end flex-1 items-center" >
                    <li class="mr-3">
                        <a href="{{ $locale== 'en' ? 'locale/ar' : 'locale/en' }}" class="toggleColour inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="/admin">{{ __('site.lang') == 'ar' ? 'English' : 'عربي' }}</a>
                    </li>
                    <li class="mr-3">
                        <a class="toggleColour inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4" href="/admin">{{ __('site.Welcome') }} {{ auth()->user()->name }}</a>
                    </li>
                </ul>
                <div id="navAction"></div>
                @endif
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>
</div>
