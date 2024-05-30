<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Удалить аккаунт') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('После удаления аккаунта все его ресурсы и данные будут удалены навсегда. Перед удалением аккаунта, пожалуйста, загрузите любые данные или информацию, которые вы хотите сохранить.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Удалить аккаунт') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Вы уверены, что хотите удалить свой аккаунт?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('После удаления аккаунта все его ресурсы и данные будут удалены навсегда. Пожалуйста, введите свой пароль, чтобы подтвердить, что вы хотите удалить свой аккаунт навсегда.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Пароль') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Пароль') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Отмена') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Удалить аккаунт') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
