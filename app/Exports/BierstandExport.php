<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Bierstand;

class BierstandExport implements FromCollection, WithHeadings
{
    public function headings(): array{
        return [
            'id',
            'Naam',
            'Bierstand',
            'OnzichtbaarStand (wordt gebruikt voor de volgorde in de tabel)',
            'AangemaaktDatum',
            'UpdatedDatum' 
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Bierstand::all();
    }
}
