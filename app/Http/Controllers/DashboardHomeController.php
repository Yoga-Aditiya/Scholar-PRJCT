<?php

namespace App\Http\Controllers;

class DashboardHomeController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.dashboard-sneat', ["user" => $this->getCurrentUser()]);
    }
}
