<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaiForgot extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $tieu_de;
    public $ten_tai_khoan;
    public $hash;

    public function __construct($ten_tai_khoan, $hash, $tieu_de)
    {
        $this->ten_tai_khoan       = $ten_tai_khoan;
        $this->hash         = $hash;
        $this->tieu_de      = $tieu_de;
    }


    public function build()
    {
        return $this->subject($this->tieu_de)->view('mail.quen_mk',[
            'ten_tai_khoan' => $this->ten_tai_khoan,
            'hash'   => $this->hash,
        ]);
    }
}
