<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SimulationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan Faculty dengan code '02' ada
        $faculty = Faculty::where('code', '02')->firstOrFail();

        // Buat Study Program
        $studyProgram = StudyProgram::create([
            'name' => 'Pendidikan Teknik Informatika dan Komputer',
            'address' => '-',
            'faculty_id' => $faculty->id,
        ]);

        // Buat User
        $user = User::create([
            'name' => 'Yusfia H',
            'email' => 'yusfia.hafid@staff.uns.ac.id',
            'password' => bcrypt('123456'),
        ]);

        // Assign Role ke User
        $role_study_program_admin = Role::firstOrCreate(['name' => RolesEnum::STUDY_PROGRAM_ADMIN]);
        $user->assignRole([$role_study_program_admin->id]);

        // Tambahkan Lecturer
        Lecturer::create([
            'user_id' => $user->id,
            'front_title' => null,
            'back_title' => 'S.T., M.T.',
            'scopus_id' => null,
            'scholar_id' => 'gUqsw8AAAAAJ',
        ]);

        // Tambahkan Roles Lainnya
        Role::firstOrCreate(['name' => RolesEnum::SYS_ADMIN]);
        Role::firstOrCreate(['name' => RolesEnum::FACULTY_ADMIN]);
        Role::firstOrCreate(['name' => RolesEnum::LECTURER]);
        Role::firstOrCreate(['name' => RolesEnum::GUEST]);
    }
}
