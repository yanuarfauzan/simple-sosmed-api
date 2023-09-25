<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class DispatchSendEmailVerif implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $data = $this->data;
            Mail::send('MailView.MailVerif', [
                'email' => $data['email'],
                'token_verify' => $data['token_verify']
            ], function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject('Email Verifikasi');
            });
        } catch (\Exception $e) {
            Log::error('Error sending verification email: ' . $e->getMessage());
        }
    }
}
