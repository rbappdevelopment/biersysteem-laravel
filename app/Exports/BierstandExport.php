<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Bierstand;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\CreateSheet;

class BierstandExport implements WithMultipleSheets
{

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];

        $sheets[0] = new CreateSheet($tableName = "Bierstand");
        $sheets[1] = new CreateSheet($tableName = "Mutaties");

        return $sheets;
    }
}