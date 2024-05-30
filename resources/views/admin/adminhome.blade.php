<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Админка') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                {{ __("Вы вошли в аккаунт как администратор!") }}

                </div>
                <style>
                    .nice-blue-button {
                        background-color: #007BFF; /* Яркий синий */
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        margin: 4px 2px;
                        cursor: pointer;
                        border-radius: 12px;
                        transition-duration: 0.4s;
                    }

                    .nice-blue-button:hover {
                        background-color: #0069D9; /* Темный синий */
                        color: white;
                    }
                </style>

                <form action="/admin/send-message" method="get" >
                    <button type="submit" class="nice-blue-button">
                        Отправить рассылку
                    </button>
                </form>
                <form action="send-email" method="get" >
                    <button type="submit" class="nice-blue-button">
                        Отправить готовую рассылку
                    </button>
                </form>

            <?php
                $userInfos = DB::table('user_infos')->get();
                ?>

                <div style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
                    <h2>Статистика посещений веб-сайта</h2>
                    <table class="table-auto">
                        <thead>
                        <tr>
                            <th class="px-4 py-2">Браузер</th>
                            <th class="px-4 py-2">ОС</th>
                            <th class="px-4 py-2">IP</th>
                            <th class="px-4 py-2">Время посещения</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($userInfos as $userInfo)
                            <tr>
                                <td class="border px-4 py-2">{{ $userInfo->browser }}</td>
                                <td class="border px-4 py-2">{{ $userInfo->os }}</td>
                                <td class="border px-4 py-2">{{ $userInfo->ip }}</td>
                                <td class="border px-4 py-2">{{ $userInfo->visit_time }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



</x-app-layout>
            </div>
        </div>
    </div>

