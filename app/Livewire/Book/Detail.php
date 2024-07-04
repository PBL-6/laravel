<?php

namespace App\Livewire\Book;

use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\Component;

class Detail extends Component
{
    public $book;

    public function mount($image_name)
    {
        $image = str_replace('train_images/', '', $image_name);
        $this->book = Book::where('image', $image)->firstOrFail();
    }

    #[Title('Detail Book')]
    public function render()
    {
        return view('livewire.book.detail');
    }
}
