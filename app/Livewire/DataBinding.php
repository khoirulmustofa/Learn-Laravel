<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class DataBinding extends Component
{
   

    
    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
        ]);

        

        session()->flash('message', 'User updated successfully.');
    }

    public function render()
    {
        $users = User::get();
        return view('livewire.data-binding',[
            'users' => $users
        ]);
    }
}
