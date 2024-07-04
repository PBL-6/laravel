<?php

namespace App\Livewire\Book;

use App\Models\SearchBook;
use Livewire\Attributes\Title;
use Livewire\Component;

class Result extends Component
{
    public $result_book;

    public function mount(int $id)
    {
        $this->result_book = SearchBook::find($id);
    }

    #[Title('Search Result')]
    public function render()
    {
        return view('livewire.book.result');
    }
}
