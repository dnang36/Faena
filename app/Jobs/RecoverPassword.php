<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\GetPassword;

class RecoverPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $new_pass;
    public function __construct($user, $new_pass)
    {
        $this->user = $user;
        $this->new_pass = $new_pass;
    }
    public function handle()
    {
        Mail::to($this->user->email)->send(new GetPassword($this->user, $this->new_pass));
    }
}
