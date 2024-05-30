@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтвердить свой Email адрес') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Свежая ссылка была отправлена на Ваш Email') }}
                        </div>
                    @endif

                    {{ __('Перед тем, как продолжить, проверьте свой почтовый ящик') }}
                    {{ __('Если Вы не получили ссылку') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('запросить еще') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
