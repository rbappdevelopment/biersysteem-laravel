<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Bierstand;
use App\Models\Mutaties;

class CreateSheet implements FromCollection, WithTitle, WithHeadings
{
    private string $tableName;

    public function __construct(string $tableName)
    {
        $this->tableName = $tableName;
    }

    public function headings(): array{
        if($this->tableName == "Bierstand"){
        return [
            'id',
            'Naam',
            'Bierstand',
            'OnzichtbaarStand (wordt gebruikt voor de volgorde in de tabel)',
            'AangemaaktDatum',
            'UpdatedDatum' 
        ];
        } else if($this->tableName == "Mutaties"){
            return [
                'id',
                'NaamId',
                'AantalBier',
                'TotaalBierNaMutatie',
                'GemuteerdDoor',
                'AangemaaktDatum',
                'UpdatedDatum'
            ];        
        }
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->tableName == "Bierstand"){
            return Bierstand::all()->sortByDesc('TotaalOnzichtbaar');
        }else if($this->tableName == "Mutaties"){
            return Mutaties::all()->sortByDesc('created_at');
        }
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->tableName;
    }
}
