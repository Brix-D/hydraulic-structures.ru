<header class="header bg-demi p-6 flex items-center">
    <div class="flex items-center gap-x-4">
        <!-- <x-ui.u-button link :href="route('welcome')">
            <span class="material-icons-outlined">home</span>
        </x-ui.u-button> -->

        <h1 class="text-2xl text-primary font-semibold">
            Гидротехнические сооружения
        </h1>
    </div>
    <div class="flex items-center gap-x-4 ml-auto">
       
        <span class="text-xl text-primary">
            @auth
                <span class="font-medium">
                    Вы вошли как: 
                </span>
                <span class="text-secondary">
                    {{ $user->name }}
                </span>
            @endauth

            @guest
                Гость
            @endguest
        </span>
        @auth
            <span class="text-xl text-primary">
                <span class="font-medium">
                    Табельный номер:
                </span>
                <span class="text-secondary">
                    {{ $user->personnel_number }}
                </span>
            </span>
        @endauth
        <time class="text-2xl font-medium text-primary">
            {{ $currentTime }}
        </time>

        @auth
            <x-ui.u-button link :href="route('auth.logout')">
                Выйти
            </x-ui.u-button>
        @endauth

        @guest
            <x-ui.u-button link :href="route('auth.index')">
                Войти
            </x-ui.u-button>
        @endguest
    </div>
</header>

@push('styles')
    @vite('resources/css/components/header.css')
@endpush
