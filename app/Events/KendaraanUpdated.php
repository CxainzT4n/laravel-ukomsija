<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KendaraanUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $jumlah_masuk;

    public function __construct($id, $jumlah_masuk)
    {
        $this->id = $id;
        $this->jumlah_masuk = $jumlah_masuk;
    }
}
