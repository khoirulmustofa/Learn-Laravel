<?php

namespace App\Livewire;

use App\Models\Todo as ModelsTodo;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Todo extends Component
{
    use WithPagination;
    public $search;

    // validation
    #[Rule('required|min:3|max:50')]
    public $name;

    function create()
    {
        try {
            // dd('hallo');
            // First Step
            $validated = $this->validateOnly('name');
            // dd($validated);

            // Second Step
            ModelsTodo::create($validated);
            // Todo::create(['name' => $this->name]);


            // Third Step
            $this->reset('name');

            // Forth Step
            session()->flash('success', 'Successfully Created !');

            $this->reset('name');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            return;
        }
    }

    public function toggle($id)
    {
        try {
            $todo = ModelsTodo::find($id);
            $todo->completed = !$todo->completed;
            $todo->save();
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to Toggle Todo !');
            return;
        }
    }

    #[Title('Todos')]
    public function render()
    {
        return view('livewire.todo.todo', [
            'todos' => ModelsTodo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5),
        ]);
    }
}
