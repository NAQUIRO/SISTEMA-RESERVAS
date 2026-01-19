<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            [
                'number' => 'T1',
                'capacity' => 2,
                'location' => 'Interior',
                'is_active' => true
            ],
            [
                'number' => 'T2',
                'capacity' => 4,
                'location' => 'Interior',
                'is_active' => true
            ],
            [
                'number' => 'T3',
                'capacity' => 6,
                'location' => 'Interior',
                'is_active' => true
            ],
            [
                'number' => 'T4',
                'capacity' => 4,
                'location' => 'Terraza',
                'is_active' => true
            ],
            [
                'number' => 'T5',
                'capacity' => 8,
                'location' => 'Terraza',
                'is_active' => true
            ],
        ];

        foreach ($tables as $table) {
            Table::create($table);
        }
    }
}
