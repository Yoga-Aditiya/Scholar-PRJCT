<?php

namespace App\Http\Livewire;

use App\Http\Service\ScholarService;
use App\Models\FullCitationCount;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SystemSettingPSAdminIndex extends Component
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
        $lectures = Lecturer::whereHas('userIdentity', function($q) {
            $q->where('study_program_id', Auth::user()->study_program_id);
        })->get();
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
        return view('livewire.system-setting-p-s-admin-index');
    }
}
