<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;
            \Log::info("User type: " . $usertype);

            if ($usertype === 'user') {
                return view('dashboard');
            } elseif ($usertype === 'admin') {
                return view('admin.adminhome');
            } else {
                return redirect()->back();
            }
        }
    }

    // Метод для отображения формы
    public function showSendMessageForm()
    {
        return view('admin.send_message');
    }

    // Метод для обработки отправки сообщения
    public function sendMessage(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $subject = $request->input('subject');
        $messageText = $request->input('message');

        $users = User::all();

        foreach ($users as $user) {
            Mail::raw($messageText, function ($message) use ($user, $subject) {
                $message->to($user->email)
                    ->subject($subject); // Используем переданный заголовок сообщения
            });
        }

        return redirect()->route('admin.sendMessageForm')->with('success', 'Сообщение успешно отправлено всем пользователям!');
    }



}
