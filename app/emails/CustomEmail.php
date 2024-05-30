<?php
namespace App\emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomEmail extends Mailable
{
use Queueable, SerializesModels;

public function build()
{
return $this->view('emails.custom') // Представление письма
->subject('Важное уведомление') // Тема письма
->with([
'unsubscribe_link' => 'http://127.0.0.1/unsubscribe', // Ссылка для отписки
]);
}
}

