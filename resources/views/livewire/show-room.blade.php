<div class="mt-10">

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full dark:hidden rounded-2xl" src="{{$room->image}}" alt="Room Image">
            <img class="w-full hidden dark:block" src="{{$room->image}}" alt="dashboard image">
            <div class="mt-4 md:mt-0">
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$room->roomType->name}}</span>

                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{$room->name}}</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">{{$room->description}}</p>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">Starting From ${{$room->current_price}}</p>

                <p class="mt-6">
            <a href="{{route('reservation.create', $room->id)}}">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Book Now
                </button>
            </a>
                </p>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="max-w-screen-md mb-8 lg:mb-16">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Ready for renters like yours</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Here at Majd Properties we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">

                @foreach($room->features as $feature)
                    <div wire:key="{{$feature->id}}">
                        <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                            @include('components.feature-icon')
                        </div>
                        <h3 class="mb-2 text-xl font-bold dark:text-white">{{$feature->name}}</h3>
                        <p class="text-gray-500 dark:text-gray-400">{{$feature->description}}</p>

                        <p class="text-gray-500 dark:text-gray-400">${{$feature->price}}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
