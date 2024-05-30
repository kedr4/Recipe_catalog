<!DOCTYPE html>
<html>
<head>
    <title>Пользовательское письмо</title>
</head>
<body>
<h1>Здорова, мужик!!!</h1>
<p>Мы хотели бы поделиться с вами важной информацией:</p>
<p>Текст важного уведомления...</p>
<p>Если вы больше не хотите получать подобные уведомления, вы можете<form method="POST" action="{{ url('/unsubscribe') }}">
    @csrf
    <button type="submit">Отписаться от рассылки</button>
</form>
</p>
</body>
</html>
