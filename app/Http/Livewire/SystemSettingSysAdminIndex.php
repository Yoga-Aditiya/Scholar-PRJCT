<?php

namespace App\Http\Livewire;

use App\Http\Service\ScholarService;
use App\Models\FullCitationCount;
use App\Models\Lecturer;
use App\Models\Year;
use Livewire\Component;

class SystemSettingSysAdminIndex extends Component
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
        $lectures = Lecturer::all();
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
        return view('livewire.system-setting-sys-admin-index');
    }
}
