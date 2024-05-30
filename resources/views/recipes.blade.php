<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рецепты</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            height: 100%;
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
        .featured-recipes h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .recipe {
            background-color: #DCDCDC;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            position: relative;
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
        .recipe ul {
            list-style-type: none;
            padding: 0;
        }
        .recipe ol {
            padding-left: 20px;
        }
        footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
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
        .add-recipe-btn {
            display: block;
            width: fit-content;
            margin: 20px 20px 20px -2px;
            padding: 10px 20px;
            background-color: orange;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .add-recipe-btn:hover {
            background-color: darkorange;
        }
        .author-name {
            font-weight: bold;
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }
        .recipe-date {
            font-size: 14px;
            color: #777;
            margin-top: 5px;
        }
        .recipe-ingredients {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }
        .recipe-category {
            display: inline-block;
            margin: -7px 0 0px;
            font-size: 14px;
            color: #fff;
            background-color: orange;
            border: 2px solid orange;
            padding: 5px 10px;
            border-radius: 5px;
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
        .edit-btn, .delete-btn {
            position: absolute;
            top: 10px;
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            right: 90px;
        }

        .delete-btn {
            right: 10px;
            background-color: #dc3545;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .sort-buttons {
            text-align: center;
            margin: 20px 0;
        }

        .sort-buttons a.sort-btn {
            padding: 10px 20px;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }

        .sort-buttons a.sort-btn:hover {
            background-color: #555;
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
                <li><a href="{{ route('locale', __('messages.set_lang')) }}" class="lang-btn">{{ __('messages.set_lang') }}</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <a href="{{ route('recipes.create') }}" class="add-recipe-btn">{{ __('messages.add_recipe') }}</a>
    <span>{{ __('messages.recipes_count') }}: {{ $recipeCount }}</span>
    <div class="sort-buttons">
        <a href="{{ route('recipes.index', ['sort' => 'title', 'direction' => ($sortKey == 'title' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="sort-btn">{{ __('messages.sort_by_title') }}</a>
        <a href="{{ route('recipes.index', ['sort' => 'author_name', 'direction' => ($sortKey == 'author_name' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="sort-btn">{{ __('messages.sort_by_author') }}</a>
        <a href="{{ route('recipes.index', ['sort' => 'created_at', 'direction' => ($sortKey == 'created_at' && $sortDirection == 'asc') ? 'desc' : 'asc']) }}" class="sort-btn">{{ __('messages.sort_by_date') }}</a>
    </div>
    @foreach($sortedRecipes as $recipe)
        <div class="recipe">
            <div class="recipe-details">
                <h3>{{ $recipe['title'] }}</h3>
                <p class="recipe-category">{{ $recipe['category'] }}</p>
                <p class="recipe-ingredients"><strong>{{ __('messages.ingredients') }}:</strong> {{ $recipe['ingredients'] }}</p>
                <p>{{ $recipe['description'] }}</p>
                <p class="recipe-date"><strong>{{ __('messages.published_date') }}:</strong> {{ \Carbon\Carbon::parse($recipe['created_at'])->format('d.m.Y') }}</p>
                @if($recipe['author_name'])
                    <p class="author-name"><strong>{{ __('messages.author') }}:</strong> {{ $recipe['author_name'] }}</p>
                @endif
            </div>
            @if(isset($recipe['image']))
                <img src="{{ asset('storage/' . $recipe['image']) }}" alt="{{ $recipe['title'] }}" class="recipe-image">
            @endif
            @if(auth()->check() && (auth()->user()->id === $recipe['user_id'] || auth()->user()->usertype === 'admin'))
                <a href="{{ route('recipes.edit', $recipe['id']) }}" class="edit-btn">{{ __('messages.edit') }}</a>
                <form action="{{ route('recipes.destroy', $recipe['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">{{ __('messages.delete') }}</button>
                </form>
            @endif
        </div>
    @endforeach
</div>

<footer>
    <div class="calendar-container">
        @include('calendar')
        <p>{{ __('messages.footer_text') }}</p>
    </div>
</footer>

<button onclick="scrollToTop()" class="scroll-to-top-btn" id="scrollToTopBtn">&#8593;</button>

<script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            document.getElementById("scrollToTopBtn").style.display = "block";
        } else {
            document.getElementById("scrollToTopBtn").style.display = "none";
        }
    }

    function scrollToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>

</body>
</html>
