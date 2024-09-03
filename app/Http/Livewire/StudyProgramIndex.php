<?php

namespace App\Http\Livewire;

use App\Enum\RolesEnum;
use App\Models\StudyProgram;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class StudyProgramIndex extends Component
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
            'address' => 'required',
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
        $facultyId = null;
        if ($user->study_program_id != null) {
            $studyProgram = StudyProgram::find($user->study_program_id);
            $facultyId = $studyProgram->faculty_id;
        }
        if ($facultyId != null) {
            $data = StudyProgram::where('faculty_id', '=', $facultyId)->get();
        } else {
            $data = StudyProgram::all();
        }
        return view('livewire.study-program-index', ["studyPrograms" => $data]);
    }
}
