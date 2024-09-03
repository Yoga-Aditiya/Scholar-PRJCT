<?php

namespace Database\Seeders;

use App\Enum\RolesEnum;
use App\Models\Faculty;
use App\Models\FacultyAdmin;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_sysadmin = Role::create(['name' => RolesEnum::SYS_ADMIN]);
        $role_study_program_admin = Role::create(['name' => RolesEnum::STUDY_PROGRAM_ADMIN]);
        $role_faculty_admin = Role::create(['name' => RolesEnum::FACULTY_ADMIN]);
        $role_lecturer = Role::create(['name' => RolesEnum::LECTURER]);
        $role_guest = Role::create(['name' => RolesEnum::GUEST]);

        $sysadmn =  User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.uns.ac.id',
            'password' => bcrypt('123456'),
        ]);
        $sysadmn->assignRole([$role_sysadmin->id]);

        $facultya = Faculty::create([
            'name' => 'Fakultas Keguruan dan Ilmu Pendidikan',
            'address' => '-',
            'code' => '02',
        ]);
        $faculty = Faculty::where(['code' => '02'])->first();

        $sp = StudyProgram::create(
            [
                'name' => 'Pendidikan Teknik Informatika dan Komputer',
                'address' => '-',
                'faculty_id' => $faculty->id,
            ]
        );

        $usera =  User::create([
            'name' => 'Yusfia Hafid Aristyagama',
            'email' => 'yusfia.hafidz@gmail.com',
            'password' => bcrypt('123456'),
            'study_program_id' => $sp->id,
        ]);
        $lecturera = Lecturer::create(
            [
                'user_id' => $usera->id,
                'front_title' => null,
                'back_title' => 'S.T., M.T.',
                'scholar_id' => 'gUqsw8AAAAAJ',
                'scopus_id' => null,
            ]
        );
        $usera->assignRole([$role_lecturer->id]);

        $userb =  User::create([
            'name' => 'Nurcahya Pradana Taufik Prakisya',
            'email' => 'nurcahya.ptp@staff.uns.ac.id',
            'password' => bcrypt('123456'),
            'study_program_id' => $sp->id,
        ]);
        $lecturerb = Lecturer::create(
            [
                'user_id' => $userb->id,
                'front_title' => null,
                'back_title' => 'S.Kom., M.Cs.',
                'scholar_id' => 'tbvgsWYAAAAJ',
                'scopus_id' => null,
            ]
        );
        $userb->assignRole([$role_lecturer->id]);

        $user =  User::create([
            'name' => 'Yusfia H',
            'email' => 'yusfia.hafid@staff.uns.ac.id',
            'password' => bcrypt('123456'),
            'study_program_id' => $sp->id,
        ]);
        $user->assignRole([$role_study_program_admin->id]);

        $userfac =  User::create([
            'name' => 'Yusfia HA',
            'email' => 'yusfia@mail.uns.ac.id',
            'password' => bcrypt('123456'),
            'study_program_id' => $sp->id,
        ]);

        $fca = FacultyAdmin::create([
            'admin_id' => $userfac->id,
            'faculty_id' => $facultya->id
        ]);
        $userfac->assignRole([$role_faculty_admin->id]);

        //

        $sp1 = StudyProgram::create(
            [
                'name' => 'Pendidikan Matematika',
                'address' => '-',
                'faculty_id' => $faculty->id,
            ]
        );
        $userc =  User::create([
            'name' => '	Getut Pramesti',
            'email' => 'getutpramesti@staff.uns.ac.id',
            'password' => bcrypt('123456'),
            'study_program_id' => $sp1->id,
        ]);
        $lecturerc = Lecturer::create(
            [
                'user_id' => $userc->id,
                'front_title' => null,
                'back_title' => 'S.Si., M.Si., Ph.D.',
                'scholar_id' => 'LNrdLUQAAAAJ',
                'scopus_id' => '57189001806',
            ]
        );
        $userc->assignRole([$role_lecturer->id]);
    }
}
