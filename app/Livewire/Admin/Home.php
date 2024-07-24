<?php

namespace App\Livewire\Admin;

use App\Models\Book;
use App\Models\SearchBook;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Title('Dashboard')]
    #[Layout('components.layouts.app2')]
    public function render()
    {
        $total_book = Book::count();
        $total_search = SearchBook::count();
        $response_time = SearchBook::select('response_time')->get();
        $search_book = SearchBook::select('book_1_match')->get();
        $avg_match = $search_book->avg('book_1_match');
        $avg_response_time = round($response_time->avg('response_time'),1);
        $available = Book::selectRaw('is_available, COUNT(*) as count')->groupBy('is_available')->pluck('count', 'is_available');
        return view('livewire.admin.home', compact('avg_response_time','avg_match','total_search','total_book', 'available'));
    }
}
