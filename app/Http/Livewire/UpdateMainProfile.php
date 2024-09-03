<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateMainProfile extends Component
{
    protected $user;

    public $id;
    public $name;
    public $email;
    public $password;
    public $repassword;

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
    }

    public function save()
    {
        $this->validate();
        $this->user = User::find(Auth::id());
        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $str = $this->password;
        if (!empty($str) || null!=$str || ''!=$str) {
            $this->user->password = Hash::make($str);
        }
        if ($this->user->save()) {
            $this->dispatchBrowserEvent('openModal');
        }
        $this->name = $this->user->name;
        $this->email = $this->user->email;
    }

    public function render()
    {
        return view('livewire.update-main-profile');
    }
}
