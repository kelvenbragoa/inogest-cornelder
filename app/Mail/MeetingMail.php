<?php

namespace App\Mail;

use App\Models\MeetingParticipant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingMail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    private $msg;
    private $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(MeetingParticipant $user, $msg, $pdf)
    {
        //
        $this->user = $user;
        $this->msg = $msg;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Nova notificação de Acta da Reunião');
        $this->to($this->user->email,$this->user->name);

        return $this->markdown('mail.meeting',[
            'user'=>$this->user,
            'msg'=>$this->msg,

        ])->attachData($this->pdf->output(), 'acta_reuniao.pdf');;

        // ->attach(public_path('meeting/sample.pdf'), [
        //     'as' => 'acta-da-reuniao.pdf',
        //     'mime' => 'application/pdf',
        // ])
    }
}
