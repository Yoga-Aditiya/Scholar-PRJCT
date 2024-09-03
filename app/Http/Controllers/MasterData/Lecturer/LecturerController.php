<?php

namespace App\Http\Controllers\MasterData\Lecturer;

use App\Http\Controllers\DashboardController;

class LecturerController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.master-data.lecturer.index')->with(['user' => $this->getCurrentUser()]);
    }
}
