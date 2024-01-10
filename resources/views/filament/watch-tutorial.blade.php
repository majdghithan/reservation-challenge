<div>
    <x-filament::modal
        width="4xl">
        <x-slot name="heading">
            {{__('Watch this video to learn how to use the platform')}}
        </x-slot>
        <x-slot name="trigger">
            <x-filament::button
                icon="heroicon-o-video-camera"
                color="gray"

            >
            </x-filament::button>
        </x-slot>
        <iframe width="800" height="500" src="https://www.youtube.com/embed/rIfdg_Ot-LI" title="Laravel in 100 Seconds" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

    </x-filament::modal>
</div>
