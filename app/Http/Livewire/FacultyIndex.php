<?php

namespace App\Http\Livewire;

use App\Models\Faculty;
use Livewire\Component;
use Livewire\WithPagination;

class FacultyIndex extends Component
{
    use WithPagination;

    public $name;
    public $address;
    public $dataId;

    public function SaveItem()
    {
        $validated = $this->validate([
            'name' => 'required',
            'address' => 'required',
        ]);
        if (!empty($this->dataId)){
            $this->ShowModal(false, 'edit');
        }
    }

    public function SetSelectedItem($item){
        $this->name = $item['name'];
        $this->address = $item['address'];
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
        $faculties = Faculty::all();
        return view('livewire.faculty-index', ["faculties" => $faculties]);
    }
}
