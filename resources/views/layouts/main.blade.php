<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
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
            background-color: #ff5722;
            color: yellow;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: red;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>{{ __('messages.catalog_title') }}</h1>
        <a href="/login"><img src="/images/icon.png" alt="Icon" style="float: right; margin-top: -20px; width: 50px; height: auto;"></a>
        <nav>
            <ul>
                <li><a href="/">{{ __('messages.home') }}</a></li>
                <li><a href="/recipes">{{ __('messages.recipes') }}</a></li>
                <li><a href="/about">{{ __('messages.about') }}</a></li>
                <li><a href="{{route('locale',__('messages.set_lang'))}}">@lang('messages.set_lang')</a></li>
            </ul>
        </nav>
    </div>
</header>

<div>
    @yield('contentmain')
</div>

<footer>
    <div class="calendar-container">
        @include('calendar')
        <p>{{ __('messages.footer_text') }}</p>
    </div>
</footer>

</body>
</html>
