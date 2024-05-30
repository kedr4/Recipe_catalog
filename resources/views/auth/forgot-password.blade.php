<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Забыли пароль? Нет проблем. Введите свой email, чтобы мы смогли отправить вам ссылку, которая поможет выбрать новый пароль.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Получить') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>