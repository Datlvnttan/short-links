<?php

namespace App\Jobs;

use App\Mail\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;

class SendVerifyEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
        // $this->queue = "SendVerificaEmail";
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {        
        Log::info("vào");
        Mail::send(new VerifyEmail($this->user["id"],$this->user["email"],$this->user["full_name"],$this->user["token"]));        
    }
}
