<?php

namespace Database\Seeders;

use App\Models\ListApp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListApp::truncate();
        $csv = fopen(database_path('datasets/list_app.csv'), 'r');
        $firstline = true;
        while (($data = fgetcsv($csv, 2000, ',')) !== false) {
            if (!$firstline) {
                ListApp::create([
                    'nama' => $data[0],
                    'link' => $data[1],
                    'akses' => $data[2],
                    'deskripsi' => $data[3],
                    'pengguna' => $data[4],
                    'pembuat' => $data[5],
                    'logo' => $data[6],
                    'hits' => $data[7],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $firstline = false;
        }
        fclose($csv);
    }
}
