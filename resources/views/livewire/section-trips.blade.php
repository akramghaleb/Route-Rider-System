<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <section class="bg-white border-b py-8">
        <div class="container mx-auto flex flex-wrap pt-4 pb-12">
            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
                {{ __('site.Trips') }}
            </h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
            @foreach ($trips as $trip)
            <div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <a href="/admin" class="flex flex-wrap no-underline hover:no-underline">
                        <p class="w-full text-gray-600 text-xs md:text-sm px-6">

                        </p>
                        <div class="w-full font-bold text-xl text-gray-800 px-6">
                            {{ __('site.From') }} {{ $trip->from }} | {{ __('site.To') }} {{ $trip->to  }}
                        </div>
                        <p class="text-gray-800 text-base px-6 mb-5">
                            {{ __('site.Date') }} {{ \Carbon\Carbon::createFromDate( $trip->date_of_trip ) }}
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</div>
