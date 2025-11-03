<?php

namespace App\Livewire\User;

use App\Models\Teams;
use App\Models\AboutUs;
use App\Models\Clients;
use App\Models\Contact;
use App\Models\Project;
use Livewire\Component;
use App\Models\Carousel;
use App\Models\Solutions;
use App\Models\Testimonys;
use Livewire\Attributes\Layout;


#[Layout('User.layouts.app', ['title' => 'Home'])]

class HomePage extends Component
{
    public $solutions, $clients, $testimonys, $teams, $contact, $carousels, $about, $projects;

    public function mount()
    {
        $this->carousels = Carousel::orderBy('judul', 'asc')->get();
        $this->about = AboutUs::with('features')->first();
        $this->solutions = Solutions::orderBy('nama', 'asc')->get();
        $this->clients = Clients::orderBy('nama', 'asc')->get();
        $this->testimonys = Testimonys::orderBy('nama', 'asc')->get();
        $this->projects = Project::orderBy('nama_projek', 'asc')->get();
        $this->teams = Teams::orderBy('level', 'asc')->get();
        $this->contact = Contact::first();
    }

    public function render()
    {
        return view('User.home');
    }
}
