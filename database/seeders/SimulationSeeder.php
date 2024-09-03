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
        $faculty = Faculty::where(['code' => '02'])->first();
        $sp = StudyProgram::insert(
            [
                'name' => 'Pendidikan Teknik Informatika dan Komputer',
                'address' => '-',
                'faculty_id' => $faculty->id,
            ]
        );
        $lecturer = Lecturer::insert(
            [
                'front_title' => null,
                'full_name' => 'Yusfia Hafid Aristyagama',
                'back_title' => 'S.T., M.T.',
                'email' => 'yusfia.hafid@staff.uns.ac.id',
                'scholar_id' => 'gUqsw8AAAAAJ',
                'scopus_id' => null,
                'study_program_id' => 1,
            ]
        );

        $role_sysadmin = Role::create(['name' => RolesEnum::SYS_ADMIN]);
        $role_study_program_admin = Role::create(['name' => RolesEnum::STUDY_PROGRAM_ADMIN]);
        $role_faculty_admin = Role::create(['name' => RolesEnum::FACULTY_ADMIN]);
        $role_lecturer = Role::create(['name' => RolesEnum::LECTURER]);
        $role_guest = Role::create(['name' => RolesEnum::GUEST]);

        $user =  User::create([
            'name' => 'Yusfia H',
            'email' => 'yusfia.hafid@staff.uns.ac.id',
            'password' => bcrypt('123456'),
            'study_program_id' => 1,
        ]);
        $user->assignRole([$role_study_program_admin->id]);
    }
}
