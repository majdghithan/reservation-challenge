@php
    $user = filament()->auth()->user();
@endphp

<div class="bottom-0 left-0 z-20 w-full p-4 border-t bod border-gray-100 md:flex md:items-center md:justify-between md:p-6 dark:border-gray-600">

    <a href="mailto:majd.ghithan20@gmail.com">

        {{__('Contact Support')}}

         <x-heroicon-m-chat-bubble-oval-left-ellipsis class="w-6 inline text-indigo-500" />
    </a>

</div>
