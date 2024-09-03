<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Models\Faculty;
use App\Models\FullCitationCount;
use App\Models\Lecturer;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DashCitationPerFaculty extends Component
{
    public $startYear;
    public $endYear;

    public function __construct()
    {
        $this->endYear = date("Y");
        $this->startYear = $this->endYear - 3;
    }

    public function render()
    {
        $result = $this->getCitationYearly($this->startYear, $this->endYear);
        //statistic
        $years = [];
        $citations = [];
        $totalCitation = 0;
        //---------
        for($i = $this->startYear; $i<=$this->endYear; $i++){
            $years[$i-$this->startYear] = $i;
        }
        foreach ($result as $item){
            $citations[] = $item;
            $totalCitation = $totalCitation + $item;
        }
        $this->dispatchBrowserEvent('contentChanged');
        return view('livewire.dash-citation-per-faculty')
            ->with('years', $years)
            ->with('citations', $citations)
            ->with('totalCitation', $totalCitation);
    }

    public function getCitationYearly($minYear = 2019, $maxYear = 2024)
    {
        $result = [];
        //create array from min to max
        for ($i = $minYear; $i <= $maxYear; $i++) {
            $result[$i] = 0;
        }
        $facultyId = Auth::user()->facultyAdmin->faculty_id;
        $studyPrograms = StudyProgram::where("faculty_id", "=", $facultyId)->get();
        foreach ($studyPrograms as $studyProgram) {
            $lecturers = User::whereHas("roles", function ($q) {
                $q->where("name", RolesEnum::LECTURER);
            })->where("study_program_id", $studyProgram->id)->get();
            foreach ($lecturers as $userLecturer) {
                $lecturer_id = $userLecturer->lecturer->id;
                $citations = FullCitationCount::where('lecturer_id', '=', $lecturer_id)->get();
                foreach ($citations as $citation) {
                    if (isset($result[$citation->year])) {
                        $result[$citation->year] = $result[$citation->year] + $citation->num_of_citation;
                    }
                }
            }
        }
        return $result;
    }
}
