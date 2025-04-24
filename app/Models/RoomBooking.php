<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBooking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id', 'jml_peserta', 'start_time', 'end_time', 'status', 'reason', 'catatan'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
