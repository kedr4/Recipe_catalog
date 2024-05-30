<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add recipe</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            flex: 1;
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
        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-container div {
            margin-bottom: 15px;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input[type="text"],
        .form-container input[type="file"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none; /* Отключает возможность изменения размера вручную */
            overflow-y: hidden; /* Скрывает вертикальную прокрутку */
        }
        .form-container button {
            padding: 10px 20px;
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: darkorange;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
            margin-top: auto;
        }
        .calendar-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            margin-bottom: 7px;
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
        <h1>{{ __('messages.recipes') }}</h1>
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
    </div>
</header>
<div class="container">
    <h1>{{ __('messages.add_recipe') }}:</h1>
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">{{ __('messages.recipe_title') }}</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="author_name">{{ __('messages.author_name') }}</label>
                <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}">
                @error('author_name')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="description">{{ __('messages.description') }}</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                @error('description')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="ingredients">{{ __('messages.ingredients') }}</label>
                <textarea id="ingredients" name="ingredients" required>{{ old('ingredients') }}</textarea>
                @error('ingredients')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="category">{{ __('messages.category') }}</label>
                <select id="category" name="category" required>
                    <option value="" selected disabled>{{ __('messages.choose_category') }}</option>
                    <option value="Мясные блюда">Мясные блюда</option>
                    <option value="Блюда из рыбы и морепродуктов">Блюда из рыбы и морепродуктов</option>
                    <option value="Вегетарианские блюда">Вегетарианские блюда</option>
                    <option value="Салаты">Салаты</option>
                    <option value="Супы">Супы</option>
                    <option value="Гарниры">Гарниры</option>
                    <option value="Десерты">Десерты</option>
                    <option value="Завтраки">Завтраки</option>
                    <option value="Закуски">Закуски</option>
                    <option value="Напитки">Напитки</option>
                </select>
                @error('category')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="image">{{ __('messages.image') }}</label>
                <input type="file" id="image" name="image">
                @error('image')
                <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit">{{ __('messages.add') }}</button>
            </div>
        </form>
    </div>

    <footer>
    <div class="calendar-container">
        @include('calendar')
        <p>{{ __('messages.footer_text') }}</p>
    </div>
</footer>
@php
    app(\App\Http\Controllers\ProfileController::class)->logVisitedPages(request());
@endphp
</body>
</html>
