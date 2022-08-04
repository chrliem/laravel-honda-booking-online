<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $nama;

    public function __construct($data, $nama)
    {
        $this->data = $data;
        $this-> nama = $nama;
    }

    public function build()
    {
        return $this->subject($this->data['kode_dealer'] .' Online Booking Service')->view('notificationEmailNew')->with('data', $this->data)->with('nama', $this->nama);
    }
}
