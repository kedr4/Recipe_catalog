<!DOCTYPE html>
<html lang="{{ __('messages.current_lang') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.about') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    @php use App\Models\ClickCounters; @endphp
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #DCDCDC;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            height: 100%;
        }

        .calendar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin-bottom: 7px;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
        }

        header h1 {
            margin: 0;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }


        .hero h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .blue {color:blue;}
        .red{color:red;}
        .green{color:green;}

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: darkorange;
        }
        .click-count {
            font-size: 20px;
            color: #333;
            margin-top: 10px;
        }
        .lang-btn {
            color: orange;
            position: absolute;
            right: 200px;
            border: 2px solid orange;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>{{ __('messages.about') }}</h1>
        <a href="/login"><img src="/images/icon.png" alt="Icon" style="float: right; margin-top: -20px; width: 50px; height: auto;"></a>
        <nav>
            <ul>
                <li><a href="/">{{ __('messages.home') }}</a></li>
                <li><a href="/recipes">{{ __('messages.recipes') }}</a></li>
                <li><a href="/search">{{ __('messages.search') }}</a></li>
                <li><a href="/about">{{ __('messages.about') }}</a></li>
                <li><a href="{{route('locale',__('messages.set_lang'))}}" class="lang-btn">{{ __('messages.set_lang') }}</a></li>
            </ul>
        </nav>
        @php
            $link = DB::table('links')->find(1);
        @endphp
    </div>
</header>
<!--
        <form action="/process-text" method="POST">
            @csrf
    <input type="text" id="user_input" name="user_input" placeholder="{{ __('messages.enter_text_for_check') }}" size="150">
            <button type="submit">{{ __('messages.check') }}</button>
        </form>

      <div id="processed_text">
            {!! $processedText !!}
    </div>
    <p></p>
-->
<section class="about" style="position: relative;">
    <div class="container">
        <h2>{{ __('messages.about') }}</h2>
        <p>{{ __('messages.about_text') }}</p>
        <p>{{ __('messages.text_check_instructions') }}</p>
        <a href="/link/{{ $link->id }}" class="btn">{{ $link->url }}</a>
        <p class="click-count">{{ __('messages.click_count') }}: {{ $link->clicks }}</p>
    </div>
</section>


<footer>
    <div class ="calendar-container">
        @include('calendar')
        <p>{{ __('messages.footer_text') }}</p>
    </div>

</footer>
@php
    app(\App\Http\Controllers\ProfileController::class)->logVisitedPages(request());
@endphp
</body>
</html>
