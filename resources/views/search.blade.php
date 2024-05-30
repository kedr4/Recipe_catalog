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
            background-color: white;
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

        .lang-btn {
            color: orange;
            position: absolute;
            right: 200px;
            border: 2px solid orange;
        }

        .recipe {
            background-color: #DCDCDC;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .recipe-image {
            max-width: 150px;
            margin-left: 20px;
            border-radius: 5px;
        }

        .recipe-details {
            flex-grow: 1;
        }

        .recipe h3 {
            color: #333;
            margin-top: 0;
        }

        .author-name {
            font-weight: bold;
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }

        /* Стили для формы поиска */
        .search-form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .search-form input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: darkorange;
        }

        .recipe-date {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }

        .recipe-category {
            display: inline-block;
            margin: -7px 10px 10px 0;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: orange;
            color: white;
        }

        .category-buttons {
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .category-btn {
            padding: 10px 20px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .category-btn:hover {
            background-color: darkorange;
        }
        .scroll-to-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: orange;
            color: white;
            border: none;
            border-radius: 50%;
            text-align: center;
            line-height: 50px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
            display: none;
        }
        .scroll-to-top-btn:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1>{{ __('messages.search') }}</h1>
        <a href="/login"><img src="/images/icon.png" alt="Icon" style="float: right; margin-top: -20px; width: 50px; height: auto;"></a>
        <nav>
            <ul>
                <li><a href="/">{{ __('messages.home') }}</a></li>
                <li><a href="/recipes">{{ __('messages.recipes') }}</a></li>
                <li><a href="/search">{{ __('messages.search') }}</a></li>
                <li><a href="/about">{{ __('messages.about') }}</a></li>
                <li><a href="{{ route('locale', __('messages.set_lang')) }}" class="lang-btn">{{ __('messages.set_lang') }}</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <form class="search-form" action="{{ route('recipes.search') }}" method="GET">
        <input type="text" name="query" placeholder="{{ __('messages.enter_request') }}" required>
        <button type="submit">{{ __('messages.search') }}</button>
    </form>
    <div class="category-buttons">
        <button class="category-btn" onclick="searchByCategory('Мясные блюда')">Мясные блюда</button>
        <button class="category-btn" onclick="searchByCategory('Блюда из рыбы и морепродуктов')">Блюда из рыбы и морепродуктов</button>
        <button class="category-btn" onclick="searchByCategory('Вегетарианские блюда')">Вегетарианские блюда</button>
        <button class="category-btn" onclick="searchByCategory('Салаты')">Салаты</button>
        <button class="category-btn" onclick="searchByCategory('Супы')">Супы</button>
        <button class="category-btn" onclick="searchByCategory('Гарниры')">Гарниры</button>
        <button class="category-btn" onclick="searchByCategory('Десерты')">Десерты</button>
        <button class="category-btn" onclick="searchByCategory('Завтраки')">Завтраки</button>
        <button class="category-btn" onclick="searchByCategory('Закуски')">Закуски</button>
        <button class="category-btn" onclick="searchByCategory('Напитки')">Напитки</button>
    </div>
    <script>
        function searchByCategory(category) {
            window.location.href = "{{ route('recipes.search') }}?category=" + encodeURIComponent(category);
        }
    </script>

    @foreach($recipes as $recipe)
        <div class="recipe">
            <div class="recipe-details">
                <h3>{{ $recipe->title }}</h3>
                <p class="recipe-category">{{ $recipe->category }}</p>
                <p class="recipe-ingredients"><strong>{{ __('messages.ingredients') }}:</strong> {{ $recipe->ingredients }}</p>
                <p>{{ $recipe->description }}</p>
                <p class="recipe-date"><strong>{{ __('messages.published_date') }}:</strong> {{ $recipe->created_at->format('d.m.Y') }}</p>
                @if($recipe->author_name)
                    <p class="author-name"><strong>{{ __('messages.author') }}:</strong> {{ $recipe->author_name }}</p>
                @endif
            </div>
            @if($recipe->image)
                <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-image">
            @endif
        </div>
    @endforeach
</div>

<button onclick="scrollToTop()" class="scroll-to-top-btn" id="scrollToTopBtn">&#8593;</button>

<script>
    // Показываем или скрываем кнопку "Наверх" при скролле страницы
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }

    // Прокрутка страницы к верху
    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
</body>
</html>
