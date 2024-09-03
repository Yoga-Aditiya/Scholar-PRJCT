<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class FacultyAdmIndex extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $facultyId;
    public $dataId;

    public function SaveItem()
    {
        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'facultyId' => 'required',
        ]);
        if (!empty($this->dataId)){
            $this->ShowModal(false, 'edit');
        }
    }

    public function SetSelectedItem($item){
        $this->name = $item['name'];
        $this->email = $item['email'];
        $this->facultyId = $item['faculty_id'];
        $this->dataId = $item['id'];
        $this->ShowModal(true, 'edit');
    }

    public function SelectDeleteItem($item){
        $this->ShowModal(true, 'delete');
    }

    public function DeleteItem($item){
        $this->ShowModal(false, 'delete');
    }

    public function ShowModal($key, $type){
        switch ($type){
            case 'edit':
                if ($key){
                    $this->dispatchBrowserEvent('openEdit');
                } else {
                    $this->dispatchBrowserEvent('closeEdit');
                }
                break;
            case 'delete':
                if ($key){
                    $this->dispatchBrowserEvent('openDelete');
                } else {
                    $this->dispatchBrowserEvent('closeDelete');
                }
                break;
            default: break;
        }
    }

    public function render()
    {
        $user = Auth::user();
        $spAdmins = [];
        if ($user->hasRole(RolesEnum::SYS_ADMIN)){
            $spAdmins = User::whereHas("roles", function($q){ $q->where("name", RolesEnum::FACULTY_ADMIN); })->get();
        }
        return view('livewire.faculty-adm-index', ["data" => $spAdmins]);
    }
}
