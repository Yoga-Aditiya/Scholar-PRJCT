<?php

namespace App\Http\Controllers\MasterData\StudyProgram;

class StudyProgramProfileController
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($id, $start, $end)
    {
        $filter = [
            'sp_id' => $id,
            'start' => $start,
            'end' => $end
        ];
        return view('admin.master-data.study-program.profile')->with(['user' => $this->getCurrentUser(), 'mydata' => $filter]);
    }
}
