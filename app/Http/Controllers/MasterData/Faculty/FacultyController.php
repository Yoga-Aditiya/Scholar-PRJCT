<?php

namespace App\Http\Controllers\MasterData\Faculty;

use App\Http\Controllers\DashboardController;

class FacultyController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.master-data.faculty.index')->with(['user' => $this->getCurrentUser()]);
    }

}
