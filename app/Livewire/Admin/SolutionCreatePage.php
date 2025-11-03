<?php

namespace App\Livewire\Admin;

use App\Models\Solutions;
use Livewire\Component;

class SolutionCreatePage extends Component
{
    public $nama, $description, $content, $icon, $image_content;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'icon' => 'nullable|string|max:100',
        'image_content' => 'nullable|string|max:255',
    ];

    public function store()
    {
        $this->validate();

        Solutions::create([
            'nama' => $this->nama,
            'description' => $this->description,
            'content' => $this->content,
            'icon' => $this->icon,
            'image_content' => $this->image_content,
        ]);

        session()->flash('message', 'Solution created successfully.');
        return redirect()->route('admin.solutions');
    }

    public function render()
    {
        return view('livewire.admin.solution-create-page');
    }
}
