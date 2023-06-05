<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable 
{
    use Queueable, SerializesModels;
    private $user;
    private $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $msg)
    {
        //
        $this->user = $user;
        $this->msg = $msg;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nova notificação de MCSCR');
        $this->to($this->user->email,$this->user->name);
        // return $this->view('mail.notification',[
        //     'user'=>$this->user
        // ]);

          return $this->markdown('mail.notification',[
             'user'=>$this->user,
             'msg'=>$this->msg,

         ]);
    }
}
