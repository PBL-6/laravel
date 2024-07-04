<?php

namespace App\Livewire\Book;

use App\Models\SearchBook;
use Livewire\Attributes\Title;
use Livewire\Component;

class History extends Component
{
    #[Title('Search Book History')]

    public function render()
    {
        $search_history = SearchBook::latest()->paginate(10);
        return view('livewire.book.history', compact('search_history'));
    }
}
