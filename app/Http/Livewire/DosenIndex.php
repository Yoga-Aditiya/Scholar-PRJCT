<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DosenIndex extends Component
{
    use WithPagination;

    public $name;
    public $address;
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
        $this->address = $item['address'];
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
        if ($user->hasRole(RolesEnum::FACULTY_ADMIN) || $user->hasRole(RolesEnum::SYS_ADMIN)){
            $data = User::whereHas("roles", function($q){ $q->where("name", RolesEnum::LECTURER); })->get();
        } else if ($user->hasRole(RolesEnum::STUDY_PROGRAM_ADMIN)) {
            $data = User::whereHas("roles", function($q){ $q->where("name", RolesEnum::LECTURER); })->where("study_program_id", $user->study_program_id)->get();
        } else if ($user->hasRole(RolesEnum::LECTURER)) {
            $data = User::where("id","=",$user->id);
        } else {
            $data =[];
        }
        return view('livewire.dosen-index', ['dosens' => $data]);
    }
}
