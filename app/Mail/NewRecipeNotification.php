<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Recipe;

class NewRecipeNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $recipe;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Recipe $recipe, $user)
    {
        $this->recipe = $recipe;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new_recipe_notification')
            ->subject('Опубликован новый рецепт: ' . $this->recipe->title)
            ->with([
                'recipe' => $this->recipe,
                'user' => $this->user,
            ]);
    }
}
