

<div class="bottom-0 z-20 w-full bg-white p-4 border-gray-200 md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600 text-center sticky rounded-lg lg:hidden">

{{--    <a href="mailto:majd.ghithan20@gmail.com">--}}
{{--        {{__('Visit a link')}}--}}
{{--        <x-heroicon-m-speaker-wave class="w-6 inline text-indigo-500" />--}}
{{--    </a>--}}



    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
            <a href="mailto:majd.ghithan20@gmail.com">
                {{__('Contact Support')}}
                <x-heroicon-m-chat-bubble-oval-left-ellipsis class="w-6 inline text-indigo-500" />
            </a>
        </button>
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-900 hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">

            <a href="{{route('filament.admin.pages.my-profile')}}">
                {{__('Profile')}}
                <x-heroicon-c-user-circle class="w-6 inline text-indigo-500" />

            </a>

        </button>
        <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
            <a href="https://github.com/majdghithan">
                {{__('Github')}}
                <x-heroicon-c-arrow-uturn-up class="w-6 inline text-indigo-500" />

            </a>
        </button>
    </div>


</div>
