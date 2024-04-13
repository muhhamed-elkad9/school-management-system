<?php

namespace App\Notifications;

use App\Models\Quizze;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddExam extends Notification
{
    use Queueable;

    private $quizzes_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Quizze $quizzes_id)
    {
        $this->quizzes_id = $quizzes_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            // 'data' => $this->details['body']
            'id' => $this->quizzes_id->id,
            'title' => 'تم اضافة امتحان جديد بواسطة :',
            'user' => auth('teacher')->check() ? Auth::user()->Name : Auth::user()->name,
        ];
    }
}
