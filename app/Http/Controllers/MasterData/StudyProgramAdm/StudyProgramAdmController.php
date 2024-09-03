<?php

namespace App\Http\Controllers\MasterData\StudyProgramAdm;

use App\Http\Controllers\DashboardController;
use function view;

class StudyProgramAdmController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.master-data.study-program-adm.index')->with(['user' => $this->getCurrentUser()]);
    }
}
