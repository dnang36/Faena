<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;


class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $products;
    protected $customer;
    protected $carts;
    public function __construct($carts, $customer, $products)
    {
        $this->customer = $customer;
        $this->carts = $carts;
        $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->customer->email)->send(new OrderShipped($this->carts, $this->customer, $this->products));
    }
}
/*
use Mail
gửi mail cần config trong file evn bằng mật khẩu ứng dụng,
make:job
make:mail
queu:table để tạo table jobs
*/
