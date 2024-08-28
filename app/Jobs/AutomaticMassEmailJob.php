<?php

namespace App\Jobs;

use App\Mail\AutomaticMassEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Mail;

class AutomaticMassEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    private $subject, $contentView, $data;
    private $user;
    public $tries = 3;
    public function __construct($user, $subject, $contentView, mixed $data)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->contentView = $contentView;
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to(new Address($this->user["email"],$this->user["full_name"]))->send(new AutomaticMassEmail( $this->subject,$this->contentView,$this->data));
    }

}



