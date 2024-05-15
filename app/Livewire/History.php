<?php

namespace App\Livewire;

use App\Models\SearchBook;
use Livewire\Attributes\Title;
use Livewire\Component;

class History extends Component
{
    #[Title('Search Book History')]
    public function render()
    {
        $search_history = SearchBook::latest()->paginate(10);
        return view('livewire.history', compact('search_history'));
    }
}
