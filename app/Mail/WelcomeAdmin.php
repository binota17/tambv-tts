<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->view('emails.welcome_admin')->with('admin', $this->admin);
    }
}
