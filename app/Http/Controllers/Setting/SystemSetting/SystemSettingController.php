<?php

namespace App\Http\Controllers\Setting\SystemSetting;

use App\Http\Controllers\DashboardController;

class SystemSettingController extends DashboardController
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.setting.system-setting.index')->with(['user' => $this->getCurrentUser()]);
    }
}
