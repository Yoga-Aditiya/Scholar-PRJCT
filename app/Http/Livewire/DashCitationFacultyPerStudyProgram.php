<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Models\FullCitationCount;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashCitationFacultyPerStudyProgram extends Component
{
    public $minYear;
    public $maxYear;

    public function __construct($id = null)
    {
        $this->maxYear = date("Y");
        $this->minYear = $this->maxYear - 3;
    }

    public function render()
    {
        $result = $this->getCitationYearly($this->minYear, $this->maxYear);
        //---------
        return view('livewire.dash-citation-faculty-per-study-program')
            ->with('info', $result)
            ->with('minYear', $this->minYear)
            ->with('maxYear', $this->maxYear);
    }

    public function getCitationYearly($minYear = 2019, $maxYear = 2024)
    {
        $facultyId = Auth::user()->facultyAdmin->faculty_id;
        $studyPrograms = StudyProgram::where("faculty_id", "=", $facultyId)->get();
        $result = [];
        foreach ($studyPrograms as $studyProgram) {
            $lecturers = User::whereHas("roles", function ($q) {
                $q->where("name", RolesEnum::LECTURER);
            })->where("study_program_id", $studyProgram->id)->get();
            $totalCitation = 0;
            $tempCitation = [];
            //create array from min to max
            for ($i = $minYear; $i <= $maxYear; $i++) {
                $tempCitation[$i] = 0;
            }
            foreach ($lecturers as $userLecturer) {
                $lecturer_id = $userLecturer->lecturer->id;
                $citations = FullCitationCount::where('lecturer_id', '=', $lecturer_id)->get();
                foreach ($citations as $citation) {
                    if (isset($tempCitation[$citation->year])) {
                        $tempCitation[$citation->year] = $tempCitation[$citation->year] + $citation->num_of_citation;
                        $totalCitation = $totalCitation + $citation->num_of_citation;
                    }
                }
            }
            $result[] = [
                'info' => $studyProgram,
                'citation' => $tempCitation,
                'totalCitation' => $totalCitation
            ];
        }
        return $result;
    }
}
