<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Метод для отображения формы регистрации
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Метод для обработки запроса на регистрацию
    public function register(Request $request)
    {
        // Валидация данных из формы регистрации
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        // Создание нового пользователя
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Вход пользователя после успешной регистрации
        Auth::login($user);

        // Перенаправление на главную страницу или другую страницу при необходимости
        return redirect('/main');
    }
}
