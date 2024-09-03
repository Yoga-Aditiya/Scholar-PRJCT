<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Http\Service\ScholarService;
use App\Models\FullCitationCount;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use App\Models\Year;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SystemSettingFacultyAdminIndex extends Component
{
    private $scholarService;
    public $startYear;
    public $endYear;

    public function boot(ScholarService  $scholarService)
    {
        $this->endYear = date('Y');
        $this->startYear = $this->endYear-3;
        $this->scholarService = $scholarService;
    }

    public function createDataBatch()
    {
        $facultyId = Auth::user()->facultyAdmin->faculty_id;
        $studyPrograms = StudyProgram::where("faculty_id","=", $facultyId)->get();
        $lectures = [];
        foreach ($studyPrograms as $studyProgram){
            $datas = User::whereHas("roles", function($q){ $q->where("name", RolesEnum::LECTURER); })->where("study_program_id", $studyProgram->id)->get();
            foreach ($datas as $datum){
                $lectures[] = $datum->lecturer;
            }
        }
        foreach ($lectures as $lecturer) {
            $scholarInfo = $this->scholarService->getInfo($lecturer->scholar_id);
            foreach ($scholarInfo[0] as $info) {
                if ($info["year"] >= $this->startYear and $info["year"] <= $this->endYear) {
                    FullCitationCount::updateOrCreate([
                        "lecturer_id" => $lecturer->id,
                        "year" => $info["year"],
                    ],
                        [
                            "lecturer_id" => $lecturer->id,
                            "year" => $info["year"],
                            "num_of_citation" => $info["num_of_citation"]
                        ]);
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.system-setting-faculty-admin-index');
    }
}
