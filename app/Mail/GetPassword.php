<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GetPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $new_pass;
    public function __construct($user, $new_pass)
    {
        $this->user = $user;
        $this->new_pass = $new_pass;
    }
    public function build()
    {
        return $this->view('admin.mail.recover-password',[
            'title' => 'Khôi phục mật khẩu',
            'user' => $this->user,
            'new_pass' => $this->new_pass
        ]);
    }
}
