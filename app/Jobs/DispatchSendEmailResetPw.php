<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DispatchSendEmailResetPw implements ShouldQueue
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
            Mail::send('MailView.MailResetPw', [
                'email' => $data['email'],
                'token_reset' => $data['token_reset']
            ], function ($message) use ($data) {
                $message->to($data['email']);
                $message->subject('Reset Password Pengguna');
            });    
        } catch (\Exception $e) {
            Log::error('Error sending reset password link' . $e->getMessage());
        }
    }
}
