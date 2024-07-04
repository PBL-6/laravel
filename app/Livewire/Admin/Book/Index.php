<?php

namespace App\Livewire\Admin\Book;

use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Title('Book Index')]
    public function render()
    {
        $books = Book::latest()->paginate(12);
        return view('livewire.admin.book.index', compact('books'));
    }
}
