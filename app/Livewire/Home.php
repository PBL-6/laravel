<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('Home')]
    public function render()
    {
        $books = Book::latest()->take(4)->get();
        return view('livewire.home', compact('books'));
    }
}
