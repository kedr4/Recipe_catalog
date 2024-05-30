<!DOCTYPE html>
<html>
<head>
    <title>Новый рецепт</title>
</head>
<body>
<p>Добрый вечер, {{ $user->name }}!</p>
<p>Опубликован новый рецепт: <strong>{{ $recipe->title }}</strong></p>
<p>{{ $recipe->description }}</p>
<p><a href="{{ url('/recipes/' . $recipe->id) }}">Посмотреть рецепт</a></p>
<p>Спасибо за использование нашего сайта!</p>
</body>
</html>
