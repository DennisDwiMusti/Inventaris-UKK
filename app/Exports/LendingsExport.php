<?php

namespace App\Exports;

use App\Models\Lending;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class LendingsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Lending::with('item')->get();
    }

    public function headings(): array
    {
        return [
            'Item',
            'Total',
            'Name',
            'Ket.',
            'Date',
            'Return Date',
            'Edited By'
        ];
    }

    public function map($lending): array
    {
        return [
            $lending->item->name ?? '-',
            $lending->total_items,
            $lending->name,
            $lending->keterangan,
            Carbon::parse($lending->date)->format('M d, Y'),

            $lending->return_date ? Carbon::parse($lending->return_date)->format('M d, Y') : '-',

            $lending->user->name ?? 'operator wikrama'
        ];
    }
}
