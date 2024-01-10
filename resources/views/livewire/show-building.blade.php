<div class="mt-10">
    <section class="bg-white dark:bg-gray-900">
        <div class="gap-8 items-center py-8 px-4 mx-auto max-w-screen-xl xl:gap-16 md:grid md:grid-cols-2 sm:py-16 lg:px-6">
            <img class="w-full dark:hidden rounded-2xl" src="{{$building->featured_image}}" alt="Building Image">
            <img class="w-full hidden dark:block" src="{{$building->featured_image}}" alt="dashboard image">
            <div class="mt-4 md:mt-0">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{$building->name}}</h2>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">{{$building->description}}</p>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">{{$building->city}}</p>
                <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">{{$building->exact_address}}</p>
                <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$building->propertyType->name}}</span>

            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Rooms</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">Browse our recent rooms</p>
            </div>
            <div class="grid gap-8 lg:grid-cols-3">
                @foreach($building->rooms as $room)
                    <livewire:components.room-card :room="$room" />
                @endforeach

            </div>
        </div>
    </section>
</div>
