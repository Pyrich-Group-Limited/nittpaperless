<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ImportChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filePath = storage_path('app/chartOfAccounts.xlsx');

        if (!file_exists($filePath)) {
            $this->command->error("File not found: $filePath");
            return;
        }

        // Load the Excel file
        $data = Excel::toArray([], $filePath);

        // Get the first sheet's data
        $rows = $data[0];

        $accounts = [];
        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            $accounts[] = [
                'code' => $row[0],
                'name' => $row[1],
                'type' => $row[2],
            ];
        }

        DB::table('chart_of_accounts')->insert($accounts);
    }
}
