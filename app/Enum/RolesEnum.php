<?php

namespace App\Enum;

abstract class RolesEnum
{
    const SYS_ADMIN = 'Super Admin';
    const STUDY_PROGRAM_ADMIN = 'Admin Program Studi';
    const FACULTY_ADMIN = 'Admin Fakultas';
    const LECTURER = 'Dosen';
    const GUEST = 'Tamu';

    public static function isValid($value){
        foreach (RolesEnum::getStatusOptions() as $role){
            if ($role==$value){
                return true;
            }
        }
        return false;
    }

    public static function isValidAndNotAdmin($value){
        foreach (RolesEnum::getStatusOptionsWOAdmin() as $role){
            if ($role==$value){
                return true;
            }
        }
        return false;
    }

    public static function getStatusOptions()
    {
        return [
            self::SYS_ADMIN,
            self::STUDY_PROGRAM_ADMIN,
            self::LECTURER,
            self::GUEST,
        ];
    }

    public static function getStatusOptionsWOAdmin()
    {
        return [
            self::STUDY_PROGRAM_ADMIN,
            self::LECTURER,
            self::GUEST,
        ];
    }
}
