<aside class="menu w-24 bg-accent text-white flex flex-col items-center px-4 py-6 gap-y-4 fixed h-full">
    @foreach($menu as $item)
    <div class="relative menu__item">
        <x-ui.u-button link :href="route($item['link'])" color="accent" :text="str_starts_with($currentRoute, $item['group']) ? true : false">
            <span class="material-icons-outlined">{{ $item['icon'] }}</span>
        </x-ui.u-button>
        <div class="menu__item-tooltip bg-demi text-accent text-base font-medium shadow-lg rounded hidden absolute items-center justify-center px-2  py-1 -right-6 top-1/2 translate-x-full -translate-y-1/2">
            {{ $item['name'] }}
        </div>
    </div>
    @endforeach
</aside>
