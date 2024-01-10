<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" wire:key="{{$room->id}}">

    <a href="{{route('rooms.show', $room->id)}}" wire:navigate>
        <img class="rounded-t-lg" src="{{$room->image}}" alt="" />
    </a>

    <div class="pt-2.5 pl-5">
        <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{$room->roomType->name}}</span>

    </div>

    <div class="p-5">
        <a href="{{route('rooms.show', $room->id)}}" wire:navigate>
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$room->name}}</h5>
        </a>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$room->description}}</p>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Starting From ${{$price}}</p>


        <a href="{{route('rooms.show', $room->id)}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" wire:navigate>
            Browse More
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
        </a>
    </div>
</div>
