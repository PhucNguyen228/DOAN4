<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailKichHoat extends Mailable
{
    use Queueable, SerializesModels;

    public $ten_tai_khoan;
    public $hash;
    public $tieu_de;

    public function __construct($ten_tai_khoan, $hash, $tieu_de)
    {
        $this->ten_tai_khoan       = $ten_tai_khoan;
        $this->hash         = $hash;
        $this->tieu_de      = $tieu_de;
    }


    public function build()
    {
        return $this->subject($this->tieu_de)->view('mail.kich_hoat', [
            'ten_tai_khoan' => $this->ten_tai_khoan,
            'hash'   => $this->hash,
        ]);
    }
}
