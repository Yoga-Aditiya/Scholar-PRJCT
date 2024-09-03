<?php

namespace App\Http\Controllers\MasterData\FacultyAdm;

use App\Http\Controllers\DashboardController;

class FacultyAdmController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.master-data.faculty-adm.index')->with(['user' => $this->getCurrentUser()]);
    }
}
