<?php

namespace App\Exports;

use App\Models\RoomBooking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomBookingsExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;
    protected $status;

    public function __construct($startDate = null, $endDate = null, $status = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->status = $status;
    }

    public function collection()
    {
        $query = RoomBooking::with(['user', 'room'])->orderBy('start_time', 'desc');

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('start_time', [$this->startDate, $this->endDate]);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->get()->map(function ($booking) {
            return [
                'Nama User' => $booking->user->name,
                'Nama Ruangan' => $booking->room->name,
                'Jumlah Peserta' => $booking->jml_peserta,
                'Waktu Mulai' => $booking->start_time,
                'Waktu Selesai' => $booking->end_time,
                'Status' => $booking->status,
                'Acara/Kegiatan' => $booking->reason,
                'Catatan' => $booking->catatan,    
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama User', 'Nama Ruangan', 'Jumlah Peserta', 'Waktu Mulai', 'Waktu Selesai', 'Status', 'Acara Kegiatan', 'Catatan'];
    }
}

