<?php

namespace App\Http\Livewire;

use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateMainProfileLecturer extends Component
{
    protected $user;
    protected $lecturer;

    public $id;
    public $name;
    public $email;
    public $password;
    public $repassword;
    public $front_title;
    public $back_title;
    public $scopus_id;
    public $scholar_id;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'password' => 'sometimes|nullable|min:6',
        'repassword' => 'same:password',
    ];

    public function __construct()
    {
        $user = Auth::user();
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $lecturer = Lecturer::where('user_id', $user->id)->first();
        $this->scopus_id = $lecturer->scopus_id;
        $this->scholar_id = $lecturer->scholar_id;
        $this->front_title = $lecturer->front_title;
        $this->back_title = $lecturer->back_title;
    }

    public function save()
    {
        $this->validate();
        $this->user = User::find(Auth::id());
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $str = $this->password;
        if (!empty($str) || null != $str || '' != $str) {
            $this->user->password = Hash::make($str);
        }
        $this->lecturer = Lecturer::where('user_id', $this->user->id)->first();
        $this->lecturer->scopus_id = $this->scopus_id;
        $this->lecturer->scholar_id = $this->scholar_id;
        $this->lecturer->front_title = $this->front_title;
        $this->lecturer->back_title = $this->back_title;
        if ($this->user->save()) {
            if ($this->lecturer->save()) {
                $this->dispatchBrowserEvent('openModal');
            }
        }
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.update-main-profile-lecturer');
    }
}
