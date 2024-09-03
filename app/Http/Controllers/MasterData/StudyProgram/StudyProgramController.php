<?php

namespace App\Http\Controllers\MasterData\StudyProgram;

use App\Http\Controllers\DashboardController;

class StudyProgramController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.master-data.study-program.index')->with(['user' => $this->getCurrentUser()]);
    }
}
