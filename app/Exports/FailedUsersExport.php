<?php

namespace App\Exports;

use App\Models\User;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FailedUsersExport implements FromArray, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $failedUploads;

    public function __construct($failedUploads)
    {
        $this->failedUploads = $failedUploads;
    }

    public function array(): array
    {
        return $this->failedUploads;
    }

    public function headings(): array
    {
        return ["DESIGNATION", "SURNAME", "OTHERNAMES", "EMAIL", "USER TYPE", "ZONE", "DEPARTMENT", "UNIT", "COMMENT"];
    }
}
