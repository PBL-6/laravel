<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class Book extends Component
{
    public $result_book = null;

    public function mount(string $image_name)
    {
        $image = str_replace('train_images/', '', $image_name);
        $book = \App\Models\Book::where('image', $image)->first();
        $this->result_book = $book;
    }

    #[Title('Detail Book')]
    public function render()
    {
        return view('livewire.book');
    }
}
