<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data fakultas yang akan dimasukkan
        $faculties = [
            [
                'code' => '01',
                'name' => 'Fakultas Ilmu Pendidikan',
                'address' => 'Jl. Pendidikan No. 1',
            ],
            [
                'code' => '02',
                'name' => 'Fakultas Teknik',
                'address' => 'Jl. Teknik No. 2',
            ],
            [
                'code' => '03',
                'name' => 'Fakultas Ekonomi',
                'address' => 'Jl. Ekonomi No. 3',
            ],
        ];

        // Iterasi dan tambahkan data jika belum ada
        foreach ($faculties as $faculty) {
            Faculty::firstOrCreate(
                ['code' => $faculty['code']], // Periksa berdasarkan kode unik
                [
                    'name' => $faculty['name'],
                    'address' => $faculty['address'],
                ]
            );
        }
    }
}
