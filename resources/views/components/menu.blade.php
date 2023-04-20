<aside class="menu w-18 bg-accent text-white flex flex-col px-4 py-6 gap-y-4">
    @foreach($menu as $item)
    <div class="relative menu__item">
        <x-ui.u-button link :href="route('welcome')" color="accent" :text="$currentRoute === $item['link'] ? true : false">
            <span class="material-icons-outlined">{{ $item['icon'] }}</span>
        </x-ui.u-button>
        <div class="menu__item-tooltip bg-demi text-accent text-base font-medium shadow-lg rounded hidden absolute items-center justify-center px-2  py-1 -right-6 top-1/2 translate-x-full -translate-y-1/2">
            {{ $item['name'] }}
        </div>
    </div>
    @endforeach
</aside>
