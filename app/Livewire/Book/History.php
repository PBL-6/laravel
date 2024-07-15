<?php

namespace App\Livewire\Book;

use App\Models\SearchBook;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;
    #[Title('Search Book History')]

    public function render()
    {
        $search_history = SearchBook::latest()->paginate(5);
        return view('livewire.book.history', compact('search_history'));
    }
}
