<?php

namespace App\Livewire\Admin;

use App\Models\Solutions;
use Livewire\Component;
use Livewire\WithPagination;

class SolutionsPage extends Component
{
    use WithPagination;

    public $search = '';
    public $nama, $description, $content, $icon, $image_content, $solutionId;
    public $isModalOpen = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'content' => 'nullable|string',
        'icon' => 'nullable|string|max:100',
        'image_content' => 'nullable|string|max:255',
    ];

    public function render()
    {
        $solutions = Solutions::where('nama', 'like', "%{$this->search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.solutions-page', [
            'solutions' => $solutions
        ]);
    }

    public function openModal($id = null)
    {
        $this->resetInputFields();
        if ($id) {
            $solution = Solutions::findOrFail($id);
            $this->solutionId = $solution->id;
            $this->nama = $solution->nama;
            $this->description = $solution->description;
            $this->content = $solution->content;
            $this->icon = $solution->icon;
            $this->image_content = $solution->image_content;
        }
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->description = '';
        $this->content = '';
        $this->icon = '';
        $this->image_content = '';
        $this->solutionId = null;
    }

    public function store()
    {
        $this->validate();

        Solutions::updateOrCreate(
            ['id' => $this->solutionId],
            [
                'nama' => $this->nama,
                'description' => $this->description,
                'content' => $this->content,
                'icon' => $this->icon,
                'image_content' => $this->image_content,
            ]
        );

        session()->flash('message', $this->solutionId ? 'Solution updated successfully.' : 'Solution created successfully.');

        $this->closeModal();
    }

    public function delete($id)
    {
        Solutions::find($id)->delete();
        session()->flash('message', 'Solution deleted successfully.');
    }
}
